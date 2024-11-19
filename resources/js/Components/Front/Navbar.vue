<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const typeArr = ref([]);

onMounted(() => {
    axios.get('/gainType')
        .then(function (response) {
            if (response.status == 200) {
                typeArr.value = response.data
            }
        })

});

const openFlag = ref(false)

const openClick = () => {
    if (openFlag.value) {
        $("#navbarCollapse").removeAttr("style")
        openFlag.value = false
    } else {
        $('#navbarCollapse').css('width', '100%');
        openFlag.value = true
    }
}

const addFont = (title) => {
    return "導向" + title;
}
</script>

<template>
    <!-- Navbar Start -->
    <nav class="navbar container-xxl navbar-expand-lg navbar-light shadow sticky-top p-0">
        <div class="col-lg-2">
            <Link class="logo" :href="route('home')"><img src="/img/home/GreenLogo.svg" class="logo"
                style="height:90px;" alt="網頁碳排計算圖示"></Link>
        </div>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            alt="網頁碳排計算手機版圖案" :onclick="openClick">
            <span class="navbar-toggler-icon">-</span>
        </button>
        <div class="col-lg-10 collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="#U" name="U" title="上方區域" accesskey="U" style="padding: 28px 0; color: #fff;">:::</a>
                <Link :href="route('home')" class="nav-item nav-link ctca-font"
                    v-bind:class="route().current('home') ? 'active' : ''" alt="導向首頁" title="導向首頁">
                首頁
                </Link>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle ctca-font" v-bind:class="route().current('gain') ? 'active' : ''"
                        data-bs-toggle="dropdown" style="cursor: pointer;" alt="導向成果專區" href="/gain/1"
                        title="導向成果專區">成果專區</a>
                    <ul class="dropdown-menu fade-up m-0 top-layer-select ctca-font"
                        style="border:2px red solid; border-radius: 5px; border-color: #DFBC15; background-color: black;">
                        <li v-for="type in typeArr">
                            <Link :href="'/gain/' + type.id" :alt="addFont(type.name)" :title="addFont(type.name)"
                                class="dropdown-item ctca-font" style="font-size: 1.3em;">
                            {{ type.name }}
                            </Link>
                        </li>
                    </ul>
                </li>
                <Link :href="route('sitemap')" class="nav-item nav-link ctca-font"
                    v-bind:class="route().current('sitemap') ? 'active' : ''" alt="導向網站導覽" title="導向網站導覽">
                網站導覽
                </Link>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


</template>

<style scoped>
.dialog::backdrop {
    background: black;
    opacity: 0.5;
}
</style>