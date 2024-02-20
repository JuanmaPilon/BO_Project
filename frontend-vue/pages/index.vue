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
          <button type="submit" class="btn">LOGIN</button>
        </form>
      </div>
    </main>
  </div>
</template>

<script>
import axios from 'axios';

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
        console.log(response.data);
        this.$router.push('/contact');

      } catch (error) {
        console.error('Error during login:', error);
      }
    },
  },
};
</script>

<style>
</style>
