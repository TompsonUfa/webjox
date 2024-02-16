<template>
    <div tabindex="0" @blur="showMenu = false;" class="dropdown">
        <div class="dropdown__btn" @click="this.showMenu = !showMenu">
            <i class="bi bi-three-dots"></i>
        </div>
        <div class="dropdown__menu" v-if="showMenu">
            <ul class="dropdown__list">
                <template v-for="item in items" :key="item.id">
                    <li class="dropdown__item"
                        v-if="item.link && this.user.permissions.find(per => per.slug === item.task)"
                        @click.prevent="this.$router.push({name: item.link.name , params: item.link.params})">
                        {{ item.name }}
                    </li>
                    <li class="dropdown__item"
                        v-if="item.eventClick && this.user.permissions.find(per => per.slug === item.task)"
                        @click.prevent="this.$emit(item.eventClick.name, item.eventClick.params.id)"
                    >
                        {{ item.name }}
                    </li>
                </template>
            </ul>
        </div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: 'UiDropdown',
    data() {
        return {
            showMenu: false,
        }
    },
    props: {
        items: {
            type: Array,
            required: true,
        }
    },
    computed: {
        ...mapGetters(['user']),
    },
    emits: ['delete-post']
}
</script>

<style scoped lang="scss">
.dropdown {
    position: relative;
    pointer-events: none;

    &__btn {
        pointer-events: all;
        width: 36px;
        height: 36px;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: all .3s ease;
        border-radius: 5px;
        color: #fff;
        background-color: var(--first-color);

        &:hover {
            opacity: 0.8;
        }
    }

    &__menu {
        z-index: 2;
        position: absolute;
        top: 46px;
        right: 0;
        width: 200px;
        border-radius: 16px;
        background-color: #fff;
        overflow: hidden;
        border: 1px solid #e8e9ea;
    }

    &__list {
        list-style: none;
        padding: 10px 12px;
        margin: 0;
    }

    &__item {
        pointer-events: all;
        color: #000;
        text-decoration: none;
        display: flex;
        gap: 5px;
        transition: all .3s ease;
        font-size: 15px;
        cursor: pointer;
        padding: 10px 12px;
        border-radius: 8px;
        margin-bottom: 5px;

        &:hover {
            background-color: #e8e9ea;
        }
    }

}
</style>
