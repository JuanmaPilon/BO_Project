<template>
      <button
      class="backButton backButtonMd"
      @click="goBack"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        class="h-6 w-6"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M10 19l-7-7m0 0l7-7m-7 7h18"
        />
      </svg>
      <span class="contactSub">Back</span>
    </button>
  <div class="relative">
    <div class="grayBgSqr grayBgSqrMd">
      <button
        class="editButton btn absolute bottom-15 right-5 px-10 py-3"
        @click="editContact"
      >
        EDIT
      </button>
        <img
          v-show="contact.image !== undefined && contact.image !== null"
          :src="contact.image || 'https://cdn-icons-png.flaticon.com/512/3135/3135768.png'"
          alt="profileImage"
          class="profileImage profileImageMd"
        />
        <img
          v-show="contact.image === undefined || contact.image === null"
          src="../static/emptyContact.png"
          alt="emptyProfileImage"
          class="profileImage profileImageMd"
        />
    </div>
    <div class="text-center mt-2">
      <h1 class="inputText">{{ contact.name }}</h1>
      <p class="labelForm mb-5">{{ contact.position }}</p>
    </div>
  
    <div class="contactInfoContainer mx-20">
      <contactInfo v-if="contact" :contact="contact" />
    </div>
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
