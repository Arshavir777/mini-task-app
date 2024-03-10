<template>
  <div>
    <div class="text-center" v-if="isLoading">
      <v-progress-circular indeterminate color="primary"></v-progress-circular>
    </div>
    <v-container v-else>
      <h2>Customer List</h2>
      <div class="text-right">
        <v-btn color="info" to="/customers/create">New Customer</v-btn>
      </div>
      <div v-if="!customers.length">
        There are no customers yet
      </div>
      <v-simple-table v-else>
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-left">ID</th>
              <th class="text-left">Name</th>
              <th class="text-left">Profession</th>
              <th class="text-left">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in customers" :key="item.name">
              <td>{{ item.id}} </td>
              <td>{{ item.first_name }} {{ item.last_name }}</td>
              <td>{{ item.profession || '-'  }}</td>
              <td>
                <v-btn
                  :to="`/customers/${item.id}`"
                  class="ma-2"
                  small
                  color="warning"
                  dark
                >
                  Edit
                  <v-icon dark right> mdi-pencil </v-icon>
                </v-btn>
                <v-btn
                  @click="deleteItem(item.id)"
                  class="ma-2"
                  small
                  color="error"
                  dark
                >
                  Delete
                  <v-icon dark right> mdi-delete </v-icon>
                </v-btn>
              </td>
            </tr>
          </tbody>
        </template>
      </v-simple-table>
    </v-container>
  </div>
</template>
<script>
import { apiService, storageService } from '../services';

export default {
  name: 'CustomerList',
  data() {
    return {
      isLoading: true,
      customers: [],
    };
  },
  methods: {
    async fetchCustomers() {
      try {
        const customers = await apiService.loadCustomers();
        this.customers = customers;
      } catch (error) {
        console.log(error);
      } finally {
        this.isLoading = false;
      }
    },
    async deleteItem(id) {
      try {
        await apiService.deleteCustomer(id);
        await this.fetchCustomers();
        storageService.checkDraftCustomer(id);
      } catch (error) {
        console.log(error);
      }
    },
  },
  async mounted() {
    await this.fetchCustomers();
  },
};
</script>
