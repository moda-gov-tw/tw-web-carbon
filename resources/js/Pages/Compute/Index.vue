<script setup>
import FrontLayout from '@/Layouts/FrontLayout.vue';
import { Head } from '@inertiajs/vue3';
import { co2 } from "@tgwf/co2";
import Chart from "chart.js/auto";
import { onMounted } from 'vue';

const props = defineProps({
    title: String,
    css: Number,
    img: Number,
    js: Number,
    url: String,
    green: Boolean,
    other: Number,
    video: Number
})

const bytesToKB = (bytes) => {
    const totalByte = bytes * 0.001
    const answer = Math.round(totalByte * 10) / 10
    return answer
}

const emissions = (props) => {
    const swd = new co2({ model: "swd" })
    const totalByte = props.css + props.img + props.js + props.other + props.video
    const emissions = swd.perVisit(totalByte, props.green);
    const totalKB = Math.round(emissions * 100) / 100
    return totalKB
}

const returnCo2 = (data) => {
    const swd = new co2({ model: "swd" })
    const emissions = swd.perVisit(data, props.green);
    const answer = Math.round(emissions * 1000) / 1000
    return answer
}

const rank = (props) => {
    const carbon = emissions(props)

    if (carbon <= 0.095) {
        return '卓越'
    } else if (carbon <= 0.186 && carbon > 0.095) {
        return '優秀'
    } else if (carbon <= 0.341 && carbon > 0.186) {
        return '超乎期待'
    } else if (carbon <= 0.493 && carbon > 0.341) {
        return '很棒'
    } else if (carbon <= 0.656 && carbon > 0.493) {
        return '好'
    } else {
        return '不錯'
    }
}

const weight = (props) => {
    var total = props.css + props.img + props.js + props.other + props.video
    var answer = Math.round(total * 0.001 * 10) / 10
    return answer;
}

const green_desc = (green) => {
    return (green) ? '是' : '否';
}

const dataObj = {
    labels: ['圖檔', 'Scripts', 'HTML/CSS', '其他'],
    datasets: [{
        label: 'KB',
        data: [props.img, props.js, props.css, props.other],
        backgroundColor: [ // 背景色
            "#63d2e0",
            "#9d73ba",
            "#fa851e",
            "#a6c744",
        ],
    }],
};

