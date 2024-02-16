<template>
    <div class="select-img" @click="this.$emit('open-menu')">
        <div class="select-img__label">
            <figure class="select-img__figure">
                <img :src="selectedImages" alt="Обложка теста" class="select-img__img"
                     :class="selectedImages ? 'select-img__img_active' : ''">
                <figcaption class="select-img__figcaption">
                    <i class="bi bi-image-fill"></i>
                </figcaption>
            </figure>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SelectImage',
    data() {
        return {
            selectedImages: null,
        }
    },
    props: {
        image: {
            type: String,
            required: false,
        }
    },
    watch: {
        image(newImage, oldImage) {
            this.selectedImages = newImage;
        }
    },
    emits: [
        'open-menu'
    ]
}
</script>

<style scoped lang="scss">
.select-img {
    width: 100%;
    height: 350px;
    cursor: pointer;
    background-color: rgba(0, 0, 0, .5);
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid var(--border-color);

    &__label {
        width: 100%;
        height: 100%;
    }

    &__input {
        display: none;
    }

    &__figure {
        position: relative;
        width: 100%;
        height: 100%;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    &__img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        border-radius: 15px;
        display: none;

        &_active {
            display: block;
        }
    }

    &__img_active ~ &__figcaption {
        opacity: 0;
    }

    &__figcaption {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background-color: transparent;
        transition: all .3s ease;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 45px;
        color: var(--border-color);
    }

    &__figure:hover &__figcaption {
        opacity: 1;
        color: #fff;
        background-color: rgba(0, 0, 0, .5);
    }
}
</style>
