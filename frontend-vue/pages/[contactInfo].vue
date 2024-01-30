<template>
    <div>
        <p>Nombre: {{ contactInfo }}</p>
        <p>Apellido: {{  }}</p>
    </div>
</template>

<script setup>
    const { contactInfo } = useRoute().params
</script>

<style scoped>

</style>