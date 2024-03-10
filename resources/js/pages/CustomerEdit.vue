<template>
  <div>
    <div class="text-center" v-if="isLoading">
      <v-progress-circular
        indeterminate
        color="primary"
      ></v-progress-circular>
    </div>
    <div v-else>
      <h2>
        Edit Customer
      </h2>
      <div class="text-right">
        <v-btn color="info" to="/customers">Customer List</v-btn>
      </div>
      <edit-form :countries="countries" :customer="customer" class="mt-5" />
    </div>
  </div>
</template>
<script>
import EditForm from '../components/EditForm.vue';
import { apiService } from '../services';

export default {
  components: { EditForm },
  name: 'CustomerEdit',
  data: () => ({
    countries: [],
    customer: null,
    isLoading: true,
  }),
  async mounted() {
    const { id } = this.$route.params;
    await Promise.all([
      this.loadCountries(),
      this.loadCustomer(id),
    ]);
  },
  methods: {
    async loadCountries() {
      const countries = await apiService.loadCountries();
      this.countries = countries;
    },
    async loadCustomer(id) {
      try {
        this.isLoading = true;
        const customer = await apiService.loadCustomer(id);
        this.customer = customer;
        this.isLoading = false;
      } catch (error) {
        this.$router.push('/404');
      } finally {
        this.isLoading = false;
      }
    },
  },
};
</script>
