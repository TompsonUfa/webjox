<template>
    <header class="header fixed-top">
        <app-nav></app-nav>
    </header>
</template>

<script>
    import AppNav from "./AppNav.vue";

    export default {
        name: 'AppHeader',
        components: {AppNav},
    }
</script>

<style scoped lang="scss">
.header {
    height: 75px;
    width: 100vw;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #fff;
    box-shadow: 0 2px 3px rgba(100, 100, 100, 0.1);
}
</style>
