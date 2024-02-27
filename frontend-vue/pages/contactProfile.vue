<template>
  <div
    class="profileBg bg-gray-200 mx-20 justify-center my-10 rounded-lg p-36 overflow-visible relative"
  >
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
  <contactInfo :contact="contact" />

</template>

<script>
  import contactInfo from '#components';
  import { useAuthStore } from '#imports';
  import { useContactStore } from '#imports';
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
    async fetchContacts() {
      try {
        const token = useAuthStore().token;
        const response = await axios.get('http://localhost:8000/api/contact', {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        this.contact = response.data.contacts;
      } catch (error) {
        console.error('Error getting contacts:', error);
      }
    },
  },
  mounted() {
    this.fetchContacts();
 },
};
</script>

<style></style>
