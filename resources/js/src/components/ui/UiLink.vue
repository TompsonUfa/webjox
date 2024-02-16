<template>
    <router-link class="btn ui-link" :to="this.item.params">
        <slot></slot>
    </router-link>
</template>

<script >
export default {
    name: "UiLink",
    props: {
        item: {
            required: true,
            type: Object,
        }
    }
}
</script>

<style scoped lang="scss">
.ui-link{
    color: #fff;
    background-color: var(--first-color);
    transition: all 0.2s ease;
    &:active {
        color: #fff;
        border-color: transparent;
    }
    &:hover {
        background-color: #000;
    }
    &_disabled {
        opacity: 0.5;
        cursor: default;
        background-color: #000;
        &:hover {
            background-color: #000;
        }
    }
}
</style>
