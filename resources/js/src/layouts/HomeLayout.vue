<template>
    <app-header/>
    <main class="main">
        <router-view></router-view>
    </main>
</template>

<script>
import AppHeader from "../components/AppHeader.vue";

export default {
    name: 'HomeLayout',
    components: {AppHeader}
}
</script>

<style scoped lang="scss">
    .main {
        padding-top: 75px;
        height: 100vh;
    }
</style>
