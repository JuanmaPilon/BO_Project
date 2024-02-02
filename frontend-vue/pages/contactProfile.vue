<template>
  <div
    class="profileBg bg-gray-200 mx-20 justify-center my-10 rounded-lg p-36 overflow-visible relative"
  >
    <div class="profileHeader relative">
      <button
        class="editButton btn absolute -bottom-28 -right-28 px-10 py-3"
        @click="editContact"
      >
        EDIT
      </button>
      <img
        src="../static/emptyContact.png"
        alt="profileImage"
        class="block mx-auto object-cover h-40 w-40 absolute bottom-[-220px] left-1/2 transform -translate-x-1/2"
      />
    </div>
  </div>
  <contactInfo :contact="contact" />

</template>

<script>
  import contactInfo from '#components';

export default {
  data() {
    return {
        contact: [],
    };
  },
  methods: {
    editContact() {

    },
  },
  mounted() {
    this.contacts = [
      {Email: 'pedritoOMG@bayoo.com'},
    ]
  },
};
</script>

<style></style>
