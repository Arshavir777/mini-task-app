<template>
  <div>
    <v-form v-model="valid" @submit.prevent="submit" ref="observable">
      <v-container>
        <v-select
          v-model="countryId"
          :items="countries"
          item-text="name"
          item-value="id"
          label="Country"
          :rules="rules.country"
          required
        ></v-select>
        <v-text-field v-model="profession" label="Profession"></v-text-field>
        <v-text-field
          v-if="profession"
          v-model.number="yearsInProfession"
          :rules="profession ? rules.yearsInProfession : []"
          label="Years in Professions"
        ></v-text-field>
        <div class="mt-2 d-flex justify-space-between">
          <v-btn color="info" @click="$emit('prevStep')">Prev</v-btn>
          <v-btn type="submit" color="info" > Submit </v-btn>
        </div>
      </v-container>
    </v-form>
  </div>
</template>

<script>
import { apiService, storageService } from '../services';

export default {
  name: 'FinalStep',
  props: {
    customer: Object,
    countries: Array,
  },
  data: () => ({
    valid: false,
    countryId: '',
    profession: '',
    yearsInProfession: '',
    rules: {
      country: [(v) => !!v || 'Country is required'],
      yearsInProfession: [
        (v) => !!v || 'Years in profession is required',
        (v) => (!Number.isNaN(parseFloat(v)) && v > 0) || 'Years in profession must be positive number',
      ],
    },
  }),
  mounted() {
    if (this.customer.profession) {
      this.profession = this.customer.profession;
    }
    if (this.customer.country_id) {
      this.countryId = this.customer.country_id;
    }
    if (this.customer.years_in_profession) {
      this.yearsInProfession = this.customer.years_in_profession;
    }
  },
  methods: {
    async submit() {
      try {
        this.$refs.observable.validate();
        if (!this.valid) {
          return;
        }

        const data = {
          country_id: this.countryId,
          profession: this.profession,
          years_in_profession: this.yearsInProfession,
        };

        await apiService.updateCustomer(this.customer.id, data);

        storageService.clear();
        this.$router.push({ name: 'edit-customer', params: { id: this.customer.id } });
      } catch (error) {
        console.log({ error });
      }
    },
  },
};
</script>
