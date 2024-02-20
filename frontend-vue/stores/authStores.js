import { defineStore } from 'pinia';

export const useAuthStore = defineStore({
  id: 'auth',
  state: () => ({
    token: null,
  }),
  getters: {
    isAuthenticated: (state) => !!state.token,
  },
  actions: {
    setToken(token) {
      this.token = token;
    },
    clearToken() {
      this.token = null;
    },
  },
});