<template>
    <button class="btn ui-button">
        <slot></slot>
    </button>
</template>

<script >
export default {
    name: "UiButton",
}
</script>

<style scoped lang="scss">
.ui-button{
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
