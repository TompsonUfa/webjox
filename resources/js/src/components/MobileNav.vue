<template>
    <div class="mobile-nav">
        <div class="mobile-nav__item">
            <router-link class="mobile-nav__link" :to="{name: 'admin-posts'}">
                <i class="bi bi-newspaper"></i>
            </router-link>
        </div>
        <div class="mobile-nav__item">
            <a class="mobile-nav__link" href="" @click.prevent="this.logout">
                <i class="bi bi-box-arrow-left"></i>
            </a>
        </div>
    </div>
</template>

<script>
    import {mapActions} from "vuex";

    export default {
        name: 'MobileNav',
        methods: {
            ...mapActions(['logout'])
        }
    }
</script>

<style scoped lang="scss">
    .mobile-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 10px;
        display: flex;
        gap: 20px;
        justify-content: center;
        align-items: center;
        z-index: 2000;
        background-color: #000;
        &__link {
            text-decoration: none;
            color: var(--first-color);
            font-size: 20px;
        }
    }
</style>
