<script setup>
import FrontLayout from '@/Layouts/FrontLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import LinkError from '@/Components/LinkError.vue';
import { ref, onUnmounted } from 'vue';
import axios from 'axios';
import SwiperCarouselVue from "@/Components/SwiperCarousel.vue";

const timer = ref()

const url = ref('https://')

const errors = ref('')

const button_state = ref(false)

const props = defineProps({
    title: String,
})

const create = () => {

    button_state.value = true

    if (url.value == '') {
        errors.value = '網址不能為空'
        timer.value = setTimeout(() => {
            errors.value = ''
            button_state.value = false
        }, 3000)
    } else {

        if (isValidHttpUrl(url.value)) {

            $('#computeModal').modal({ backdrop: 'static', keyboard: false });
            $('#computeModal').modal('show');

            var domain = router.page.props.ziggy.url + '/compute'

            axios.post(domain, {
                url: url.value
            })
                .then(
                    (response) => {

                        if (response.data.error) {
                            if (response.data.error_data) {
                                error_show('B')
                            } else {
                                error_show('A')
                            }
                        } else {

                            $('#computeModal').modal('hide');

                            var response_arr = {};
                            response_arr['css'] = response.data.css;
                            response_arr['img'] = response.data.img;
                            response_arr['js'] = response.data.js;
                            response_arr['url'] = response.data.url;
                            response_arr['other'] = response.data.other;
                            response_arr['video'] = response.data.video;
                            response_arr['green'] = response.data.green;

                            if (response.data.uuid == undefined) {
                                error_show('C')
                            } else {
                                router.get('/compute_result/' + response.data.uuid)
                            }
                        }

                    }
                )
                .catch((error) => {
                    error_show()
                })
        } else {
            error_show('A')
        }

    }
}

onUnmounted(() => {
    clearTimeout(timer.value)
    timer.value = ''
})

const error_show = (str = '') => {
    if (str == '') {
        errors.value = '發生錯誤,請稍後在試!!'
    } else if (str == 'B') {
        errors.value = '嘗試次數過多，請放慢請求速度!!'
    } else {
        errors.value = '網址錯誤,請確認!!'
    }

    timer.value = setTimeout(() => {
        $('#computeModal').modal('hide');
    }, 3000)

    timer.value = setTimeout(() => {
        errors.value = ''
        button_state.value = false
    }, 5000)
}

const isValidHttpUrl = (str = '') => {
    const pattern = new RegExp(
        '^(https?:\\/\\/)?' + // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
        '(\\#[-a-z\\d_]*)?$', // fragment locator
        'i'
    );
    return pattern.test(str);
}

</script>

<template>

    <Head :title="props.title" />
    <FrontLayout>
        <!-- <div class="container-xxl p-0 mb-3">
            <SwiperCarouselVue />
        </div> -->

        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-5 pt-4">
                        <a href="#C" name="C" accesskey="C" id="ace_m" target="_self" title="中間區域"
                            style="color: #fff;">:::</a>
                        <a href="/" class="ctca-font ctca-font-size-title" title="到首頁">首頁</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container text-center">
            <div class="text-center wow fadeInUp display_flex">
                <h1 class="carbon_gold ctca-font carbon_title" style="padding-top: 25px; font-size: 1.8em;">網頁碳排計算器</h1>
            </div>

            <div>
                <div class="row">
                    <div class="col-12 col-sm-2">
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-floating ">
                            <input type="text" class="form-control ctca-font" id="url" v-model="url" title="請輸入網址"
                                placeholder="請輸入網址" style="border-radius: 5px; border: 3px solid #ffc107;"
                                autocomplete="off" @keyup.enter="create">
                            <label for="url">請輸入網址</label>
                        </div>
                        <LinkError class="mt-2" :message="errors" />

                    </div>
                    <div class="col-12 col-sm-2" style="margin-top: .625rem !important;">
                        <div class="d-grid gap-2 mx-auto">
                            <button type="button" class="btn btn-warning ctca-font" alt="送出"
                                style="border-radius: 10px;" :disabled="button_state" @click="create">送出</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="computeModal" tabindex="-1" aria-hidden="true" data-backdrop="static"
            data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title ctca-font">讀取資料</p>
                    </div>
                    <div class="modal-body">
                        <button class="btn btn-primary" type="button" disabled alt="作業中">
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status ctca-font"> 作業中...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" style="padding-top: 2rem; text-align: center;">
            <p class="ctca-font" style="font-size: 1.3em; font-weight: 700; color: white;">
                你知道，網頁也會產生碳排放量嗎?
            </p>
        </div>

        <div class="container" style="padding-top: 1.1rem; text-align: center;">
            <p class="ctca-font" style="font-size: 1.1em; font-weight: 700; color: white; text-indent: 2em;">
                全球的網際網路消耗了大量電力，大約每年1021太瓦時(TWh)，這是全台灣整年度用電量2794.5億度的3650倍之多。從資料中心到網路傳輸過程，再到我們手中的數十億個連線裝置，都一直不斷地消耗電力，而這其中所產生的碳排放量幾乎等於全球航空業所產生的碳排放！
            </p>
        </div>

        <div class="container" style="text-align: center;">
            <p class="ctca-font" style="font-size: 1.1em; font-weight: 700; color: white; text-indent: 2em;">
                本站所開發的「網頁碳排計算器」，可以協助大家估算自己設計或瀏覽的網頁產生了多少的碳排放量，估算結果雖然並非是一個非常精準的數據，但希望可以透過這樣的量化工具，具體呈現網頁所產生的碳排量，讓所有人可以建立起數位行為之綠色意識，並用更永續的方式來設計與使用網際網路！
            </p>
        </div>

        <div class="container" style="text-align: center;">
            <p class="ctca-font" style="font-size: 1.1em; font-weight: 700; color: white; text-indent: 2em;">
                （想了解更多請參考本案產出之<a href="/gain/58/8" title="導向網路永續設計指引">網路永續設計指引</a>）
            </p>
        </div>

    </FrontLayout>
</template>

<style scoped>
.img-fluid {
    width: 70%;
}
</style>
