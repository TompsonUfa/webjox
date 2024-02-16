<template>
    <div class="image-list">
        <image-list-item
            @delete-image="this.$emit('delete-image' , image)"
            @select-image="image => this.$emit('select-image', image)"
            :image="image"
            v-for="image in images"
            :key="image.id"
        ></image-list-item>
    </div>
</template>

<script>
import ImageListItem from "./ImageListItem.vue";

export default {
    name: 'ImageList',
    components: {ImageListItem},
    props: {
        images: {
            type: Array,
            required: true,
        }
    },
    emits: ['select-image', 'delete-image'],
}
</script>

<style lang="scss">
.image-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    height: 300px;
    max-height: 300px;
    overflow: auto;
    &__item {
        position: relative;
        z-index: -0;
        width: 85px;
        height: 85px;
        transition: .3s ease all;
        border-radius: 5px;
        border: 1px solid #e8e9ea;
    }
    &__wrap {
        width: 100%;
        height: 100%;
        overflow: hidden;
        cursor: pointer;
    }
    &__background {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 2;
        top: 0;
        left: 0;
        opacity: 1;
        transition: .3s ease;
    }

    &__img {
        width: inherit;
        height: inherit;
        object-fit: cover;
        transition: .3s ease;
    }

    &__wrap:hover > &__background {
        background-color: #000;
        opacity: 0.2;
    }

    &__wrap:hover > &__img {
        transform: scale(1.2);
    }
}
@media screen and (max-width: 450px){
    .image-list {
        justify-content: center;
    }
}
</style>
