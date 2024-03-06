<template>
  </template>
  
  <script>
  import { ref } from 'vue';
  
  export default {
    props: {
      contact: {
        type: Object,
        required: true,
      },
    },
    setup(props) {
      const editedContact = ref({ ...props.contact });
  
      const saveChanges = () => {

      };
  
      return {
        editedContact,
        saveChanges,
      };
    },
  };
  </script>
  
<style>
</style>
  