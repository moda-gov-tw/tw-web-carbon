<script setup>
import FrontLayout from '@/Layouts/FrontLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    title: String,
    gain: Object,
    type: String,
    type_desc: String
})

const fileHave = (str) => {
    if (str == null) {
        return 0;
    } else {
        var result = JSON.parse(str);
        var total = Object.keys(result).length;
        return total;
    }
};

const urlFile = (id, file_desc, file_name) => {
    return "/gain/download/" + id + "/" + file_desc + "/" + file_name;
};

const urlTitle = (str) => {
    return "到" + str;
};

const backUrl = (type) => {
    return "/gain/" + type;
};

const fileDownLoad = (title, name) => {
    var file_desc = title.split(".");
    return "檔案下載： " + name + "." + file_desc[1];
}

const fileTitleLoad = (title, name) => {
    var file_desc = title.split(".");
    return name + "." + file_desc[1] + " (另開新視窗)";
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
                        <a href="/" class="ctca-font ctca-font-size-title" title="到首頁">首頁</a>>
                        <a href="/gain" :title="urlTitle(props.title)" class="ctca-font ctca-font-size-title">{{
                            props.title
                            }}</a>>
                        <a :href="backUrl(props.type)" :title="urlTitle(props.type_desc)"
                            class="ctca-font ctca-font-size-title">{{
                                props.type_desc
                            }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-xxl py-5">
            <div class="card bg-dark">
                <div class="card-body">
                    <h2 class="card-text ctca-font">{{ gain.title }}</h2>
                    <div class="card-detail ctca-font" v-html="gain.detail"></div>

                    <h3 class="mt-5 carbon_gold card-title ctca-font" v-if="fileHave(gain.gain_file) > 0">資料下載</h3>
                    <p v-for="(file1, index) in JSON.parse(gain.gain_file)" :key="index">
                        <a :href="urlFile(gain.id, file1.file_desc, file1.file_name)"
                            style="color: white; text-decoration: underline;" target="_blank"
                            :title="fileDownLoad(file1.file_desc, file1.file_name)">
                            <span>{{ fileTitleLoad(file1.file_desc, file1.file_name) }}</span>
                        </a>
                    </p>

                </div>
            </div>

            <div class="card-footer text-muted text-end">
                <a :href="backUrl(gain.gain_type_id)" class="nav-link ctca-font" style="color: white;"
                    title="到更多成果專區">更多成果專區</a>
            </div>
        </div>

    </FrontLayout>

    <a href="#home-top" class="btn btn-lg btn-lg-square back-to-top" alt="回頁首"
        style="font-size: 0.8rem;background-color: #dfbc15;color: black;">回頁首</a>
</template>

<style scoped>
.sticky-top {
    top: '0px'
}

.var-top {
    top: '0px'
}
</style>