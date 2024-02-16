<template>
    <div class="row">
        <div class="col-12 mb-3">
            <ui-link :item="this.link">Назад</ui-link>
        </div>
        <form action="post" @submit.prevent="this.createPost">
            <div class="col-12 mb-3">
                <select-image :image="this.selectedImage"  @open-menu="this.menuImage = true"></select-image>
            </div>
            <div class="col-12 mb-3">
                <div class="form-group">
                    <label class="form-label">Название</label>
                    <input v-model="form.title" type="text" class="form-control" id="title">
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="form-group">
                    <label class="form-label">Описание</label>
                    <input v-model="form.desc" type="text" class="form-control" id="desc">
                </div>
            </div>
            <div class="col-12 mb-3">
                <label class="form-label">Список тэгов</label>
                <select class="form-select" v-model="this.form.tags" multiple aria-label="multiple select example">
                    <option v-for="tag in this.tags" :key="tag.id" :value="tag.id">{{ tag.title }}</option>
                </select>
            </div>
            <div class="col-12 mb-3">
                <div class="form-group">
                    <label class="form-label">Содержимое</label>
                    <QuillEditor style="height:300px"
                                 v-model:content="form.content"
                                 contentType="html"
                                 theme="snow"
                    />
                </div>
            </div>
            <div class="form-check d-flex gap-2 justify-content-end">
                <input v-model="this.form.published" class="form-check-input" type="checkbox" value="" id="checkPublish">
                <label class="form-check-label" for="checkPublish">
                    Опубликовать
                </label>
            </div>
            <div class="col-12 mb-3">
                <ui-button type="submit">Создать</ui-button>
            </div>
        </form>
        <menu-image @image-check="this.imageCheckDelete" @select-image="this.selectImage" @close-menu="this.menuImage = false" v-if="this.menuImage"></menu-image>
        <modal-error @close-modal="this.errorShow = false" :errors="this.errors" v-if="this.errorShow"></modal-error>
    </div>
</template>

<script>
import {mapGetters} from "vuex";
import UiButton from "@/components/ui/UiButton.vue";
import SelectImage from "@/components/ui/SelectImage.vue";
import {QuillEditor} from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import ImageUploader from 'quill-image-uploader';
import UiLink from "@/components/ui/UiLink.vue";
import axios from "axios";
import MenuImage from "@/components/MenuImage.vue";
import ModalError from "../../../components/ui/ModalError.vue";

export default {
    name: 'CreateView',
    data() {
        return {
            link: {
                params: {name: 'admin-posts',},
            },
            tags: [],
            menuImage: false,
            selectedImage: null,
            form: {
                image: '',
                title: '',
                desc: '',
                tags: [],
                content: '',
                published: false,
            },
            errorShow: false,
            errors: [],
        }
    },
    mounted() {
        this.getTags();
    },
    methods: {
        getTags() {
            axios.get('/api/panel/tags')
                .then(res => {
                    this.tags = res.data.data;
                })
                .catch(err => {
                    console.log(err)
                })
        },
        createPost(){
            axios.post('/api/panel/posts', this.form)
                .then(res => {
                    this.$router.push({name: 'admin-posts'});
                })
                .catch(err => {
                    this.errors = [];
                    if (err.response && err.response.status === 422) {
                        for (const field in err.response.data.errors) {
                            this.errors.push(err.response.data.errors[field][0]);
                        }
                        this.errorShow = true;
                    } else {
                        console.error(err);
                    }
                })
        },
        selectImage(image){
            this.selectedImage = image.path;
            this.form.image = image.id;
            this.menuImage = false;
        },
        imageCheckDelete(image){
            if (this.form.image === image){
                this.form.image = '';
                this.selectedImage = null;
            }
        }
    },
    components: {
        ModalError,
        MenuImage,
        UiLink,
        SelectImage,
        UiButton,
        QuillEditor
    },
    computed: {
        ...mapGetters(['user']),
    },
}
</script>

<style lang="scss">

.form-check-input:checked {
    background-color: var(--first-color);
    border-color: var(--first-color);
}

</style>
