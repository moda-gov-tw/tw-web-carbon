<script setup>
import FrontLayout from '@/Layouts/FrontLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
  title: String,
  gain: Object,
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

const urlFile = (str, gain_folder) => {
  return gain_folder + str;
};

const backUrl = (type) => {
  return "/gain/" + type;
};

const addFont = (title) => {
  return "開啟" + title;
}

</script>
<template>

  <Head :title="props.title" />
  <FrontLayout>
    <div class="container-xxl py-5">
      <div class="container">
        <div class="row g-5">
          <div class="col-lg-5 pt-4">
            <a href="#C" name="C" accesskey="C" id="ace_m" target="_self" title="中間區域" style="color: #fff;">:::</a>
            <h1 class="ctca-font ctca-font-size-title" style="color: #fff;">{{ props.title }}</h1>
          </div>
          <!-- <div class="col-lg-7">
            <img :src="ourImage()" alt="推廣數位工具" style="width: 100%; height: 130px; border-radius: 20px">
          </div> -->
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
            <a :href="urlFile(file1.file_desc, gain.gain_folder)" target="_blank"
              style="color: white; text-decoration: underline;" :alt="addFont(file1.file_name)"
              :title="addFont(file1.file_name)">{{ file1.file_name }}</a>
          </p>

        </div>
        <div class="card-footer text-muted text-end">
          <a :href="backUrl(gain.gain_type_id)" class="nav-link ctca-font" alt="導向更多成果專區" title="導向更多成果專區">更多成果專區</a>
        </div>
      </div>
    </div>

  </FrontLayout>
</template>