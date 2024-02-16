<template>
    <div ref="dropdownRef" class="dropdown">
        <div class="dropdown__list">
            <div class="dropdown__item" @click="this.$emit('delete-image')">
                <i class="bi bi-trash3-fill"></i>
                Удалить
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ImageListDropdown',
    emits: ['delete-image'],
    mounted() {
        this.$nextTick(() => {
            this.$refs.dropdownRef.focus();
        });
    }
}
</script>

<style scoped lang="scss">
.dropdown {
    position: absolute;
    top: 90px;
    left: 10px;
    z-index: 2;
    width: 200px;
    border-radius: 16px;
    background-color: #fff;
    overflow: hidden;
    border: 1px solid #e8e9ea;

    &:focus {
        outline: none;
    }

    &__list {
        list-style: none;
        padding: 10px;
        margin: 0;
    }

    &__item {
        pointer-events: all;
        color: #000;
        text-decoration: none;
        display: flex;
        gap: 10px;
        transition: all .3s ease;
        font-size: 15px;
        cursor: pointer;
        padding: 10px;
        border-radius: 8px;

        &:hover {
            background-color: #e8e9ea;
        }
    }
}
</style>
