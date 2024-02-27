<template>
  <div class="profileBg bg-gray-200 mx-20 justify-center my-10 rounded-lg p-36 overflow-visible relative">
    <div class="profileHeader relative">
      <button
        class="editButton btn absolute -bottom-28 -right-28 px-10 py-3"
        @click="editContact"
      >
        EDIT
      </button>
      <img
        src="../static/emptyContact.png"
        alt="profileImage"
        class="block mx-auto object-cover h-40 w-40 absolute bottom-[-220px] left-1/2 transform -translate-x-1/2"
      />
    </div>
  </div>
  <contactInfo v-if="contact" :contact="contact" />
</template>

<script>
import contactInfo from '#components';
import { useAuthStore, useContactStore } from '#imports';
import axios from 'axios';

export default {
  data() {
    return {
      contact: {},
    };
  },
  methods: {
    editContact() {
    
    },
    async fetchContacts(selectedContactId) {
      try {
        const token = useAuthStore().token;
        const response = await axios.get('http://localhost:8000/api/contact', {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        if (Array.isArray(response.data.contacts) && response.data.contacts.length > 0) {
       //lo busco segun el id
          const foundContact = response.data.contacts.find(contact => contact.id === selectedContactId);

          if (foundContact) {
          //si lo encuentra lo asigno
            this.contact = { ...foundContact };// lo clono para no tener rpoblemas con reactividad X.X
            console.log('Contact data:', this.contact);
          } else {
            console.error('Contact not found with ID:', selectedContactId);
          }
        } else {
          console.error('No contacts found in the response.');
        }
      } catch (error) {
        console.error('Error getting contacts:', error);
      }
    },
  },
  mounted() {
    const selectedContactId = useContactStore().getSelectedContactId() || 0;
    console.log('Selected Contact ID:', selectedContactId);
    this.fetchContacts(selectedContactId);
  },
};
</script>

<style>
</style>
