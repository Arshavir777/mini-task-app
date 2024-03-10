<template>
  <v-stepper v-model="step">
    <v-stepper-header>
      <v-stepper-step :complete="step > 1" step="1"> Name </v-stepper-step>
      <v-divider></v-divider>
      <v-stepper-step :complete="step > 2" step="2">
        Birth date
      </v-stepper-step>
      <v-divider></v-divider>
      <v-stepper-step step="3"> Profession </v-stepper-step>
    </v-stepper-header>

    <v-stepper-items>
      <v-stepper-content step="1">
        <first-step :customer="customer" @nextStep="nextStep" />
      </v-stepper-content>

      <v-stepper-content step="2">
        <second-step
          :customer="customer"
          @prevStep="prevStep"
          @nextStep="nextStep"
        />
      </v-stepper-content>

      <v-stepper-content step="3">
        <final-step
          :customer="customer"
          :countries="countries"
          @prevStep="prevStep"
          @complete="complete"
        />
      </v-stepper-content>
    </v-stepper-items>
  </v-stepper>
</template>

<script>
import FirstStep from './FirstStep.vue';
import SecondStep from './SecondStep.vue';
import FinalStep from './FinalStep.vue';
import { storageService } from '../services';

export default {
  name: 'Wizard',
  props: {
    customer: Object,
    countries: Array,
  },
  data() {
    return {
      step: 1,
    };
  },
  created() {
    const lastStep = storageService.get('lastStep');
    if (lastStep) {
      this.step = +lastStep;
    }
  },
  methods: {
    nextStep() {
      this.step += 1;
      this.rememberLastStep();
    },
    prevStep() {
      this.step -= 1;
      this.rememberLastStep();
    },
    rememberLastStep() {
      storageService.set('lastStep', this.step);
    },
  },
  components: {
    FirstStep,
    SecondStep,
    FinalStep,
  },
};
</script>
