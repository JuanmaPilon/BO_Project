<template>
  <div>
    <header class="text-left ml-4 mt-4">
      <h2 class="p-5 text-3xl font-semibold">Contacts</h2>
      <div class="p-3 ml-2 mb-4 relative justify-center">
        <div class="relative flex items-center">
          <input
            type="text"
            id="search"
            v-model="searchQuery"
            class="inputBox bg-white pl-8"
          />
          <label for="search" class="inputText absolute left-2 top-1/2 transform -translate-y-1/2">
            <i class="fas fa-search"></i>
          </label>
        </div>
      </div>
    </header>

    <main class="container">
      <div v-if="contacts.length === 0" class="text-center">
      </div>
      <div class="flex justify-center">
        <button class="btn mt-4 hidden sm:block" @click="addNewContact">Add new contacts</button>
        <button class="btn-smol mt-4 sm:hidden" @click="addNewContact">+</button>
      </div>
    </main>
  </div>
</template>

<script>
export default {
  data() {
    return {
      searchQuery: "",
      contacts: [],
    };
  },
  methods: {
    addNewContact() {},
  },
};
</script>

<style scoped></style>
