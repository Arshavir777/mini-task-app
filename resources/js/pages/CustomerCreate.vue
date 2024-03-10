<template>
  <div>
    <h2>Create Customer</h2>
    <div class="text-right">
      <v-btn color="info" to="/customers">Customer List</v-btn>
    </div>
    <create-form :customer="customer" :countries="countries"></create-form>
  </div>
</template>
<script>
import CreateForm from '../components/CreateForm.vue';
import { apiService } from '../services';
import eventBus from '../eventBus';

export default {
  name: 'CustomerCreate',
  components: {
    CreateForm,
  },
  data() {
    return {
      countries: [],
      customer: null,
    };
  },
  methods: {
    async fetchCountries() {
      const countries = await apiService.loadCountries();
      this.countries = countries;
    },
  },
  created() {
    const draftCustomer = localStorage.getItem('draftCustomer');
    if (draftCustomer) {
      this.customer = JSON.parse(draftCustomer);
    }
  },
  async mounted() {
    await this.fetchCountries();
    eventBus.$on('customerUpdate', (data) => {
      localStorage.setItem('draftCustomer', JSON.stringify(data));
      this.customer = data;
    });
  },
};
</script>
