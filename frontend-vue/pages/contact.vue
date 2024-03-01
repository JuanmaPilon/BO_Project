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
    <main class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-2 items-center justify-center h-screen md:mx-80">
      <div v-if="loading" class="text-center col-span-full">
        <p class="text-2xl font-semibold font-roboto">Loading contacts...</p>
      </div>
      <div v-else-if="contacts.length === 0" class="text-center col-span-full">
        <img src="../static/emptyContact.png" alt="emptyContactsImg" class="mb-4 max-w-96" />
        <p class="text-2xl font-semibold font-roboto">Add new contacts to your database</p>
      </div>
      <NuxtLink
        v-else
        v-for="contact in contacts"
        :key="contact.id"
        :to="{ name: 'contactProfile', params: { id: String(contact.id) }, replace: true }"
        class="col-span-1 sm:col-span-1 md:col-span-1 lg:col-span-1 mb-1"
      >
        <contactCard :contact="contact" />
      </NuxtLink>
    </main>
    <div class="flex items-center justify-center h-screen">
      <button class="btn-smol sm:hidden" @click="addNewContact">+</button>
    </div>
    <div class="flex items-center justify-center h-screen">
    <button class="btn mt-4  sm:block flex items-center justify-center" @click="showModal = true">Add new contacts</button>
    </div>
    <contactModal v-show="showModal" @close-modal="showModal = false" @contact-added="handleContactAdded($event)" />
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