onMounted(() => {
    const ctx = document.getElementById('heroChart');
    if (props.video > 0) {
        dataObj.labels.push('Video');
        dataObj.datasets[0].data.push(props.video)
        dataObj.datasets[0].backgroundColor.push('#1E90FF')
    }

    Chart.defaults.font.family = "Helvetica, Arial, LiHei Pro, 黑體-繁, 微軟正黑體, sans-serif";
    Chart.defaults.font.size = 20;
    Chart.defaults.color = "white";
    new Chart(ctx, {
        type: 'doughnut',
        data: dataObj,
        options: {
            responsive: true,
            maintainAspectRatio: false,
        },
    });
});

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
                    <!-- <div class="col-lg-7">
                        <img :src="ourImage()" alt="推廣數位工具" style="width: 100%; height: 130px; border-radius: 20px">
                    </div> -->
                </div>
            </div>
        </div>

        <!-- Service Start -->
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
                <div class="col">
                    <div>
                        <div class="card-body text-center">
                            <div class="p-4 carbon_gold_border_radius radius-15">
                                <div class="carbon_white_title">碳評級</div>

                                <div class="list-inline contacts-social mt-3 mb-3">
                                    <div class="mb-0 mt-5 carbon_white_detail"> {{ rank(props) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div>
                        <div class="card-body text-center">
                            <div class="p-4 carbon_gold_border_radius radius-15">
                                <div class="carbon_white_title">頁面排放量</div>

                                <div class="list-inline contacts-social mt-3 mb-3">
                                    <div class="mb-0 mt-5 carbon_white_detail">{{ emissions(props) }} g</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div>
                        <div class="card-body text-center">
                            <div class="p-4 carbon_gold_border_radius radius-15">
                                <div class="carbon_white_title">頁面重量</div>

                                <div class="list-inline contacts-social mt-3 mb-3">
                                    <div class="mb-0 mt-5 carbon_white_detail">{{ weight(props) }} KB</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col" alt="將網站託管在「避免、減少或抵消」產生電力碳排放的機房。" title="將網站託管在「避免、減少或抵消」產生電力碳排放的機房。">
                    <div>
                        <div class="card-body text-center">
                            <div class="p-4 carbon_gold_border_radius radius-15">
                                <div class="carbon_white_title">是否為綠色託管</div>

                                <div class="list-inline contacts-social mt-3 mb-3">
                                    <div class="mb-0 mt-5 carbon_white_detail">{{ green_desc(props.green) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->

        <div class="container">
            <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-2">
                <div class="col">
                    <div>
                        <div class="card-body text-center">
                            <div class="p-4 carbon_gold_border_radius radius-15">
                                <canvas id="heroChart" width="100%" height="380"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div>
                        <div class="card-body">
                            <div class="p-4 carbon_gold_border_radius radius-15">
                                <p>
                                <div class="carbon_white_title">網址 : {{ props.url }} </div>
                                </p>
                                <div class="carbon_gold_border mt-2 mb-2"></div>
                                <p class="mt-2">
                                <div class="carbon_white_title">圖檔 : {{ bytesToKB(props.img) }} KB, {{
                                    returnCo2(props.img) }} 克二氧化碳當量</div>
                                </p>
                                <div class="carbon_gold_border mt-2 mb-2"></div>
                                <p class="mt-2">
                                <div class="carbon_white_title">Scripts : {{ bytesToKB(props.js) }} KB, {{
                                    returnCo2(props.js) }} 克二氧化碳當量</div>
                                </p>
                                <div class="carbon_gold_border mt-2 mb-2"></div>
                                <p class="mt-2">
                                <div class="carbon_white_title">HTML/CSS : {{ bytesToKB(props.css) }} KB, {{
                                    returnCo2(props.css) }} 克二氧化碳當量</div>
                                </p>
                                <div class="carbon_gold_border mt-2 mb-2" v-if="props.video > 0"></div>
                                <p class="mt-2" v-if="props.video > 0">
                                <div class="carbon_white_title">Video : {{ bytesToKB(props.video) }} KB, {{
                                    returnCo2(props.video) }} 克二氧化碳當量</div>
                                </p>
                                <div class="carbon_gold_border mt-2 mb-2"></div>
                                <p class="mt-2">
                                <div class="carbon_white_title">Other : {{ bytesToKB(props.other) }} KB, {{
                                    returnCo2(props.other) }} 克二氧化碳當量</div>
                                </p>
                                <!-- <p class="mt-2">
                                        <a class="btn p-2 carbon_gold_border_radius radius-15" :href="route('home')" role="button">返回首頁</a>
                                    </p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" style="padding-top: 2rem; text-align: center;">
            <p class="ctca-font" style="font-size: 1.3em; font-weight: 700; color: white;">
                我們怎麼算的？
            </p>
        </div>

        <div class="container" style="padding-top: 1rem;">
            <p class="ctca-font" style="font-size: 1.1em; font-weight: 700; color: white; text-indent: 2em;">
                網頁碳排的計算方法是透過網頁的傳輸量來估算瀏覽網頁時會產生多少的碳排放，這並不是完全精準的計算方式，但卻是網頁碳排放研究中最廣泛使用的估算指標，並且是一個比較易於理解的指標。
            </p>
        </div>

        <div class="container" style="padding-top: 1rem;">
            <p class="ctca-font" style="font-size: 1.1em; font-weight: 700; color: white; text-indent: 2em;">
                我們的網頁碳排計算器參考了<a href="https://sustainablewebdesign.org" title="導向Sustainable Web Design"
                    alt="導向Sustainable Web Design" target="_blank">Sustainable Web
                    Design</a>所提出的網頁碳排計算模型(該模型採用全球網際網路的係數來將傳輸量換算為消耗的電量)，並使用<a
                    href="https://www.thegreenwebfoundation.org" title="導向The Green Web" alt="導向The Green Web"
                    target="_blank">The Green Web Foundation</a>所開發的開放原始碼CO2.js來估算網頁碳排放量。
            </p>
        </div>

        <div class="container" style="padding-top: 1rem; text-align: center;">
            <p class="ctca-font" style="font-size: 1.3em; font-weight: 700; color: white;">
                我們使用了以下數據:
            </p>
        </div>

        <div class="container" style="padding-top: 1rem;">
            <p class="ctca-font" style="font-size: 1.1em; font-weight: 700; color: white;">
                １． 網頁傳輸量：使用程式抓取每個網頁的傳輸量，包含圖片、Script、HTML\CSS、其他(多媒體)。<br>
                ２． 資料中心的能源使用效率(PUE)：使用全國平均值1.69。<br>
                ３． 電力碳排係數：使用經濟部能源署公告的0.495公斤CO2e/度<br>
                <a href="/gain/5" title="導向網頁碳排計算器" alt="導向網頁碳排計算器">成果專區　網頁碳排計算器</a>
            </p>
        </div>
    </FrontLayout>
</template>