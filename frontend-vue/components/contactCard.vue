<template>
    <NuxtLink to="contactProfile">
    <div class="contactCard bg-white rounded-lg p-4 flex items-center shadow mb-4">
        <img src="../static/emptyContact.png" :alt="contactName" class="contactImage w-16 h-16 rounded-full mr-4" />
        <div class="contactInfo flex-grow">
            <p class="contactName text-lg font-bold mb-1">{{ contact.name }}</p>
            <p class="description text-sm text-gray-400 mb-2">{{ contact.position }}</p>
            <i class="fas fa-arrow-right"></i>
        </div>
    </div>
</NuxtLink>
</template>

<script>
import axios from 'axios';
    export default {
        name: "contact",
        data() {
            return {
                contact: {}
            }
        },
        mounted() {
            this.getContact();
        },
        methods: {
            getContact() {
  axios.get('http://localhost:8000/api/contact')
    .then(res => {
      console.log('Respuesta del servidor:', res);
      this.contacts = res.data;
    })
    .catch(error => {
      console.error('Error en la solicitud:', error);
    });
},

        },
        props: {
            contact: {
                type: Object,
                required: true,
            },
        },
    };
</script>

<style >

</style>