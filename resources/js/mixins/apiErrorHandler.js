import { mapActions } from 'vuex';

export default {
  methods: {
    ...mapActions(['showNotification']), // Assuming you have a Vuex action to show notifications

    handleApiError(error) {
      if (error.response) {
        const { data } = error.response;
        let message = 'An error occurred';

        if (data && data.errors && data.errors.length) {
          [message] = data.errors;
        }
        this.showNotification({ color: 'error', message });
      } else if (error.request) {
        // The request was made but no response was received
        this.showNotification({ color: 'error', message: 'No response received from server' });
      } else {
        // Something happened in setting up the request that triggered an error
        this.showNotification({ color: 'error', message: 'Request failed' });
      }
    },
  },
};
