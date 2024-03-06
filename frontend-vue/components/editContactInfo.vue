<template>
  <div>
    <form @submit.prevent="saveChanges">
      <div class="contactInfoCard grid grid-cols-2 gap-3">
        <div class="contactBox">
          <label for="name">Name:</label>
          <input v-model="editedContact.name" id="name" />
        </div>
        <div class="contactBox ml-auto">
          <label for="address">Address:</label>
          <input v-model="editedContact.adress" id="adress" />
        </div>
        <div class="contactBox">
          <label for="position">Title:</label>
          <input v-model="editedContact.position" id="position" />
        </div>
        <div class="contactBox ml-auto">
          <label for="phone">Phone:</label>
          <input v-model="editedContact.number" id="phone" />
        </div>
        <div class="contactBox">
          <label for="image">Profile Picture:</label>
          <input v-model="editedContact.image" id="image" />
        </div>
        <div class="contactBox ml-auto">
          <label for="email">Email:</label>
          <input v-model="editedContact.email" id="email" />
        </div>
      </div>
      <button type="submit">Save</button>
    </form>
  </div>
</template>
  
  <script>
  import { useContactStore,useAuthStore } from '#imports';
  import { ref } from 'vue';
  import axios from 'axios';
  
  export default {
    props: {
      contact: {
        type: Object,
        required: true,
      },
    },
    setup(props, { emit }) {
      const editedContact = ref({ ...props.contact });

      const saveChanges = () => {
        emit('saveChanges', editedContact.value);
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
  