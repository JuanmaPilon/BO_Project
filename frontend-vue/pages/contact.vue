<template>
  <div>
    <header class="text-left ml-4 mt-4">
      <h2 class="p-5 text-3xl font-black">Contacts</h2>
      <div class="p-3 ml-2 mb-4 relative justify-center">
        <div class="relative flex items-center">
          <input
            type="text"
            id="search"
            v-model="searchQuery"
            class="inputBox bg-white pl-8"
          />
          <label for="search" class="inputText absolute left-2 top-1/2 transform -translate-y-1/2">
            <i class="fas fa-search"></i>
          </label>
        </div>
      </div>
    </header>

    <main class="flex flex-col items-center justify-top h-screen">
      <div v-if="loading" class="text-center">
        <p class="text-2xl font-semibold font-roboto">Loading contacts...</p>
      </div>
      <div v-else-if="contacts.length === 0" class="text-center">
        <img src="../static/emptyContact.png" alt="emptyContactsImg" class="mb-4 max-w-96" />
        <p class="text-2xl font-semibold font-roboto">Add new contacts to your database</p>
      </div>
      <div v-else class="flex flex-wrap">
        <div class=" justify-center lg:w-1/3 mx-auto px-16" v-for="contact in contacts" :key="contact.id">
          <contactCard :contact="contact"/>
        </div>
      </div>
      <button class="btn mt-4 hidden sm:block" @click="showModal = true">Add new contacts</button>
      <contactModal v-show="showModal" @close-modal="showModal = false" @contact-added="handleContactAdded($event)"/>
      <button class="btn-smol sm:hidden" @click="addNewContact">+</button>
    </main>
  </div>
</template>

<script>
import  contactCard  from '#components'
import  contactModal from '#components'
import axios from 'axios';
import { useAuthStore } from '#imports';

export default {
  data() {
    return {
      searchQuery: "",
      contacts: [],
      loading: true,
      showModal: false,
    };
  },
  methods: {
    async getContact() {
      try {
        const token = useAuthStore().token;
        const response = await axios.get('http://localhost:8000/api/contact', {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        this.contacts.splice(0, this.contacts.length, ...response.data.contacts);
        this.loading = false;
      } catch (error) {
        console.error('Error getting contacts:', error);
        this.loading = false;
      }
    },
    handleContactAdded(contact) {
      this.contacts.push(contact);
    }
  },
  mounted() {
    this.getContact();
  },
};
</script>

<style scoped>
</style>
