<template>
    <div class="menu-image">
        <div class="menu-image__container">
            <div class="menu-image__header">
                <div class="btn-close" @click="this.$emit('close-menu')"></div>
            </div>
            <div class="menu-image__content">
                <div class="menu-image__btns mb-3">
                    <ui-button class="menu-image__btn" @click="this.openFileInput">Загрузить</ui-button>
                    <input type="file" ref="fileInput" style="display: none" @change="handleFileChange">
                </div>
                <image-list @delete-image="this.deleteImage"
                            @select-image="this.selectImage"
                            v-if="this.images"
                            :images="this.images"
                            class="mb-3"
                >
                </image-list>
                <app-pagination @get-data="item => this.getImages(item)"
                                v-if="this.pagination && pagination.last_page !== 1"
                                :pagination="this.pagination"
                                class="menu-image__pagination"
                >
                </app-pagination>
            </div>
        </div>
    </div>
</template>

<script>
import UiButton from "./ui/UiButton.vue";
import axios from "axios";
import ImageList from "./ImageList.vue";
import AppPagination from "./ui/AppPagination.vue";

export default {
    name: 'MenuImage',
    components: {AppPagination, ImageList, UiButton},
    data() {
        return {
            images: [],
            pagination: null,
        }
    },
    mounted() {
        this.getImages();
    },
    methods: {
        openFileInput() {
            this.$refs.fileInput.click();
        },
        handleFileChange(event) {
            const file = event.target.files[0];
            axios.post('/api/panel/images', {image: file}, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(res => {
                    this.getImages();
                })
                .catch(err => {
                    console.log(err)
                })
        },
        deleteImage(image){
            axios.delete(`/api/panel/images/${image.id}`)
                .then(res => {
                    this.getImages();
                    this.$emit('image-check', image.id)
                })
                .catch(err => {
                    console.log(err)
                })
        },
        getImages(page = 1) {
            axios.get('/api/panel/images', {
                params: {
                    page: page,
                    perPage: 10,
                }
            }).then(res => {
                this.images = res.data.data;
                this.pagination = res.data.meta;
                console.log(this.pagination)
            }).catch(err => {
                console.log(err)
            })
        },
        selectImage(image){
           this.$emit('select-image', image);
        }
    },
    emits: ['close-menu', 'select-image', 'image-check'],
}
</script>

<style  lang="scss">
.menu-image {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.66);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1001;
    &__container {
        width: 75%;
        background-color: #fff;
        border-radius: 15px;
    }

    &__header {
        width: 100%;
        display: flex;
        justify-content: end;
        align-items: center;
        border-bottom: 1px solid #e8e9ea;

        .btn-close {
            font-size: 20px;
            cursor: pointer;
            padding: 20px;
        }
    }

    &__content {
        padding: 20px;
        height: 100%;
    }

    &__btns {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
}
@media screen and (max-width: 450px){
    .menu-image {
        &__container {
            width: 350px;
        }
        &__pagination {
           .page-link {
               font-size: 14px !important;
           }
        }
    }
}
</style>
