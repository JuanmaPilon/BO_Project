<template>
  <div>
    <button class="backButton backButtonMd" @click="goBack">
      <i class="fas fa-arrow-left fa-lg"></i>
      <span class="contactSub">Back</span>
    </button>
    <div class="relative">
      <div class="grayBgSqr grayBgSqrMd">
        <button v-if="!editing" class="editButtonMd" @click="editingContact">
          EDIT
        </button>
        <button v-if="editing" class="editButtonMd" @click="saveChanges">
          SAVE
        </button>
        <img
          v-if="!loadingContactDetails && contact.image && !imageError"
          :src="contact.image"
          alt="profileImage"
          class="profileImage profileImageMd"
          @load="handleImageLoad"
          @error="handleImageError"
        />
        <img
          v-if="!loadingContactDetails && (!contact.image || imageError)"
          src="../static/emptyContact.png"
          alt="emptyProfileImage"
          class="profileImage profileImageMd"
        />
      </div>
      <div class="profileHeader profileHeaderMd">
        <h1 class="inputText">{{ contact.name }}</h1>
        <p class="labelForm mb-5">{{ contact.position }}</p>
      </div>
      <div class="contactInfoContainer mx-20">
        <contactInfo v-if="!editing" :contact="contact" />
        <editContactInfo
          v-if="editing"
          :contact="contact"
          @saveChanges="saveChanges"
        />
      </div>
    </div>
    <button v-if="!editing" class="editButton" @click="editingContact">
      EDIT
    </button>
  </div>
</template>

<script>
import contactInfo from "#components";
import editContactInfo from "#components";
import { useAuthStore, useContactStore } from "#imports";
import axios from "axios";

export default {
  data() {
    return {
      contact: {},
      loadingContactDetails: true,
      imageError: false,
      editing: false,
    };
  },
  methods: {
    async fetchContacts(selectedContactId) {
      try {
        const token = useAuthStore().token;
        const response = await axios.get("http://localhost:8000/api/contact", {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        if (
          Array.isArray(response.data.contacts) &&
          response.data.contacts.length > 0
        ) {
          const foundContact = response.data.contacts.find(
            (contact) => contact.id === selectedContactId
          );
          if (foundContact) {
            this.contact = { ...foundContact, image: foundContact.image || "" };
            console.log("Contact data:", this.contact);
          } else {
            console.error("Contact not found with ID:", selectedContactId);
          }
        } else {
          console.error("No contacts found in the response.");
        }
      } catch (error) {
        console.error("Error getting contacts:", error);
      } finally {
        this.loadingContactDetails = false;
      }
    },
    editingContact() {
      this.editing = true;
    },
    async saveChanges(updatedContact) {
      try {
        const response = await axios.put(
          `http://localhost:8000/api/contact/${this.contact.id}/edit`,
          updatedContact,
          {
            headers: {
              Authorization: `Bearer ${useAuthStore().token}`,
            },
          }
        );

        if (response.status === 200) {
          console.log("Contact updated successfully");
          this.contact = response.data.contact;
          this.editing = false;
        } else {
          console.error(
            "Failed to update contact. Unexpected response status:",
            response.status
          );
        }
      } catch (error) {
        if (error.response && error.response.status === 401) {
          console.error("Unauthorized. Redirecting to login page.");
        } else {
          console.error(
            "Error updating contact:",
            error.response ? error.response.data : error.message
          );
        }
      }
    },
    handleImageError() {
      this.imageError = true;
    },
    goBack() {
      this.$router.push("/contact");
    },
  },
  mounted() {
    const selectedContactId = useContactStore().getSelectedContactId() || 0;
    this.fetchContacts(selectedContactId);
  },
};
</script>

<style>
</style>
