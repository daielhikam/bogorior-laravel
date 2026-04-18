import apiClient from './api.js';

const ProjectService = {
    async getFeatured(limit = 3) {
        return apiClient.get('/projects/featured', { limit });
    },
    
    async getStats() {
        return apiClient.get('/project-stats');
    },
    
    async getAll(params = {}) {
        return apiClient.get('/projects', params);
    },
    
    async getById(id) {
        return apiClient.get('/project', { id });
    }
};

export default ProjectService;