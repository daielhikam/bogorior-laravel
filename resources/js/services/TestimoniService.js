import apiClient from './api.js';

const TestimoniService = {
    async getFeatured(limit = 6) {
        return apiClient.get('/testimonials/featured', { limit });
    },
    
    async getAll(params = {}) {
        return apiClient.get('/testimonials', params);
    }
};

export default TestimoniService;