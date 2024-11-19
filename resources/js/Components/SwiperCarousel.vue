<script>
import { ref, onMounted } from 'vue';
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue';

// Import Swiper styles
import 'swiper/css';

import 'swiper/css/pagination';
import 'swiper/css/navigation';

// import required modules
import { Autoplay, Pagination, Navigation } from 'swiper/modules';
import axios from 'axios';

export default {
  components: {
    Swiper,
    SwiperSlide,
  },
  setup() {
    const imgArr = ref([]);

    onMounted(() => {
      axios.get('swiper')
        .then(function (response) {
          if (response.status == 200) {
            imgArr.value = response.data
          }
        })

    });
    return {
      imgArr,
      modules: [Autoplay, Pagination, Navigation],
    };
  },
  methods: {
    onSwiper(swiper) {
      this.swiper = swiper;
    }
  }
};
</script>

<template>
  <div v-if="imgArr.length > 0">

    <swiper style="border-radius: 35px" :spaceBetween="30" :centeredSlides="true" :autoplay="{
      delay: 2500,
    }" :pagination="{
      clickable: true,
    }" :navigation="true" :modules="modules" @autoplayTimeLeft="onAutoplayTimeLeft" @swiper="onSwiper"
      class="mySwiper">
      <swiper-slide v-for="item in imgArr" :key="item.id">
        <img class="w-100" :src="item.pic" :alt="item.title">
      </swiper-slide>
    </swiper>
  </div>
  <div v-else>
    <swiper style="border-radius: 35px">
      <swiper-slide><img class="w-100" src="/img/home/MIT-Web-Loading.png" alt="下載圖片"></swiper-slide>
    </swiper>
  </div>
</template>