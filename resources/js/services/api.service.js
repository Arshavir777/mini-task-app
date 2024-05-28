import axios from 'axios';

class ApiService {
  constructor() {
    this.client = axios.create({ baseURL: 'http://localhost:8000' });
  }

  setAuthHeader(token) {
    this.client.defaults.headers.common.Authorization = `Bearer ${token}`;
  }

  removeAuthHeader() {
    this.client.defaults.headers.common.Authorization = '';
  }

  async login(credentials) {
    const { data } = await this.client.post('/api/auth/login', credentials);
    return data;
  }

  async register(input) {
    const { data } = await this.client.post('/api/auth/register', input);
    return data;
  }

  async logout() {
    await this.client.post('/api/auth/logout');
  }

  async loadTasks() {
    try {
      const { data } = await this.client.get('/api/tasks');
      return data;
    } catch (error) {
      return [];
    }
  }

  async createTask(data) {
    const res = await this.client.post('/api/tasks', data);
    return res.data;
  }

  async updateTask(id, data) {
    const res = await this.client.patch(`/api/tasks/${id}`, data);
    return res.data;
  }

  async deleteTask(id) {
    await this.client.delete(`/api/tasks/${id}`);
  }
}

export default new ApiService();
