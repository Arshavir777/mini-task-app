<template>
  <v-dialog v-model="dialog" max-width="400">
    <v-card>
      <v-card-title class="headline"> Task </v-card-title>
      <v-card-text>
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-text-field
            v-model="task.name"
            :rules="[rules.required]"
            label="Name"
            required
          ></v-text-field>
          <v-textarea
            v-model="task.description"
            :rules="[rules.required]"
            label="Description"
            required
          ></v-textarea>
          <v-select
            v-model="task.status"
            :items="statusOptions"
            :rules="[rules.required]"
            label="Status"
            required
          ></v-select>
          <v-select
            v-model="task.parent_id"
            :items="allTasks"
            :item-title="`name`"
            :item-value="`id`"
            label="Parent Task"
            required
          ></v-select>

          <v-btn variant="primary" @click="submit">Save</v-btn>
        </v-form>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  data() {
    return {
      valid: false,
      task: {
        name: '',
        description: '',
        status: 'todo',
        parent_id: null,
      },
      rules: {
        required: (value) => !!value || 'Required.',
      },
      statusOptions: ['pending', 'done', 'in progress', 'todo'],
      dialog: this.show,
    };
  },
  created() {
    if (this.selectedTask) {
      this.task = JSON.parse(JSON.stringify(this.selectedTask));
    }
  },
  computed: {
    ...mapGetters(['selectedTask', 'allTasks']),
  },
  methods: {
    submit() {
      if (this.$refs.form.validate()) {
        this.$emit('submit', this.form);
      }
    },
    resetForm() {
      console.log('reset');
      this.resetForm();
    },
  },
  props: {
    show: {
      default: false,
      type: Boolean,
    },
  },
  watch: {
    dialog(newValue) {
      if (!newValue) {
        this.$emit('close');
      } else if (this.selectedTask) {
        this.task = JSON.parse(JSON.stringify(this.selectedTask));
      }
    },
    show(newVal) {
      this.dialog = newVal;
    },
  },
};
</script>
