<script setup>
import FrontLayout from '@/Layouts/FrontLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    title: String,
    code: Number,
    message: String
})
</script>

<template>

    <Head :title="props.title" />
    <FrontLayout>
        <div class="container-xxl py-6 pb-5 wow fadeInUp">
            <div class="container text-center">
                <div class="justify-content-center">
                    <div class="col-lg-12 pb-4">
                        <i class="bi bi-exclamation-triangle display-1 text-primary p-5"></i>
                    </div>
                    <div class="col-lg-12 pb-4">
                        <h1 class="mb-4">{{ props.title }}</h1>
                    </div>
                    <div class="col-lg-12 pb-4">
                        <Link :href="route('home')" class="btn btn-primary rounded-pill py-3 px-5">回首頁</Link>
                    </div>
                </div>
            </div>
        </div>

    </FrontLayout>
</template>