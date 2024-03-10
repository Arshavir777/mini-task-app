import axios from 'axios';

class ApiService {
  constructor() {
    this.client = axios;
  }

  async loadCountries() {
    try {
      const { data } = await this.client.get('/api/countries');
      return data.data;
    } catch (error) {
      return [];
    }
  }

  async createCustomer(data) {
    const res = await this.client.post('/api/customers', data);
    return res.data?.data;
  }

  async updateCustomer(id, data) {
    const res = await this.client.patch(`/api/customers/${id}`, data);
    return res.data?.data;
  }

  async loadCustomers() {
    try {
      const res = await this.client.get('/api/customers');
      return res.data?.data;
    } catch (error) {
      return [];
    }
  }

  async loadCustomer(id) {
    const res = await this.client.get(`/api/customers/${id}`);
    return res.data?.data;
  }

  async deleteCustomer(id) {
    await this.client.delete(`/api/customers/${id}`);
  }
}

export default new ApiService();
