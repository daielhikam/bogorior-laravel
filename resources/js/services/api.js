import axios from 'axios';

const apiClient = {
    get: async (url, params = {}) => {
        try {
            const response = await window.axios.get(url, { params });
            return response.data;
        } catch (error) {
            console.error(`GET ${url} failed:`, error);
            throw error;
        }
    },
    
    post: async (url, data = {}) => {
        try {
            const response = await window.axios.post(url, data);
            return response.data;
        } catch (error) {
            console.error(`POST ${url} failed:`, error);
            throw error;
        }
    }
};

export default apiClient;