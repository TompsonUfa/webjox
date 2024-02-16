<template>
    <div class="row">
        <div class="col-12 mb-3">
            <h3 class="title">
                Список постов
            </h3>
        </div>
        <div class="col-12 mb-3">
            <form-search @get-data="search => {this.search = search; this.getPosts()}"></form-search>
        </div>
        <div class="col-12">
            <table-posts :posts="this.posts"></table-posts>
        </div>
        <div class="col-12" v-if="pagination.last_page !== 1">
            <app-pagination @get-data="item => this.getPosts(item)" :pagination="this.pagination"></app-pagination>
        </div>
        <div class="col-12" v-if="this.user.permissions.find(item => item.slug === 'create-tasks')">
            <ui-link :item="this.link">
                Создать запись
            </ui-link>
        </div>
    </div>
</template>

<script>
import TablePosts from "@/components/TablePosts.vue";
import UiButton from "@/components/ui/UiButton.vue";
import UiLink from "../../../components/ui/UiLink.vue";
import {mapGetters} from "vuex";
import axios from "axios";
import AppPagination from "../../../components/ui/AppPagination.vue";
import FormSearch from "../../../components/ui/FormSearch.vue";

export default {
    name: 'IndexView',
    data() {
        return {
            search: '',
            pagination: '',
            posts: [],
            link: {
                name: 'create-post',
                params: {name: 'create-post'},
            }
        }
    },
    components: {
        FormSearch,
        AppPagination,
        TablePosts,
        UiButton,
        UiLink
    },
    mounted() {
        this.getPosts();
    },
    methods: {
        getPosts(page = 1) {
            axios.get('/api/panel/posts', {
                params: {
                    page: page,
                    search: this.search,
                    perPage: 5,
                }
            }).then(res => {
               this.posts = res.data.data;
               this.pagination = res.data.meta;
            }).catch(err => {
                console.log(err)
            })
        }
    },
    computed: {
        ...mapGetters(['user']),
    },

}
</script>

<style scoped lang="scss">

</style>
