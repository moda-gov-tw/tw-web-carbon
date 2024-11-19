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
                        <h1 class="ctca-font ctca-font-size-title" style="color: #fff;">{{ props.title }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-xxl py-1">
            <div class="container ctca-font card-detail">
                <p>本網站依無障礙網頁設計原則建置，網站的主要內容分為2大區塊： 1. 上方標題區塊、2. 中央內容區塊。</p>
                <p>下列為本網站使用鍵盤快速鍵 (Access Key) 操作方式說明：</p>
                <p>Alt +U：上方選單區，包括回首頁、網站導覽，功能表等。</p>
                <p>Alt +C：主要內容區，此區塊呈現網頁主要內容資訊，包括成果專區、相關連結等。</p>
                <p>如果您的瀏覽器是 Firefox，快速鍵的使用方法是 Shift+Alt+(快速鍵字母)， 例如 Shift+Alt+C 會跳至網頁中央區塊，以此類推。</p>
            </div>
        </div>

        <div class="container-xxl py-1 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card bg-dark">
                            <div class="card-body">
                                <ul class="list-group" style="border-radius: 5px;">
                                    <li class="list-group-item carbon_gold_back carbon_black_title ctca-font"
                                        aria-current="true">
                                        網站導覽</li>
                                    <li class="list-group-item"><a :href="route('home')" class="nav-link ctca-font"
                                            rel="noopener" alt="首頁" style=" text-decoration: underline;">首頁</a></li>
                                    <li class="list-group-item card-detail"><a :href="route('gain')"
                                            class="nav-link ctca-font" rel="noopener" alt="成果專區"
                                            style="text-decoration: underline;">成果專區</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </FrontLayout>
</template>