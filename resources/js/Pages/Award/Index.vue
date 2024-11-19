<script setup>
import FrontLayout from '@/Layouts/FrontLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
    title: String,
    award_list: {
        default: () => ({}),
    },
})

const ourImage = () => {
    return "/img/home/messageImage.svg";
};

const detail = (id) => {
    router.visit(`/award/${id}`, { preserveScroll: false })
}

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

        <div class="container-xxl pt-5">
            <table class="table table-bordered table-dark" style="border-radius: 10;">
                <thead>
                    <tr>
                        <th class="ctca-font table_font" scope="col" style="text-align: center">標題</th>
                        <th class="ctca-font table_font" scope="col" style="text-align: center">日期</th>
                        <th class="ctca-font table_font" scope="col" style="text-align: center">詳情</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="award_data in award_list.data" :key="award_data.id">
                        <td class="ctca-font table_font">{{ award_data.title }}</td>
                        <td class="ctca-font table_font" style="text-align: center">{{ award_data.award_date }}</td>

                        <td style="text-align: center"><button type="button"
                                class="btn btn-warning ctca-font table_font" style="border-radius: 10px;" alt="詳情"
                                @click="detail(award_data.id)">詳情</button></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="result-show">
            <div class="d-flex justify-content-center">
                <div class="search-result">
                    <Pagination :links="award_list" />
                </div>
            </div>
        </div>

    </FrontLayout>
</template>
