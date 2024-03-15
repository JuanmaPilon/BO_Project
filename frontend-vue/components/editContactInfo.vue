<template>
  <div>
    <form @submit.prevent="saveChanges">
      <div class="contactInfoCard grid grid-cols-2 gap-3">
        <div class="contactBox contactMain">
          <label for="name contactMain contactMain">Name</label>
          <input class="inputBox contactSub " v-model="editedContact.name" id="name" />
        </div>
        <div class="contactBox contactMain ml-auto">
          <label for="adress contactMain">Address</label>
          <input class="inputBox contactSub" v-model="editedContact.adress" id="adress" />
        </div>
        <div class="contactBox contactMain">
          <label for="position contactMain">Title</label>
          <input class="inputBox contactSub" v-model="editedContact.position" id="position" />
        </div>
        <div class="contactBox contactMain ml-auto">
          <label for="phone contactMain">Phone</label>
          <input class="inputBox contactSub" v-model="editedContact.number" id="phone" />
        </div>
        <div class="contactBox contactMain">
          <label for="image contactMain">Profile Picture</label>
          <input class="inputBox contactSub" v-model="editedContact.image" id="image" />
        </div>
        <div class="contactBox contactMain ml-auto">
          <label for="email contactMain">Email</label>
          <input class="inputBox contactSub" v-model="editedContact.email" id="email" />
        </div>
      </div>
      <button class="saveButton" type="submit">Save</button>
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
  