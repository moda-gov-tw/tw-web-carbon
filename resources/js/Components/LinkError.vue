<script setup>
defineProps(['message']);
</script>

<template>
    <div v-show="message">
        <p class="link_error">
            {{ message }}
        </p>
    </div>
</template>
