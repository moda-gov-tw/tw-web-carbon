<script setup>
import { router } from '@inertiajs/vue3';

const ourImage = () => {
    return router.page.props.ziggy.url + "/img/AAA21.png";
};
</script>
<template>
    <div class="container-fluid text-center footer wow fadeIn"
        style="padding-top: 2rem !important; margin-top: 6rem !important;">
        <div class="container">
            <div class="col-md-12 text-center pb-2">
                <p class="text-light ctca-font ctca-font-size"><small
                        class="fa fa-map-marker-alt text-success me-2"></small>100057 臺北市中正區延平南路143號 &nbsp;&nbsp; <small
                        class="far fa-clock text-success me-2"></small>星期一 - 星期五 : 08.30 AM - 05.00 PM &nbsp;&nbsp;
                    <small class="fas fa-globe-asia text-success me-2"></small>Copyright &copy;{{ new
                        Date().getFullYear() }} 數位發展部. All rights reserved.
                    <a href="https://accessibility.moda.gov.tw/Applications/Detail?category=20241115181247"
                        title="無障礙網站(另開新視窗)" target="_blank">
                        <img :src="ourImage()" border="0" width="100" alt="通過AAA無障礙網頁檢測">
                    </a>
                </p>
            </div>
        </div>
    </div>

</template>
