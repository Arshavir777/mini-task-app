<template>
  <v-app>
    <v-card :loading="isLoading">
      <v-form v-model="valid" @submit.prevent="submit" ref="observable">
        <v-container grid-list-md>
          <v-text-field
            v-model="input.first_name"
            :counter="10"
            :rules="rules.firstName"
            label="First name"
          ></v-text-field>
          <v-text-field
            v-model="input.last_name"
            :counter="10"
            :rules="rules.lastName"
            label="Last name"
          ></v-text-field>
          <!-- TODO: make separate component DateInput -->
          <v-dialog
            ref="dialog"
            v-model="modal"
            :return-value.sync="input.birth_date"
            persistent
            width="290px"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-text-field
                v-model="input.birth_date"
                label="Birth date"
                :rules="rules.birthDate"
                readonly
                v-bind="attrs"
                v-on="on"
              ></v-text-field>
            </template>
            <v-date-picker v-model="input.birth_date" :max="new Date().toISOString()" scrollable>
              <v-spacer></v-spacer>
              <v-btn text color="primary" @click="modal = false">
                Cancel
              </v-btn>
              <v-btn
                text
                color="primary"
                @click="$refs.dialog.save(input.birth_date)"
              >
                OK
              </v-btn>
            </v-date-picker>
          </v-dialog>

          <v-text-field
            v-model="input.profession"
            label="Profession"
            required
          ></v-text-field>

          <v-text-field
            v-if="this.input.profession"
            v-model.number="input.years_in_profession"
            :rules="input.profession ? rules.yearsInProfession : []"
            label="Years in Profession"
            required
          ></v-text-field>

          <v-select
            :items="countries"
            v-model="input.country_id"
            :rules="rules.country"
            item-text="name"
            item-value="id"
            name="name"
            label="Country"
          ></v-select>
          <div class="text-right">
            <v-btn color="info" type="submit">Save</v-btn>
          </div>
        </v-container>
      </v-form>
    </v-card>
  </v-app>
</template>
<script>
import { apiService, storageService } from '../services';

export default {
  name: 'EditForm',
  props: {
    customer: Object,
    countries: Array,
  },
  data() {
    return {
      isLoading: false,
      menu: false,
      modal: false,
      valid: false,
      birthDate: '',
      input: {},
      rules: {
        firstName: [(v) => !!v || 'First name is required'],
        lastName: [(v) => !!v || 'Last name is required'],
        birthDate: [(v) => !!v || 'Birth date is required'],
        yearsInProfession: [
          (v) => !!v || 'Years in profession is required',
          (v) => (!Number.isNaN(parseFloat(v)) && v > 0) || 'Years in profession must be positive number',
        ],
        country: [(v) => !!v || 'Country is required'],
      },
    };
  },
  created() {
    this.input = {
      ...this.customer,
      country_id: this.customer.country?.id,
    };
  },
  methods: {
    async submit() {
      this.$refs.observable.validate();
      if (!this.valid) {
        return;
      }

      const { id } = this.customer;

      try {
        this.isLoading = true;
        await apiService.updateCustomer(id, this.input);
        storageService.checkDraftCustomer(id);
        this.$router.push({ name: 'customer-list' });
      } catch (error) {
        console.log(error);
      } finally {
        this.isLoading = false;
      }
    },
  },
};
</script>
