<script setup>
import { Link, router } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const keyword = ref(null)

const typeArr = ref([]);

const searchClick = () => {
    if (keyword.value == '' || keyword.value == null) {
        alert('關鍵字不能為空');
        return false;
    }
    $('#exampleModal').modal('hide');
    router.visit(`/search/${keyword.value}`, { preserveScroll: false })
};

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

const scrollToCenter = () => {

    const check_url = router.page.props.ziggy.url
    const check_url_here = router.page.props.ziggy.location

    if ($("#navbarCollapse").hasClass("show")) {
        $("#navbarCollapse").removeClass("show");
        window.scrollTo({
            top: 50,
            behavior: 'smooth'
        });
    } else {
        window.scrollTo({
            top: 200,
            behavior: 'smooth'
        });
    }

    if (check_url != check_url_here) {
        router.visit(`/`, { preserveScroll: true })
    }
}
</script>

<template>

    <!-- Navbar Start -->
    <nav class="navbar container-xxl navbar-expand-lg navbar-light shadow  var-top p-0 home-top">
        <div class="col-lg-2">
            <h1>
                <Link class="logo" :href="route('home')"><img src="/img/home/GreenLogo.svg" class="logo"
                    style="height:90px;" alt="網頁碳排計算圖示"></Link>
            </h1>
        </div>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            alt="網頁碳排計算手機版圖案" :onclick="openClick">
            <span class="navbar-toggler-icon">-</span>
        </button>
        <div class="col-lg-10 collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="#U" name="U" title="上方區域" accesskey="U" style="padding: 28px 0; color: #fff;">:::</a>
                <Link :href="route('home')" class="nav-item nav-link ctca-font"
                    v-bind:class="route().current('home') ? 'active' : ''" title="導向首頁">
                首頁
                </Link>
                <!-- <Link :href="route('about')" class="nav-item nav-link ctca-font"
                    v-bind:class="route().current('about') ? 'active' : ''" alt="導向關於本站" title="導向關於本站">
                關於本站
                </Link> -->
                <!-- <p class="nav-item nav-link ctca-font" alt="移動至碳排計算" title="移動至碳排計算" @click="scrollToCenter"
                    style="cursor: pointer;">碳排計算</p> -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle ctca-font" v-bind:class="route().current('gain') ? 'active' : ''"
                        data-bs-toggle="dropdown" style="cursor: pointer;" href="/gain/1" title="導向成果專區">成果專區</a>
                    <ul class="dropdown-menu fade-up m-0 top-layer-select ctca-font"
                        style="border:2px red solid; border-radius: 5px; border-color: #DFBC15; background-color: black;">
                        <li v-for="type in typeArr">
                            <Link :href="'/gain/' + type.id" :title="addFont(type.name)" class="dropdown-item ctca-font"
                                style="font-size: 1.3em;">
                            {{ type.name }}
                            </Link>
                        </li>
                    </ul>
                </li>
                <!-- <Link :href="route('award')" class="nav-item nav-link ctca-font"
                    v-bind:class="route().current('award') ? 'active' : ''" alt="導向獎補助專區" title="導向獎補助專區">
                獎補助專區
                </Link>
                <Link :href="route('link')" class="nav-item nav-link ctca-font"
                    v-bind:class="route().current('link') ? 'active' : ''" alt="導向相關連結" title="導向相關連結">
                相關連結
                </Link>
                <Link :href="route('contact_us')" class="nav-item nav-link ctca-font"
                    v-bind:class="route().current('contact_us') ? 'active' : ''" alt="導向聯絡我們" title="導向聯絡我們">
                聯絡我們
                </Link>
                <p class="nav-item nav-link ctca-font" alt="開啟搜尋" title="開啟搜尋" data-bs-toggle="modal"
                    data-bs-target="#exampleModal" data-bs-whatever="@mdo" style="cursor: pointer;">搜尋</p> -->
                <Link :href="route('sitemap')" class="nav-item nav-link ctca-font"
                    v-bind:class="route().current('sitemap') ? 'active' : ''" title="導向網站導覽">
                網站導覽
                </Link>
            </div>
        </div>
    </nav>
    <div class="into"><a href="#content" tabindex="1" title="移動至主要內容區塊">移動至主要內容區塊</a> </div>
    <!-- Navbar End -->

    <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">關鍵字</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <input type="text" class="form-control" v-model.trim="keyword" title="輸入關鍵字">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" @click="searchClick">送出</button>
                </div>
            </div>
        </div>
    </div> -->

</template>

<style scoped>
.dialog::backdrop {
    background: black;
    opacity: 0.5;
}

.into a {
    color: black;
    display: block;
    position: absolute;
    z-index: 999;
    font-size: 0.8em;
}

.into a:focus {
    color: #ffffff;
    display: block;
    position: absolute;
    z-index: 999;
    font-size: 0.8em;
}

.focus {
    border: 2px solid rgb(223, 188, 21);
    border-radius: 5px;
    background-color: #c51647;
    display: block;
    opacity: 5;
    visibility: initial;
}
</style>