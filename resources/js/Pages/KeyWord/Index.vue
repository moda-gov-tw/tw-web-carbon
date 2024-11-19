<script setup>
import FrontLayout from '@/Layouts/FrontLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
  title: String,
  result_array: {
    default: () => ([]),
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
            <a href="#C" name="C" accesskey="C" id="ace_m" target="_self" title="中間區域" style="color: #fff;">:::</a>
            <p class="ctca-font ctca-font-size-title" style="color: #fff;">{{ props.title }}</p>
          </div>
          <div class="col-lg-7">
            <img :src="ourImage()" alt="推廣數位工具" style="width: 100%; height: 130px; border-radius: 20px">
          </div>
        </div>
      </div>
    </div>

    <div class="container-xxl pt-5">
      <p class="ctca-font" style="font-size: 1.3rem; color: #fff">共找到 {{ result_array.length }} 筆結果</p>
      <br>
      <table class="table table-bordered table-dark" style="border-radius: 10;" v-if="result_array.length > 0">
        <thead>
          <tr>
            <th class="ctca-font table_font" scope="col" style="text-align: center">標題</th>
            <th class="ctca-font table_font" scope="col" style="text-align: center">內容</th>
            <th class="ctca-font table_font" scope="col" style="text-align: center">連結</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="gain_data in result_array" :key="gain_data.id">
            <td class="ctca-font table_font">
              <p v-html="gain_data.title"></p>
            </td>
            <td class="ctca-font table_font" style="text-align: center">
              <p v-html="gain_data.content"></p>
            </td>
            <td style="text-align: center">
              <a :href="gain_data.link" style="width: 100px;" class="btn btn-warning rounded-pill ctca-font table_font"
                :alt="gain_data.title" target="_blank">連結</a>
            </td>
          </tr>

        </tbody>
      </table>
    </div>

  </FrontLayout>
</template>
