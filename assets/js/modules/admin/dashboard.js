/**
 * Admin Dashboard Module
 * 
 * This module handles the admin dashboard functionality, including:
 * - Loading and displaying statistics
 * - Initializing and updating charts
 * - Managing real-time updates
 * 
 * API Endpoints used:
 * - GET /api/orders/statistics
 * - GET /api/products
 * - GET /api/services
 * - GET /api/users
 */

import Charts from '../../utils/charts.js';
import Price from '../../utils/price.js';
import UI from '../../utils/ui.js';

const AdminDashboard = {
    /**
     * State management
     */
    state: {
        revenueChart: null,
        orderStatsChart: null,
        categoryDistChart: null,
        userGrowthChart: null,
        updateInterval: null
    },

    /**
     * Initialize the dashboard
     */
    init: async () => {
        try {
            // Initialize charts
            await AdminDashboard.initCharts();
            
            // Load initial statistics
            await AdminDashboard.loadStatistics();
            
            // Set up real-time updates
            AdminDashboard.setupUpdates();
            
            // Initialize event listeners
            AdminDashboard.initEventListeners();
            
            UI.showSuccess('Dashboard initialized successfully');
        } catch (error) {
            console.error('Dashboard initialization failed:', error);
            UI.showError('Failed to initialize dashboard');
        }
    },

    /**
     * Initialize all charts
     */
    initCharts: async () => {
        // Revenue chart
        const revenueCanvas = document.getElementById('revenue-chart');
        if (revenueCanvas) {
            const data = await AdminDashboard.fetchRevenueData();
            AdminDashboard.state.revenueChart = Charts.createLineChart(
                revenueCanvas,
                Charts.formatRevenueData(data)
            );
        }

        // Order statistics chart
        const orderStatsCanvas = document.getElementById('order-stats-chart');
        if (orderStatsCanvas) {
            const data = await AdminDashboard.fetchOrderStats();
            AdminDashboard.state.orderStatsChart = Charts.createBarChart(
                orderStatsCanvas,
                Charts.formatOrderStatsData(data)
            );
        }

        // Category distribution chart
        const categoryDistCanvas = document.getElementById('category-dist-chart');
        if (categoryDistCanvas) {
            const data = await AdminDashboard.fetchCategoryData();
            AdminDashboard.state.categoryDistChart = Charts.createDoughnutChart(
                categoryDistCanvas,
                data
            );
        }

        // User growth chart
        const userGrowthCanvas = document.getElementById('user-growth-chart');
        if (userGrowthCanvas) {
            const data = await AdminDashboard.fetchUserGrowthData();
            AdminDashboard.state.userGrowthChart = Charts.createAreaChart(
                userGrowthCanvas,
                data
            );
        }
    },

    /**
     * Load dashboard statistics
     */
    loadStatistics: async () => {
        try {
            const response = await fetch('/api/orders/statistics');
            const data = await response.json();

            if (data.success) {
                AdminDashboard.updateStatistics(data.data);
            } else {
                throw new Error(data.message);
            }
        } catch (error) {
            console.error('Failed to load statistics:', error);
            UI.showError('Failed to load dashboard statistics');
        }
    },

    /**
     * Update statistics in the UI
     * @param {Object} data 
     */
    updateStatistics: (data) => {
        // Update revenue stats
        const revenueElement = document.getElementById('total-revenue');
        if (revenueElement) {
            revenueElement.textContent = Price.format(data.totalRevenue);
        }

        // Update order stats
        const orderElement = document.getElementById('total-orders');
        if (orderElement) {
            orderElement.textContent = data.totalOrders;
        }

        // Update product stats
        const productElement = document.getElementById('total-products');
        if (productElement) {
            productElement.textContent = data.totalProducts;
        }

        // Update customer stats
        const customerElement = document.getElementById('total-customers');
        if (customerElement) {
            customerElement.textContent = data.totalCustomers;
        }
    },

    /**
     * Set up real-time updates
     */
    setupUpdates: () => {
        // Update every 5 minutes
        AdminDashboard.state.updateInterval = setInterval(async () => {
            await AdminDashboard.loadStatistics();
            await AdminDashboard.updateCharts();
        }, 5 * 60 * 1000);
    },

    /**
     * Initialize event listeners
     */
    initEventListeners: () => {
        // Time range selector
        const rangeSelector = document.getElementById('time-range');
        if (rangeSelector) {
            rangeSelector.addEventListener('change', async (e) => {
                await AdminDashboard.updateCharts(e.target.value);
            });
        }

        // Refresh button
        const refreshBtn = document.getElementById('refresh-stats');
        if (refreshBtn) {
            refreshBtn.addEventListener('click', async () => {
                await AdminDashboard.loadStatistics();
                await AdminDashboard.updateCharts();
                UI.showSuccess('Dashboard updated');
            });
        }
    },

    /**
     * Update all charts
     * @param {string} timeRange 
     */
    updateCharts: async (timeRange = 'week') => {
        try {
            // Update revenue chart
            if (AdminDashboard.state.revenueChart) {
                const revenueData = await AdminDashboard.fetchRevenueData(timeRange);
                Charts.updateChart(
                    AdminDashboard.state.revenueChart,
                    Charts.formatRevenueData(revenueData)
                );
            }

            // Update order stats chart
            if (AdminDashboard.state.orderStatsChart) {
                const orderStatsData = await AdminDashboard.fetchOrderStats(timeRange);
                Charts.updateChart(
                    AdminDashboard.state.orderStatsChart,
                    Charts.formatOrderStatsData(orderStatsData)
                );
            }

            // Update other charts...
        } catch (error) {
            console.error('Failed to update charts:', error);
            UI.showError('Failed to update dashboard charts');
        }
    },

    /**
     * Fetch revenue data from API
     * @param {string} timeRange 
     * @returns {Promise<Array>}
     */
    fetchRevenueData: async (timeRange = 'week') => {
        const response = await fetch(`/api/orders/statistics?type=revenue&range=${timeRange}`);
        const data = await response.json();
        return data.success ? data.data : [];
    },

    /**
     * Fetch order statistics from API
     * @param {string} timeRange 
     * @returns {Promise<Array>}
     */
    fetchOrderStats: async (timeRange = 'week') => {
        const response = await fetch(`/api/orders/statistics?type=orders&range=${timeRange}`);
        const data = await response.json();
        return data.success ? data.data : [];
    },

    /**
     * Fetch category distribution data from API
     * @returns {Promise<Object>}
     */
    fetchCategoryData: async () => {
        const response = await fetch('/api/categories');
        const data = await response.json();
        return data.success ? data.data : {};
    },

    /**
     * Fetch user growth data from API
     * @param {string} timeRange 
     * @returns {Promise<Object>}
     */
    fetchUserGrowthData: async (timeRange = 'week') => {
        const response = await fetch(`/api/users?type=growth&range=${timeRange}`);
        const data = await response.json();
        return data.success ? data.data : {};
    },

    /**
     * Clean up resources
     */
    destroy: () => {
        // Clear update interval
        if (AdminDashboard.state.updateInterval) {
            clearInterval(AdminDashboard.state.updateInterval);
        }

        // Destroy charts
        Charts.destroyChart(AdminDashboard.state.revenueChart);
        Charts.destroyChart(AdminDashboard.state.orderStatsChart);
        Charts.destroyChart(AdminDashboard.state.categoryDistChart);
        Charts.destroyChart(AdminDashboard.state.userGrowthChart);
    }
};

export default AdminDashboard; 