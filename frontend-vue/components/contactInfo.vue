<template>
  <div class="contactInfoCard grid grid-cols-2 gap-3">
    <div class="contactBox">
      <p class="contactMain">Name</p>
      <p class="inputBox contactSub">{{ contact.name }}</p>
    </div>
    <div class="contactBox ml-auto">
      <p class="contactMain">Address</p>
      <p class="inputBox contactSub">{{ contact.adress }}</p>
    </div>
    <div class="contactBox">
      <p class="contactMain">Title</p>
      <p class="inputBox contactSub">{{ contact.position }}</p>
    </div>
    <div class="contactBox ml-auto">
      <p class="contactMain">Phone</p>
      <p class="inputBox contactSub">{{ contact.number }}</p>
    </div>
    <div class="contactBox">
      <p class="contactMain">Profile Picture</p>
      <p class="inputBox contactSub">{{ contact.image ? contact.image : 'None' }}</p>
    </div>
    <div class="contactBox ml-auto">
      <p class="contactMain">Email</p>
      <p class="inputBox contactSub">{{ contact.email }}</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { ref, onMounted, watch } from 'vue';
import { useAuthStore } from '#imports';
import { useContactStore } from '~/stores/contactStore';

export default {
  props: {
    contact: {
      type: Object,
      required: true,
    },
  },
  setup(props) {
    const contactStore = useContactStore();
    const contact = ref(props.contact);

    onMounted(() => {
      contactStore.fetchContacts();
    });

    watch(() => contact.value.id, (newId) => {
      if (newId) {
        getContactInfo();
      }
    });

    const getContactInfo = async () => {
  try {
    const token = useAuthStore().token;
    if (!token) {
      console.error('Token not available');
      return;
    }
    if (!contact.value.id) {
      console.error('Contact ID is missing');
      return;
    }
    const response = await axios.get(`http://localhost:8000/api/contact/${contact.value.id}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    contact.value = response.data;
  } catch (error) {
    console.error('Error getting contact info', error);
  }
};
  },
}
</script>

<style>
</style>