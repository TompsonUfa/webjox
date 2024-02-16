<template>
    <div class="image-list__item">
        <div class="image-list__wrap"
             @contextmenu.prevent="this.openDropdown"
             @click="this.$emit('select-image', image)">
            <div class="image-list__background"></div>
            <img class="image-list__img" :src="image.path" alt="image">
        </div>
        <ImageListDropdown
            tabindex="0"
            @blur="this.dropdown = false"
            v-if="this.dropdown"
            @delete-image="this.$emit('delete-image')"
        >
        </ImageListDropdown>
    </div>
</template>

<script>
import ImageListDropdown from "./ImageListDropdown.vue";

export default {
    name: 'ImageListItem',
    components: {ImageListDropdown},
    data() {
        return {
            dropdown: false,
        }
    },
    props: {
        image: {
            required: true,
            type: Object,
        }
    },
    emits: ['select-image', 'delete-image'],
    methods: {
        openDropdown() {
            this.dropdown = true;
            this.focus = true;
        },
    }
}
</script>

<style scoped lang="scss">

</style>
