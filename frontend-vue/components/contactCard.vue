<template>
    <div class="contactCard">
        <img :src="contactImage" :alt="contactName" class="contactImage" />
        <div class="contactInfo">
            <p class="contactName">Nombre :{{ contact.name }}</p>
            <p class="contactId">Id :{{ contact.id }}</p>
            <p class="contactEmail">eMail: {{ contact.email }}</p>
            <p class="contactImg">ImaginAllDeppl: {{ contact.img }}</p>
            <NuxtLink to="/contactProfile"></NuxtLink>
            <i class="fas fa-arrow-right"></i>
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

<style lang="scss" scoped>

</style>