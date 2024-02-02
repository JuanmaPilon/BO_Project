<template>
    <div class="contactInfoCard bg-white rounded-lg p-3 items-center shadow lg:w-1/3 justify-center flex flex-wrap mx-auto">
      <div class="contactInfo flex-grow w-full mb-2">
        <p class="contactName text-lg font-bold mb-1">Email: {{ contact.Email }}</p>
        <p class="description text-sm text-gray-400 mb-2">Descripción: {{ contact.adress }}</p>
      </div>
    </div>
  </template>
  
  <script>
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
  