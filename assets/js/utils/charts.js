/**
 * Charts Utility Module
 * 
 * This module provides chart creation and management functionality using Chart.js.
 * It includes common chart configurations and helper methods for:
 * - Line charts (revenue trends)
 * - Bar charts (order statistics)
 * - Pie/Doughnut charts (category distribution)
 * - Area charts (user growth)
 */

const Charts = {
    /**
     * Default chart options
     */
    defaultOptions: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            },
            tooltip: {
                mode: 'index',
                intersect: false
            }
        }
    },

    /**
     * Create a line chart
     * @param {HTMLCanvasElement} canvas 
     * @param {Object} data 
     * @param {Object} options 
     * @returns {Chart}
     */
    createLineChart: (canvas, data, options = {}) => {
        const ctx = canvas.getContext('2d');
        return new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                ...Charts.defaultOptions,
                ...options,
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    },

    /**
     * Create a bar chart
     * @param {HTMLCanvasElement} canvas 
     * @param {Object} data 
     * @param {Object} options 
     * @returns {Chart}
     */
    createBarChart: (canvas, data, options = {}) => {
        const ctx = canvas.getContext('2d');
        return new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                ...Charts.defaultOptions,
                ...options,
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    },

    /**
     * Create a doughnut chart
     * @param {HTMLCanvasElement} canvas 
     * @param {Object} data 
     * @param {Object} options 
     * @returns {Chart}
     */
    createDoughnutChart: (canvas, data, options = {}) => {
        const ctx = canvas.getContext('2d');
        return new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: {
                ...Charts.defaultOptions,
                ...options,
                cutout: '60%'
            }
        });
    },

    /**
     * Create an area chart
     * @param {HTMLCanvasElement} canvas 
     * @param {Object} data 
     * @param {Object} options 
     * @returns {Chart}
     */
    createAreaChart: (canvas, data, options = {}) => {
        const ctx = canvas.getContext('2d');
        return new Chart(ctx, {
            type: 'line',
            data: {
                ...data,
                datasets: data.datasets.map(dataset => ({
                    ...dataset,
                    fill: true
                }))
            },
            options: {
                ...Charts.defaultOptions,
                ...options,
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    },

    /**
     * Format chart data for revenue overview
     * @param {Array} data - Revenue data points
     * @returns {Object} - Formatted chart data
     */
    formatRevenueData: (data) => {
        return {
            labels: data.map(point => point.date),
            datasets: [{
                label: 'Revenue',
                data: data.map(point => point.amount),
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.4
            }]
        };
    },

    /**
     * Format chart data for order statistics
     * @param {Array} data - Order statistics data
     * @returns {Object} - Formatted chart data
     */
    formatOrderStatsData: (data) => {
        return {
            labels: data.map(point => point.status),
            datasets: [{
                label: 'Orders',
                data: data.map(point => point.count),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 206, 86)',
                    'rgb(75, 192, 192)'
                ],
                borderWidth: 1
            }]
        };
    },

    /**
     * Update chart data
     * @param {Chart} chart 
     * @param {Object} newData 
     */
    updateChart: (chart, newData) => {
        chart.data = newData;
        chart.update();
    },

    /**
     * Destroy chart instance
     * @param {Chart} chart 
     */
    destroyChart: (chart) => {
        if (chart) {
            chart.destroy();
        }
    }
};

export default Charts; 