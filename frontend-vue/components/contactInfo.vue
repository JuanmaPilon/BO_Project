<template>
    <div class="contactInfoCard grid grid-cols-2 gap-3">

      <div class="contactBox">
        <p class="contactMain">Name</p>
        <p class="inputBox contactSub">Jaimito{{ contact.name }}</p>
      </div>
      <div class="contactBox ml-auto">
        <p class="contactMain">Address</p>
        <p class="inputBox contactSub">Madagascar{{ contact.adress }}</p>
      </div>
      <div class="contactBox">
        <p class="contactMain">Title</p>
        <p class="inputBox contactSub">K-Pop Singer{{ contact.position }}</p>
      </div>
      <div class="contactBox ml-auto">
        <p class="contactMain">Phone</p>
        <p class="inputBox contactSub">N/A{{ contact.number }}</p>
      </div>
      <div class="contactBox">
        <p class="contactMain">Profile Picture</p>
        <p class="inputBox contactSub">PP</p>
      </div>
      <div class="contactBox ml-auto">
        <p class="contactMain">Email</p>
        <p class="inputBox contactSub">jaimito@gmail.com{{ contact.email }}</p>
      </div>

    </div>
    
  </template>
  
  <script>
  import axios from 'axios';
  import { useAuthStore } from '#imports';

  export default {
    props: {
      contact: {
        type: Object,
        required: true,
      },
    },
    mounted() {
      this.getContactInfo();
    },
    methods: {
      async getContactInfo() {
        try {
          const token = useAuthStore().token;
          if (!token) {
      console.error('Token not available');
      return;
    }
    if (!this.contact.id) {
      console.error('Contact ID is missing');
      return;
    }
          const response = await axios.get(`http://localhost:8000/api/contact/${this.contact.id}`, {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });
          this.contact.name = response.data.name;
        } catch (error) {
          console.error('Error getting contact info' , error);
        }
      }
    },
  };
  </script>
  
  <style>
  </style>
  