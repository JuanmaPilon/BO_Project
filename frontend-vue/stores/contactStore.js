import { defineStore } from 'pinia';
import { useAuthStore } from './authStore';
import axios from 'axios';

export const useContactStore = defineStore('contact', {
  state: () => ({
    contacts: [],
  }),
  actions: {
    async fetchContacts() {
      try {
        const token = useAuthStore().token;
        const response = await axios.get('http://localhost:8000/api/contact', {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        this.contacts = response.data;
      } catch (error) {
        console.error('Error fetching contacts', error);
      }
    },
  },
});
