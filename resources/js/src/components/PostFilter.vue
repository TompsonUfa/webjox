<template>
    <div tabindex="0" @blur="show = false;" class="post-filter">
        <div class="post-filter__btn" @click="show = true">
            <i class="bi bi-list-ul"></i>
        </div>
        <div class="post-filter__menu" v-if="show">
            <ul class="post-filter__list">
                <li @click="this.$emit('select-filter', filter); this.show=false"
                    v-for="filter in this.filters"
                    :key="filter.id"
                    :class="this.select?.id === filter.id ? 'post-filter__item_active' : null"
                    class="post-filter__item">
                    {{ filter.name }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PostFilter',
    data() {
        return {
            show: false,
        }
    },
    props: {
        filters: {
            type: Array,
            required: true,
        },
        select: {
            type: Object,
        }
    },
    emits: ['select-filter'],
}
</script>

<style scoped lang="scss">
.post-filter {
    width: 250px;
    position: relative;
    pointer-events: none;

    &__btn {
        pointer-events: all;
        width: 50px;
        background-color: var(--first-color);
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 30px;
        color: #fff;
        cursor: pointer;
        opacity: 1;
        transition: .3s ease all;

        &:hover {
            background-color: #000;
        }
    }

    &__menu {
        z-index: 2;
        position: absolute;
        top: 10px;
        left: 60px;
        width: 300px;
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
        transition: all .2s ease;
        font-size: 17px;
        font-weight: 500;
        cursor: pointer;
        padding: 10px 12px;
        border-radius: 8px;
        margin-bottom: 5px;

        &_active {
            color: #fff;
            background-color: var(--first-color);
        }

        &:hover {
            color: #fff;
            background-color: var(--first-color);
        }
    }
}
@media screen and (max-width: 400px) {
    .post-filter {
        &__menu {
            max-width: 240px;
        }
        &__item {
            font-size: 15px;
        }
    }
}
</style>
