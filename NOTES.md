# Setup Flow I followed

- Had to move the project into XAMPP htdocs folder to run the project on localhost
- Had to install composer to install the dependencies
    - Used the following settings:
        - Project name: `sundarta/beauty-wellness`
        - Project description: Beauty and wellness e-commerce site
        - Project type: `project`
        - Required dependencies: `monolog/monolog` (^3.8) and `vlucas/phpdotenv` (^5.6) (MonoLog for logging and PHP dotenv for environment variables, I downloaded monolog just for te sake of it, even I'm not sure what it is)
        - Project license: `MIT`
        - Minimum stability: `stable`
- Had to create a `.env` file to store the database credentials

- Filled in the database credentials in the `.env` file
- Created the `backend/config/db.php` file to connect to the database

- Wrote the `index.php` file to handle the routing

- filled in `frontend/partials/header.php` and `footer.php` files
- Created a home page `frontend/pages/home.php`, this page only loads the header and footer partials

## Backend Development Journey

Started with setting up the project structure. After staring at my empty project folder for a good 10 minutes (and a coffee break), I decided to go with a simple MVC-like architecture. Created these folders:

```
backend/
  ├── api/      # Where the magic happens - API endpoints
  ├── config/   # All the boring but important stuff
  ├── controllers/  # The traffic controllers
  ├── helpers/  # The little helpers
  ├── models/   # The data wranglers
```

### Database Connection & Bootstrap

First up was getting the database connection working. Created `backend/config/db.php` - kept it simple and clean:

```php
<?php
define('DB_HOST', 'localhost');
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASS', $_ENV['DB_PASS']);
define('DB_NAME', 'sundarta_db');

function connectDB() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
```

Then created `bootstrap.php` to handle all the initialization stuff:
- Environment variables (thanks to dotenv!)
- Error reporting (because we all make mistakes)
- CORS setup (spent way too much time debugging this one, I still don't get what it is or what it does)
- Session handling (gotta keep track of our users)

### Base Classes - The Foundation

Created `BaseModel.php` - this is where all the common database operations live:

```php
class BaseModel {
    protected $db;
    protected $table;

    public function __construct() {
        $this->db = connectDB();
    }

    // Added all the CRUD operations here
    // Saved me from writing the same code over and over

    // Common methods like executeQuery, select, insert, update, delete
    // Also getAll, getById, deleteById, count, etc.
}
```

Then `BaseController.php` - because every response needs love:

```php
class BaseController {
    protected function sendSuccess($data = [], $message = 'Success', $statusCode = 200) {
        // Making our responses look pretty
    }

    protected function sendError($message = 'Error', $statusCode = 400, $errors = []) {
        // Because errors happen, might as well make them look good
    }
}
```

### Authentication & Users

Realized I needed authentication (duh!). Created `auth.php` in helpers:

```php
function isLoggedIn() {
    return isset($_SESSION['user_id'], $_SESSION['logged_in']);
}

// Added more auth functions
// Spent a good hour debugging session issues
// Note to self: Always check if sessions are actually working
```

Built the user system next:
- `UserModel.php` for all the user database stuff
- `UserController.php` to handle user requests
- Got carried away and added role-based access control (because why not?)

### API Endpoints - Where It All Comes Together

Organized the API endpoints by resource (feeling pretty proud of this structure, I'm not sure if it's the best way to do it, but it works for now):

```
backend/api/
  ├── users/
  │   ├── register.php  # New users welcome!
  │   ├── login.php     # Come on in
  │   ├── logout.php    # See you later
  │   └── ...
  ├── products/
  └── ...
```

Each endpoint follows this pattern (keeping it consistent):

```php
<?php
require_once __DIR__ . '/../../config/bootstrap.php';
require_once __DIR__ . '/../../controllers/UserController.php';

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}

// Only allow specific HTTP methods
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    apiError('Method not allowed', 405);
}

$controller = new UserController();
$controller->login();
```

### Features, Features, Features

Built out all the core features:
- Products and services (with categories)
- Reviews (because everyone's a critic)
- Shopping cart (the fun part!)
- Order processing (the scary part)

### Routing & .htaccess Magic

Finally, set up the routing with `.htaccess`:

```
RewriteEngine On
RewriteBase /sundarta/

# Handle API requests
RewriteCond %{REQUEST_URI} !^/sundarta/api/index.php$
RewriteRule ^api/(.*)$ /sundarta/api/index.php?api_route=$1 [QSA,L]

# Handle frontend requests
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ /sundarta/index.php?route=$1 [QSA,L]
```

### What's Next?

Still need to:
- Build out the frontend (the part users actually see!)
- Add some cool features like wishlists? eh, not really
- Make the error handling better (because users do weird things)
- Write some tests (I promise I'll do it... eventually)

## Profile Picture Implementation

Realized I completely forgot to add a profile picture field to the users table. How did I miss something so basic? Probably because I was too focused on the complex role-based access control system (which, let's be honest, is overkill for this project, but it was fun to build).

Added the `avatar` field to the users table:
```sql
ALTER TABLE users ADD COLUMN avatar VARCHAR(255) DEFAULT NULL COMMENT 'User profile picture URL';
```

Updated the UserModel.php to handle the avatar field:
- Modified the `create` method to accept an avatar parameter
- Updated the `updateProfile` and `updateProfileByAdmin` methods to include avatar in the allowed fields

Updated the UserController.php to handle avatar uploads and retrieval:
- Modified the `register` method to include the avatar field in the user creation process
- The avatar field is optional, so users can still register without a profile picture

Updated the API documentation to reflect these changes:
- Added the avatar field to the register, update profile, and update user endpoints

This was a simple change, but it's important for the user experience. Now users can have a profile picture, which makes the site feel more personal and engaging. It's these little details that can make a big difference in how users perceive the site.

Note to self: Always think about the user experience from the beginning. It's easier to add features during the initial development than to retrofit them later.

## The Great GROUP BY Disaster (March 19, 2025)

Today I discovered why only ONE product/service was showing up in my paginated results. Turns out, I had a classic SQL GROUP BY situation on my hands. Who knew that GROUP BY could be so... groupy?

The issue: I was using LEFT JOIN with GROUP BY in my SQL queries, but without proper aggregation handling. So when I tried to fetch all products or services, MySQL (being the strict enforcer it is) was like "Nope, I'm only giving you ONE record per group!"

The solution? Refactored the SQL queries in ProductModel.php and ServiceModel.php to use subqueries instead. Basically:

```sql
/* Before - The Problematic One */
SELECT p.*, AVG(r.rating) AS rating 
FROM products p
LEFT JOIN reviews r ON p.id = r.product_id
GROUP BY p.id

/* After - The Superstar */
SELECT p.*, COALESCE(r.avg_rating, 0) AS rating 
FROM products p
LEFT JOIN (
    SELECT product_id, AVG(rating) as avg_rating 
    FROM reviews 
    WHERE product_id IS NOT NULL 
    GROUP BY product_id
) r ON p.id = r.product_id
```

Spent an hour fixing this across all the query methods (getWithPagination, getByCategory, search, getFeatured...). The key insight was to pre-aggregate the ratings in a subquery FIRST, then join that result.

Note to self: When using JOINs with GROUP BY, always be explicit about what you're aggregating and how. And maybe read the MySQL docs once in a while? Just a thought.

The reward? All my products and services now show up beautifully paginated, WITH their correct average ratings. Who said database optimization isn't fun?


