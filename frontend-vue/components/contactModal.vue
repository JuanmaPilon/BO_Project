<template>
    <div class="modal-overlay bg-opacity-70 bg-black flex items-center justify-center fixed inset-0">
      <div class="modal bg-white text-center p-8 rounded-lg">
        <h6 class="font-bold text-2xl mb-4">Saved!</h6> 
        <p class="text-base mb-4">ADDDINGGGG CONTACT</p>
        <button class="pinkBox">Submit??</button>
      </div>
      <div class="close absolute top-4 right-4 cursor-pointer" @click="$emit('close-modal')">
        <button class="btn-close w-10 h-10">X</button>
      </div>
    </div>
  </template>
  
  <script>
    export default {
  }
  </script>

<style scoped>

</style>
  