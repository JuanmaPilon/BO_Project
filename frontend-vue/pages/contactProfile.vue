<template>
      <button
      class="backButton backButtonMd"
      @click="goBack">
    <i class="fas fa-arrow-left fa-lg"></i>
      <span class="contactSub">Back</span>
    </button>
    <div class="relative">
    <div class="grayBgSqr grayBgSqrMd">
      <button class="editButtonMd" @click="editContact">
        EDIT
      </button>
      <img
        v-if="!loadingContactDetails && contact.image && !imageError"
        :src="contact.image"
        alt="profileImage"
        class="profileImage profileImageMd"
        @load="handleImageLoad"
        @error="handleImageError"
      />
      <img
        v-if="!loadingContactDetails && (!contact.image || imageError)"
        src="../static/emptyContact.png"
        alt="emptyProfileImage"
        class="profileImage profileImageMd"
      />
    </div>
    <div class="profileHeader profileHeaderMd">
      <h1 class="inputText">{{ contact.name }}</h1>
      <p class="labelForm mb-5">{{ contact.position }}</p>
    </div>
    <div class="contactInfoContainer mx-20">
      <contactInfo v-if="!loadingContactDetails && contact" :contact="contact" />
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
      contact: {},
      loadingContactDetails: true,
      imageError: false,
    };
  },
  methods: {
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
      } finally {
        this.loadingContactDetails = false;
      }
    },
    editContact() {
      
    },
    handleImageError() {
      this.imageError = true;
    },
    goBack() {
      this.$router.push('/contact');
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
