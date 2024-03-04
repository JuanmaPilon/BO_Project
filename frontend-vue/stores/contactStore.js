import { defineStore } from 'pinia';
import { useAuthStore } from './authStore';
import axios from 'axios';

export const useContactStore = defineStore('contact', {
  state: () => ({
    contacts: [],
    selectedContactId: null,
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
    setSelectedContactId(id) {
      this.selectedContactId = id;
    },
    getSelectedContactId() {
      return this.selectedContactId;
    },
    setContacts(contacts) {
      this.contacts = contacts;
    }
  },
});
