<template>
  <div class="profileBg bg-gray-200 mx-20 my-10 rounded-lg p-2 overflow-visible relative h-64 flex flex-col justify-end">
    <div class="profileHeader relative">
      <img
        v-show="contact.image !== undefined && contact.image !== null"
        :src="contact.image || 'https://cdn-icons-png.flaticon.com/512/3135/3135768.png'"
        alt="profileImage"
        class="block mx-auto object-cover h-40 w-40 absolute left-1/2 transform -translate-x-1/2 z-10 bottom-[-70px]"
      />
      <img
        v-show="contact.image === undefined || contact.image === null"
        src="../static/emptyContact.png"
        alt="emptyProfileImage"
        class="block mx-auto object-cover h-40 w-40 absolute left-1/2 transform -translate-x-1/2 z-0 bottom-[-70px]"
      />
      <button
        class="editButton btn absolute bottom-3 right-5 px-10 py-3"
        @click="editContact"
      >
        EDIT
      </button>
    </div>
  </div>
  <div class="contactInfoContainer mx-20">
    <contactInfo v-if="contact" :contact="contact" />
  </div>
</template>


<script>
import contactInfo from '#components';
import { useAuthStore, useContactStore } from '#imports';
import axios from 'axios';

export default {
  data() {
    return {
      contact: {
        image: 'https://cdn-icons-png.flaticon.com/512/3135/3135768.png'
      },
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
          const foundContact = response.data.contacts.find(contact => contact.id === selectedContactId);
          if (foundContact) {
            this.contact = { ...foundContact, image: foundContact.image || '' };
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
