<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_lifetime' => 86400, // 1 day
        'cookie_secure'   => isset($_SERVER['HTTPS']),
        'cookie_httponly' => true,
        'cookie_samesite' => 'Strict',
        'use_strict_mode' => true
    ]);
}

require_once __DIR__ . '/../models/PermissionModel.php';

function isLoggedIn() {
    return isset($_SESSION['user_id'], $_SESSION['logged_in']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        if (isApiRequest()) {
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit();
        } else {
            header('Location: /frontend/login.php');
            exit();
        }
    }

    // Session expiration (1 hour)
    if (time() - $_SESSION['logged_in'] > 3600) {
        logout();
        if (isApiRequest()) {
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Session expired']);
            exit();
        } else {
            header('Location: /frontend/login.php?expired=1');
            exit();
        }
    }

    // Update last activity
    $_SESSION['logged_in'] = time();
}

function isAuthenticated() {
    return isLoggedIn();
}

function login($user_id, $username, $roles, $permissions = []) {
    if (isLoggedIn()) {
        return false; // Prevent login if already logged in
    }
    session_regenerate_id(true);
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;
    $_SESSION['roles'] = $roles;
    $_SESSION['permissions'] = $permissions;
    $_SESSION['logged_in'] = time();
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    return true;
}

function logout() {
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
}

function getCurrentUserId() {
    return $_SESSION['user_id'] ?? null;
}

function getCurrentUsername() {
    return $_SESSION['username'] ?? null;
}

function getCurrentUserRoles() {
    return $_SESSION['roles'] ?? [];
}

function getCurrentUserPermissions() {
    return $_SESSION['permissions'] ?? [];
}

function hasRole($role) {
    $roles = getCurrentUserRoles();
    return in_array($role, $roles);
}

function hasPermission($permission) {
    $permissions = getCurrentUserPermissions();
    return in_array($permission, $permissions);
}

function isAdmin() {
    return hasRole('admin');
}

function isSeller() {
    return hasRole('seller');
}

function isCustomer() {
    return hasRole('customer');
}

function isManager() {
    return hasRole('manager');
}

function isSupport() {
    return hasRole('support');
}

function requireRole($role) {
    requireLogin();
    if (!hasRole($role)) {
        if (isApiRequest()) {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => "Forbidden: {$role} access required"]);
            exit();
        } else {
            header('Location: /frontend/access-denied.php');
            exit();
        }
    }
}

function requirePermission($permission) {
    requireLogin();
    
    // Check if user has the permission directly
    if (hasPermission($permission)) {
        return;
    }
    
    // If not, check if user has the permission through a role
    $permissionModel = new PermissionModel();
    if ($permissionModel->userHasPermission(getCurrentUserId(), $permission)) {
        // Add the permission to the session for future checks
        $_SESSION['permissions'][] = $permission;
        return;
    }
    
    // If user doesn't have the permission, deny access
    if (isApiRequest()) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => "Forbidden: You don't have permission to access this resource"]);
        exit();
    } else {
        header('Location: /frontend/access-denied.php');
        exit();
    }
}

function requireAdmin() {
    requireRole('admin');
}

function requireSeller() {
    requireLogin();
    if (!isSeller() && !isAdmin()) {
        if (isApiRequest()) {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Forbidden: Seller access required']);
            exit();
        } else {
            header('Location: /frontend/access-denied.php');
            exit();
        }
    }
}

function validateCsrfToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

function generateCsrfToken() {
    return $_SESSION['csrf_token'] ?? '';
}

function isApiRequest() {
    return (
        isset($_SERVER['HTTP_ACCEPT']) && 
        strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false
    ) || (
        isset($_SERVER['REQUEST_URI']) && 
        strpos($_SERVER['REQUEST_URI'], '/api/') !== false
    );
}
?>