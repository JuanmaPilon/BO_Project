<template>
  <NuxtLink :to="{ name: 'contactProfile', params: { id: contact.id } }" @click="selectContact(contact.id)">
      <div class="contactCard bg-white rounded-lg p-4 flex items-center shadow mb-4">
        <img src="../static/emptyContact.png" :alt="contact.name" class="contactImage w-16 h-16 rounded-full mr-4" />
        <div class="contactInfo flex-grow">
          <p class="contactName text-lg font-bold mb-1">{{ contact.name }}</p>
          <p class="description text-sm text-gray-400 mb-2">{{ contact.position }}</p>
          <i class="fas fa-arrow-right"></i>
        </div>
      </div>
    </NuxtLink>
  </template>
  
  <script>
  import { useContactStore } from '#imports';
  
  export default {
  props: {
    contact: {
      type: Object,
      required: true,
    },
  },
  methods: {
    selectContact(id) {
      useContactStore().setSelectedContactId(id);
    },
  },
};
</script>

<style>
</style>