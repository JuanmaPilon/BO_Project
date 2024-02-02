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
      <div v-if="contacts.length === 0" class="text-center">
        <img src="../static/emptyContact.png" alt="emptyContactsImg" class="mb-4 max-w-96" /> <!-- could not resolve the issue with config of nuxtimg-->
        <p class="text-2xl font-semibold font-roboto">Add new contacts to your database</p>
      </div>
      <div v-else class="flex flex-wrap">
        <div class=" justify-center lg:w-1/3 mx-auto px-16" v-for="contact in contacts" :key="contact.id">
          <contactCard :contact="contact"/>
      </div>
    </div>
    <button class="btn mt-4 hidden sm:block" @click="addNewContact">Add new contacts</button>
      <button class="btn-smol sm:hidden" @click="addNewContact">+</button>
    </main>
  </div>
</template>

<script>
import  contactCard  from '#components'

export default {
  data() {
    return {
      searchQuery: "",
      contacts: [],
    };
  },
  methods: {
    addNewContact() {},
  },
  mounted() {
    this.contacts = [
      {id: 1, name: 'Sujeto de proba 1' , description: 'CEO'},
      {id: 2, name: 'Sujeto de proba 2' , description: 'Dev'},
      {id: 2, name: 'Sujeto de proba 2' , description: 'Dev'},
      {id: 2, name: 'Sujeto de proba 2' , description: 'Dev'},
      {id: 2, name: 'Sujeto de proba 2' , description: 'Dev'},
      {id: 2, name: 'Sujeto de proba 2' , description: 'Dev'},
      {id: 2, name: 'Sujeto de proba 2' , description: 'Dev'},
      {id: 2, name: 'Sujeto de proba 2' , description: 'Dev'},
      {id: 2, name: 'Sujeto de proba 2' , description: 'Dev'},
    ]
  },
};
</script>

<style scoped></style>
