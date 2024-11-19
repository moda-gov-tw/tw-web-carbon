<script setup>
import FrontLayout from '@/Layouts/FrontLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
  title: String,
  award: Object,
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

const urlFile = (str, award_folder) => {
  return award_folder + str;
};

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
            <a href="#C" name="C" accesskey="C" id="ace_m" target="_self" title="中間區域" style="color: #fff;">:::</a>
            <p class="ctca-font ctca-font-size-title" style="color: #fff;">{{ props.title }}</p>
          </div>
          <div class="col-lg-7">
            <img :src="ourImage()" alt="推廣數位工具" style="width: 100%; height: 130px; border-radius: 20px">
          </div>
        </div>
      </div>
    </div>

    <div class="container-xxl py-5">
      <div class="card bg-dark">
        <div class="card-body">
          <div class="card-title ctca-font">發布日期：{{ award.award_date }} </div>
          <h2 class="card-text ctca-font">{{ award.title }}</h2>
          <div class="card-detail ctca-font" v-html="award.detail"></div>

          <h3 class="mt-5 card-title carbon_gold ctca-font" v-if="fileHave(award.award_file) > 0">資料下載</h3>
          <p v-for="(file1, index) in JSON.parse(award.award_file)" :key="index">
            <a :href="urlFile(file1.file_desc, award.award_folder)" target="_blank"
              style="color: white; text-decoration: underline;" :alt="file1.file_name" :title="file1.file_name">{{
                file1.file_name }}</a>
          </p>

        </div>
        <div class="card-footer text-muted text-end">
          <Link :href="route('award')" class="nav-item nav-link ctca-font" style="color: #fff;" alt="更多獎補助專區"
            title="更多獎補助專區">
          更多獎補助專區
          </Link>
        </div>
      </div>
    </div>

  </FrontLayout>
</template>