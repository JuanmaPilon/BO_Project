<template>
  <div class="modal-overlay bg-opacity-70 bg-black flex items-center justify-center fixed inset-0">
    <div class="modal bg-white text-center p-8 rounded-lg">
      <h6 class="font-bold text-2xl mb-4">Enter contact details:</h6>
      <Form :validation-schema="schema" @submit="submitContact">
        <div class="mb-4">
          <label for="name" class="labelForm">Name:</label>
          <Field v-model="contact.name" type="text" id="name" name="name" class="inputBox" />
          <ErrorMessage name="name" />
        </div>
        <div class="mb-4">
          <label for="position" class="lableForm">Title:</label>
          <Field v-model="contact.position" type="text" id="position" name="position" class="inputBox" />
          <ErrorMessage name="position" />
        </div>
        <div class="mb-4">
          <label for="adress" class="labelForm">Address:</label>
          <Field v-model="contact.adress" type="text" id="adress" name="adress" class="inputBox" />
          <ErrorMessage name="adress" />
        </div>
        <div class="mb-4">
          <label for="email" class="labelForm">Email:</label>
          <Field v-model="contact.email" type="email" id="email" name="email" class="inputBox" :rules="validateEmail" />
          <ErrorMessage name="email" />
        </div>
        <div class="mb-4">
          <label for="number" class="labelForm">Phone:</label>
          <Field v-model="contact.number" type="text" id="number" name="number" class="inputBox" />
          <ErrorMessage name="number" />
        </div>
        <button class="inputBox w-20">Submit</button>
      </Form>
    </div>
    <div class="close absolute top-4 right-4 cursor-pointer" @click="$emit('close-modal')">
      <button class="btn-close w-10 h-10">X</button>
    </div>
  </div>
</template>

<script>
import { Form, Field, ErrorMessage} from 'vee-validate';
import axios from 'axios';
import * as yup from 'yup';



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
    schema: yup.object({
    name: yup.string().required().min(3),
    position: yup.string().required().min(3),
    email: yup.string().email().required(),
    number: yup.number().required().typeError('must be a number'),
    adress: yup.string().required(),
}),
    };
  },
  components: {
    Form,
    Field,
    ErrorMessage
},
  methods: {
    submitContact(values) {
      console.log(values, null, 2);
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
    validateEmail (value) {
        if (!value) {
        return 'This field is required';
      }
      const regex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
      if (!regex.test(value)) {
        return 'This field must be a valid email';
      } return true
    },
  },
};
</script>

<style scoped>
</style>
