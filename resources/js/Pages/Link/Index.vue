<script setup>
import FrontLayout from '@/Layouts/FrontLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    title: String,
    result_array: {
        default: () => ({}),
    },
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

        <div class="container text-center">
            <div class="row">
                <div class="col-md-6" v-for="(value, key) in result_array" :key="key">
                    <div class="card bg-dark">
                        <div class="card-body">
                            <ul class="list-group" style="border-radius: 5px;">
                                <li class="list-group-item carbon_gold_back carbon_black_title ctca-font"
                                    aria-current="true">{{
                                        value[0] }}</li>
                                <li class="list-group-item" style="background-color: #202020;"
                                    v-for="(value_detail, key_detail) in value[1]" :key="key_detail">
                                    <a :href="value_detail.url" class="card-detail" target="_blank" rel="noopener"
                                        style="color: white; text-decoration: underline;"
                                        alt="{{ value_detail.name }}">{{ value_detail.name }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </FrontLayout>
</template>