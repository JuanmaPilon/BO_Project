<template>
    <NuxtLink to="contactProfile.vue">
    <div class="contactCard bg-white rounded-lg p-4 flex items-center shadow mb-4">
        <img src="../static/emptyContact.png" :alt="contactName" class="contactImage w-16 h-16 rounded-full mr-4" />
        <div class="contactInfo flex-grow">
            <p class="contactName text-lg font-bold mb-1">{{ contact.name }}</p>
            <p class="description text-sm text-gray-400 mb-2">{{ contact.description }}</p>
            <i class="fas fa-arrow-right"></i>
        </div>
    </div>
</NuxtLink>
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

<style >

</style>