<template>
  <div>
    <main class="container mx-auto flex items-center justify-center -my-10">
      <h1 class="font-extrabold text-5xl text-center mb-12">Welcome!</h1>
      <div class="w-full max-w-md">
        <form @submit.prevent="login">
          <div class="mb-4">
            <label for="email" class="inputText">Email</label>
            <input v-model="email" type="text" id="email" name="email" class="inputBox" placeholder="john@doe.com"/>
          </div>
          <div>
            <label for="password" class="inputText">Password</label>
            <input v-model="password" type="password" id="password" name="password" class="inputBox" placeholder="**********"/>
          </div>
        </form>
      </div>
      <button type="button" class="btn" @click="login">LOGIN</button>
    </main>
  </div>
</template>

<script>
import axios from 'axios';
import { useAuthStore } from '#imports';

export default {
  data() {
    return {
      email: '',
      password: '',
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/login', {
          email: this.email,
          password: this.password,
        });
        useAuthStore().setToken(response.data.token);
        console.log(response.data.token);
        this.$router.push('/contact');

      } catch (error) {
        console.error('Error during login:', error);
      }
    },
    async getContacts() {
      try {
        const token = useAuthStore().token;
        const response = await axios.get('http://localhost:8000/api/contact', {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        this.contacts = response.data.contacts;
      } catch (error) {
        console.error('Error getting contacts:', error);
      }
    },
  },
};
</script>

<style>
</style>
