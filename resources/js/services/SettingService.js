import apiClient from './api.js';

const SettingService = {
    async getAll() {
        return apiClient.get('/settings');
    }
};

export default SettingService;