<template>
  <v-form v-model="valid" @submit.prevent="submit" ref="observer">
    <v-container>
      <v-row>
        <v-col cols="12" md="6" sm="12">
          <v-text-field
            v-model="firstName"
            :rules="rules.firstName"
            label="First name"
            :counter="10"
            required
          ></v-text-field>
        </v-col>
        <v-col cols="12" md="6" sm="12">
          <v-text-field
            v-model="lastName"
            :rules="rules.lastName"
            :counter="10"
            label="Last name"
            required
          ></v-text-field>
        </v-col>
      </v-row>
      <div class="text-right mt-2">
        <v-btn type="submit" color="info" :disabled="isLoading"> Next </v-btn>
      </div>
    </v-container>
  </v-form>
</template>
<script>
import eventBus from '../eventBus';
import { apiService } from '../services';

export default {
  name: 'FirstStep',
  props: {
    customer: Object,
  },
  data: () => ({
    isLoading: false,
    valid: false,
    firstName: '',
    lastName: '',
    rules: {
      firstName: [(v) => !!v || 'First name is required'],
      lastName: [(v) => !!v || 'Last name is required'],
    },
  }),
  created() {
    if (this.customer?.first_name) {
      this.firstName = this.customer.first_name;
    }
    if (this.customer?.last_name) {
      this.lastName = this.customer.last_name;
    }
  },
  methods: {
    async submit() {
      this.$refs.observer.validate();
      if (!this.valid) {
        return;
      }

      const isEdit = !!this.customer?.id;

      const data = {
        first_name: this.firstName,
        last_name: this.lastName,
      };

      try {
        this.isLoading = true;
        const customer = isEdit
          ? await apiService.updateCustomer(this.customer.id, data)
          : await apiService.createCustomer(data);

        eventBus.$emit('customerUpdate', customer);
        this.$emit('nextStep');
      } catch (error) {
        console.log(error);
      } finally {
        this.isLoading = false;
      }
    },
  },
};
</script>
