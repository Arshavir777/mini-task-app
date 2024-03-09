<template>
    <v-app>
        <v-container grid-list-md>
            <v-btn color="primary">Get started</v-btn>
        </v-container>
    </v-app>
  </template>
  <script>
  export default {
    name: 'App',
    mounted() {
        console.log('MOUNTED')
    },
    data () {
      return {
        //
      }
    }
  }
  </script>