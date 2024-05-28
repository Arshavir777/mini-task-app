<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <v-card>
          <v-card-title>
            <span class="headline">Tasks</span>
            <v-spacer></v-spacer>
            <v-btn color="green" @click="showEditDialog = true" size="small">
              Add
            </v-btn>
          </v-card-title>
          <v-list>
            <template v-for="(task, index) in allTasks">
              <v-list-group v-if="task.subTasks.length" :key="index" :value="task.expanded"
                @click="task.expanded = !task.expanded">
                <template v-slot:activator>
                  <TaskLineItem :task="task"
                    @edit="openEditDialog(task)"
                    @delete="openConfirmDialog(task)" />
                </template>
                <TaskLineItem v-for="(subTask, subIndex) in task.subTasks"
                  :key="subIndex"
                  :task="subTask"
                  @edit="openEditDialog(task)"
                  @delete="openConfirmDialog(task)" />
              </v-list-group>
              <TaskLineItem :key="task.id" :task="task" v-else
                @edit="openEditDialog(task)"
                @delete="openConfirmDialog(task)"
                />
            </template>
          </v-list>
        </v-card>
      </v-col>
    </v-row>
    <TaskEditDialog :show="showEditDialog" @close="showEditDialog = false" @submit="handleSaveTask" />
    <ConfirmDialog :show="showConfirmDialog" @cancel="showConfirmDialog = false"
      @ok="handleDelete" />
  </v-container>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import TaskLineItem from '../components/TaskLineItem.vue';
import TaskEditDialog from '../components/TaskEditDialog.vue';
import ConfirmDialog from '../components/ConfirmDialog.vue';
import apiErrorHandler from '../mixins/apiErrorHandler';

export default {
  components: {
    TaskLineItem,
    TaskEditDialog,
    ConfirmDialog,
  },
  mixins: [apiErrorHandler],
  data() {
    return {
      showEditDialog: false,
      showConfirmDialog: false,
    };
  },
  computed: {
    ...mapGetters(['allTasks']),
  },
  methods: {
    ...mapActions(['fetchTasks', 'addTask', 'deleteTask', 'setSelectedTask']),
    async addTask() {
      const task = {
        name: this.taskName,
        description: this.taskDescription,
        status: 'Pending',
      };
      await this.addTask(task);
      this.taskName = '';
      this.taskDescription = '';
    },
    openEditDialog(task) {
      this.setSelectedTask(task);
      this.showEditDialog = true;
    },
    openConfirmDialog(task) {
      this.setSelectedTask(task);
      this.showConfirmDialog = true;
    },
    async handleDelete() {
      try {
        await this.deleteTask(this.selectedTask.id);
        this.setSelectedTask(null);
      } catch (error) {
        this.handleApiError(error);
      }
    },
    async handleSaveTask(data) {
      try {
        await this.addTask(data);
      } catch (error) {
        this.handleApiError(error);
      }
    },
  },
  created() {
    this.fetchTasks();
  },
};
</script>
