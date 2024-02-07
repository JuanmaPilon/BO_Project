<template>
  <div class="modal-overlay bg-opacity-70 bg-black flex items-center justify-center fixed inset-0">
    <div class="modal bg-white text-center p-8 rounded-lg">
      <h6 class="font-bold text-2xl mb-4">Enter contact details:</h6>
      <form @submit.prevent="submitContact">
        <div class="mb-4">
          <label for="name" class="labelForm">Name:</label>
          <input v-model="contact.name" type="text" id="name" name="name" class="inputBox">
        </div>
        <div class="mb-4">
          <label for="position" class="lableForm">Title:</label>
          <input v-model="contact.position" type="text" id="position" name="position" class="inputBox">
        </div>
        <div class="mb-4">
          <label for="adress" class="labelForm">Address:</label>
          <input v-model="contact.adress" type="text" id="adress" name="adress" class="inputBox">
        </div>
        <div class="mb-4">
          <label for="email" class="labelForm">Email:</label>
          <input v-model="contact.email" type="email" id="email" name="email" class="inputBox">
        </div>
        <div class="mb-4">
          <label for="number" class="labelForm">Phone:</label>
          <input v-model="contact.number" type="text" id="number" name="number" class="inputBox">
        </div>
        <button type="submit" class="inputBox w-20">Submit</button>
      </form>
    </div>
    <div class="close absolute top-4 right-4 cursor-pointer" @click="$emit('close-modal')">
      <button class="btn-close w-10 h-10">X</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      contact: {
        name: '',
        position: '',
        adress: '',
        email: '',
        number: '',
      },
    };
  },
  methods: {
    submitContact() {
      axios.post('http://localhost:8000/api/contact', this.contact).then(res => {
        console.log(res, 'res');
        alert(res.data.message);

        this.contact.name = '';
        this.contact.position = '';
        this.contact.adress = '';
        this.contact.email = '';
        this.contact.number = '';
      })
      .catch(error => {
        console.log('Response data:', error.response.data);
    console.error('Error submitting form:', error);
    alert('Error submitting form. Please try again.');
   
  });;
      console.log('Form submitted:', this.contact);
      this.$emit('close-modal');
    },
  },
};
</script>

<style scoped>
</style>
