<script setup>
import FrontLayout from '@/Layouts/FrontLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
    title: String,
    gain_list: {
        default: () => ({}),
    },
    gain_type_list: {
        default: () => ({}),
    },
    type: String,
    type_desc: String
})

const urlTitle = (str) => {
  return "到"+str;
};

const backUrl = (type) => {
  return "/gain/" + type;
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
                        <a href="/" class="ctca-font ctca-font-size-title" title="到首頁">首頁</a>>
                        <a href="/gain" :title="urlTitle(props.title)" class="ctca-font ctca-font-size-title">{{
                            props.title
                            }}</a>>
                        <a :href="backUrl(props.type)" :title="urlTitle(props.type_desc)"
                            class="ctca-font ctca-font-size-title">{{ props.type_desc
                            }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-xxl pt-5">
            <table class="table table-bordered table-dark" style="border-radius: 10;">
                <thead>
                    <tr>
                        <th class="ctca-font table_font" scope="col" style="text-align: center">標題</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="gain_data in gain_list.data" :key="gain_data.id">
                        <td class="ctca-font table_font">
                            <a class="nav-link" :href="'/gain/' + gain_data.id + '/' + gain_data.gain_type_id">
                                <span class="ctca-font">{{
                                    gain_data.title }}</span>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="result-show">
            <div class="d-flex justify-content-center">
                <div class="search-result">
                    <Pagination :links="gain_list" />
                </div>
            </div>
        </div>

    </FrontLayout>
</template>

<style scoped>
a:focus {
    background: rgba(255, 240, 0, 1);
    color: black;
}
</style>