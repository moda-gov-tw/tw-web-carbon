<script setup>
import NavbarVue from '@/Components/Front/Navbar.vue';
import Footer from '@/Components/Front/Footer.vue';

const emit = defineEmits(['close', 'open']);

</script>

<template>
    <NavbarVue class="bg-dark" />
    <main class="bg-dark" id="content">
        <slot />
    </main>
    <Footer class="bg-dark" />
</template>