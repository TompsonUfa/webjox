<template>
    <div class="sidebar">
        <div class="sidebar__content">
            <div class="sidebar__brand">
                <router-link :to="{name: 'home'}">Webjox</router-link>
            </div>
            <ul class="sidebar__list">
                <li class="sidebar__item">
                    <router-link class="sidebar__link" :to="{name: 'admin-posts'}">
                        <i class="bi bi-newspaper"></i>
                        Посты
                    </router-link>
                </li>
                <li class="sidebar__item">
                    <a class="sidebar__link" href="" @click.prevent="this.logout">
                        <i class="bi bi-box-arrow-left"></i>
                        Выйти
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: 'AppSidebar',
    methods: {
        ...mapActions(['logout'])
    }
}
</script>

<style scoped lang="scss">
.sidebar {
    a {
        text-decoration: none;
        color: #fff;
    }

    min-width: 250px;
    max-width: 250px;
    background-color: #000;
    &__content {
        height: 100vh;
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        left: 0;
        z-index: 1000;
    }
    &__brand {
        width: 100%;
        text-transform: uppercase;
        color: #fff;
        font-size: 30px;
        text-align: center;
        padding: 20px 0;
    }

    &__list {
        list-style: none;
        padding: 0 15px;
        margin: 0;
        font-size: 20px;
    }

    &__item {
        margin-bottom: 10px;
    }

    &__link {
        width: 100%;
        display: inline-block;
        padding: 10px 40px;
        transition: 0.3s ease;
        border-radius: 10px;

        i {
            padding-right: 5px;
        }

        &:hover {
            background-color: var(--first-color);
        }
    }

    &__link.active {
        background-color: var(--first-color);
    }
}
</style>
