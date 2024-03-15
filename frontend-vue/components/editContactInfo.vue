<template>
  <div>
    <form @submit.prevent="saveChanges">
      <div class="contactInfoCard grid grid-cols-1 gap-3 md:grid-cols-2 md:gap-3">
        <div class="contactBox contactMain">
          <label for="name contactMain contactMain">Name</label>
          <input class="inputBox contactSub " v-model="editedContact.name" id="name" />
        </div>
        <div class="contactBox contactMain ml-auto">
          <label for="adress contactMain">Address</label>
        <input class="inputBox contactSub" v-model="editedContact.adress" id="adress" ref="adressInput"/>
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
      <div class="flex mt-4 justify-center">
      <button class="saveButton mx-2" @click="cancelEdit">Cancel</button>
      <button class="saveButton mx-2" type="submit">Save</button>
      </div>
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
      const cancelEdit = () => {
      editedContact.value = { ...props.contact };
    };
    const handlePlaceChanged = (place) => {
      editedContact.value.adress = place.formatted_address;
    };
    const initAutocomplete = () => {
      const autocomplete = new google.maps.places.Autocomplete(
        document.getElementById('adress'), {
          types: ['geocode']
        }
      );
      autocomplete.addListener('place_changed', () => {
        const place = autocomplete.getPlace();
        handlePlaceChanged(place);
      });
    };
    onMounted(() => {
      initAutocomplete();
    });
      return {
        editedContact,
        saveChanges,
        cancelEdit,
      };
    },
  };
  </script>
  
<style>
</style>