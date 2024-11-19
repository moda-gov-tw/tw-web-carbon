<script setup>
import FrontLayout from '@/Layouts/FrontLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    title: String,
    detail: String,
})
</script>

<template>

    <Head :title="props.title" />
    <FrontLayout>
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-5 pt-4">
                        <a href="#C" name="C" accesskey="C" id="ace_m" target="_self" title="中間區域"
                            style="color: #fff;">:::</a>
                        <p class="ctca-font ctca-font-size-title" style="color: #fff;">{{ props.title }}</p>
                    </div>
                    <div class="col-lg-7">
                        <img src="img/home/messageImage.svg" alt="推廣數位工具" style="width: 100%; height: 130px; border-radius: 20px">
                    </div>
                </div>
            </div>
        </div>

        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-12">
                        <div class="row g-4 mb-3 pb-3">
                            <p class="card-detail" v-html="props.detail"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </FrontLayout>
</template>