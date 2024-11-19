<script setup>
import FrontLayout from '@/Layouts/FrontLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    title: String,
    detail: String,
})

const ourImage = () => {
    return "/img/home/messageImage.svg";
};
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
                        <img :src="ourImage()" alt="推廣數位工具" style="width: 100%; height: 130px; border-radius: 20px">
                    </div>
                </div>
            </div>
        </div>

        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="bg-light d-flex flex-column justify-content-center p-4"
                                    style="width: 100%; border-radius: 15px;">
                                    <img src="/img/contact_us/moda.png" alt="地址:臺北市中正區延平南路143號"
                                        title="地址:臺北市中正區延平南路143號" style="border-radius: 15px; text-align: center;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column justify-content-center p-4 ctca-font"
                                    style="font-size: 1.3em; color: #fff;">
                                    <p v-html="props.detail"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </FrontLayout>
</template>