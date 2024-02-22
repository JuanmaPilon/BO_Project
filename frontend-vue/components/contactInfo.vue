<template>
    <div class="contactInfoCard">
      
      <div class="contactBox w-48 mb-3">
        <p class="contactMain text-lg font-bold mb-1">Name</p>
        <p class="inputBox text-sm text-gray-400 mb-2">Dev{{ contact.name }}</p>
      </div>

    </div>
    
  </template>
  
  <script>
  import axios from 'axios';
  import { useAuthStore } from '#imports';

  export default {
    props: {
      contact: {
        type: Object,
        required: true,
      },
    },
  };
  </script>
  
  <style>
  </style>
  