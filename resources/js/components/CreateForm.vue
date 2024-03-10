<template>
  <div>
    <div>
      <v-chip v-if="customer?.id" class="ma-2" color="warning"> Draft </v-chip>
    </div>
    <wizard class="mt-10" :customer="customer" :countries="countries" />
  </div>
</template>
<script>
import Wizard from './Wizard.vue';

export default {
  name: 'CreateForm',
  props: {
    customer: Object,
    countries: Array,
  },
  components: {
    Wizard,
  },
};
</script>
