<template>
  <v-form v-model="valid" @submit.prevent="submit" ref="observer">
    <v-container>
      <div>
      <v-dialog
        ref="dialog"
        v-model="modal"
        :return-value.sync="birthDate"
        persistent
        width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            v-model="birthDate"
            label="Birth date"
            :rules="rules.birthDate"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
          v-model="birthDate"
          :max="new Date().toISOString()"
          scrollable
        >
          <v-spacer></v-spacer>
          <v-btn
            text
            color="primary"
            @click="modal = false"
          >
            Cancel
          </v-btn>
          <v-btn
            text
            color="primary"
            @click="$refs.dialog.save(birthDate)"
          >
            OK
          </v-btn>
        </v-date-picker>
      </v-dialog>
    </div>
    <div class="d-flex justify-space-between mt-2">
      <v-btn color="info" @click="$emit('prevStep')">Prev</v-btn>
      <v-btn color="info" type="submit">Next</v-btn>
    </div>
    </v-container>
  </v-form>
</template>
<script>
import eventBus from '../eventBus';
import { apiService } from '../services';

export default {
  name: 'SecondStep',
  props: {
    customer: Object,
  },
  data: () => ({
    menu: false,
    modal: false,
    valid: false,
    birthDate: '',
    rules: {
      birthDate: [(v) => !!v || 'Birth date is required'],
    },
  }),
  mounted() {
    if (this.customer?.birth_date) {
      this.birthDate = this.customer.birth_date;
    }
  },
  methods: {
    async submit() {
      this.$refs.observer.validate();
      if (!this.valid) {
        return;
      }
      try {
        const customer = await apiService.updateCustomer(this.customer.id, {
          birth_date: this.birthDate,
        });
        eventBus.$emit('customerUpdate', customer);
        this.$emit('nextStep');
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>
