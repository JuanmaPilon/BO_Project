<template>
  <div>
    <main class="container mx-auto flex items-center justify-center -my-10">
      <h1 class="font-extrabold text-5xl text-center mb-12">Welcome!</h1>
      <div class="w-full max-w-md">
        <form @submit.prevent="login">
          <div class="mb-4">
            <label for="email" class="inputText">Email</label>
            <input
              v-model="email"
              type="text"
              id="email"
              name="email"
              class="inputBox"
              placeholder="john@doe.com"
            />
          </div>
          <div>
            <label for="password" class="inputText">Password</label>
            <input
              v-model="password"
              type="password"
              id="password"
              name="password"
              class="inputBox"
              placeholder="**********"
            />
          </div>
        </form>
        <p v-if="loginError" class="text-red-500 mt-2 justify-center flex">Invalid credentials. Please try again.</p>
      </div>
      <button type="button" class="btn mt-10" @click="login">LOGIN</button>
    </main>
  </div>
</template>

<script>
import axios from "axios";
import { useAuthStore, useContactStore } from "#imports";

export default {
  data() {
    return {
      email: "",
      password: "",
      loginError: false,
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post("http://127.0.0.1:8000/api/login", {
          email: this.email,
          password: this.password,
        });
        const { token, contacts } = response.data;
        console.log("Token:", token);
        if (token) {
          useAuthStore().setToken(token);

          if (contacts && Array.isArray(contacts)) {
            useContactStore().setContacts(contacts);
            console.log("Contacts set successfully:", contacts);
          }
          this.$router.push("/contact");
        } else {
          this.loginError = true;
          console.error("Invalid credentials or no contacts available.");
        }
      } catch (error) {
        this.loginError = true;
        console.error("Error during login:", error);
      }
    },
  },
};
</script>

<style>
</style>
