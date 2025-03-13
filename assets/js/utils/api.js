/**
 * API Utility Module
 * 
 * This module provides a centralized way to make API calls to the backend.
 * It handles common functionality like:
 * - Adding authentication headers
 * - Error handling
 * - Response parsing
 * - Request/response interceptors
 */

const API = {
    baseUrl: '/sundarta/api',
    
    /**
     * Make API request with proper headers and error handling
     * @param {string} endpoint - API endpoint
     * @param {Object} options - Request options
     * @returns {Promise} - API response
     */
    request: async (endpoint, options = {}) => {
        // Implementation details will go here
    },

    /**
     * GET request helper
     * @param {string} endpoint - API endpoint
     * @param {Object} params - Query parameters
     * @returns {Promise} - API response
     */
    get: async (endpoint, params = {}) => {
        // Implementation details will go here
    },

    /**
     * POST request helper
     * @param {string} endpoint - API endpoint
     * @param {Object} data - Request body
     * @returns {Promise} - API response
     */
    post: async (endpoint, data = {}) => {
        // Implementation details will go here
    },

    /**
     * PUT request helper
     * @param {string} endpoint - API endpoint
     * @param {Object} data - Request body
     * @returns {Promise} - API response
     */
    put: async (endpoint, data = {}) => {
        // Implementation details will go here
    },

    /**
     * DELETE request helper
     * @param {string} endpoint - API endpoint
     * @returns {Promise} - API response
     */
    delete: async (endpoint) => {
        // Implementation details will go here
    }
};

export default API; 