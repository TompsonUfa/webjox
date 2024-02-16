<template>
    <div class="container my-3">
        <div class="row mb-3">
            <div class="col-12">
                <h3 class="title">Посты</h3>
            </div>
            <div class="col-12">
                <post-filter :select="this.selectFilter"
                             @select-filter="filter => {this.selectFilter = filter; this.getPosts();} "
                             :filters="this.filters"/>
            </div>
            <div class="col-12">
                <post-list :posts="this.posts"/>
            </div>
        </div>
        <div class="row">
            <div class="col-12" v-if="pagination && pagination.last_page !== 1">
                <app-pagination @get-data="item => getPosts(item)" :pagination="this.pagination" class="home-pagination"></app-pagination>
            </div>
        </div>
    </div>
</template>

<script>
import PostList from "../components/PostList.vue";
import axios from "axios";
import AppPagination from "../components/ui/AppPagination.vue";
import PostFilter from "../components/PostFilter.vue";

export default {
    name: "HomeView",
    components: {
        PostFilter,
        AppPagination,
        PostList
    },
    data() {
        return {
            posts: [],
            selectFilter: null,
            filters: [
                {
                    id: 1,
                    name: 'Отобразить 5 постов',
                    value: 5,
                },
                {
                    id: 2,
                    name: 'Отобразить 10 постов',
                    value: 10,
                },
                {
                    id: 3,
                    name: 'Отобразить 15 постов',
                    value: 15,
                },
            ],
            pagination: null,
        }
    },
    mounted() {
        this.getPosts();
    },
    methods: {
        getPosts(page = 1, perPage = this.selectFilter?.value) {
            axios.get('/api/posts', {
                params: {
                    page: page,
                    perPage: perPage,
                }
            })
                .then(res => {
                    this.posts = res.data.data;
                    this.pagination = res.data.meta;
                })
                .catch(err => {
                    console.log(err)
                })
        }
    }
}
</script>

<style lang="scss">
.title {
    font-weight: 700;
    position: relative;
    padding: 0 0 20px 0;

    margin-bottom: 30px;

    &:before {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 5px;
        background: var(--first-color);
        z-index: 1;
    }

    &:after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: #eee;
    }
}

.home-pagination {
    a {
        &:focus, &:hover {
            box-shadow: none;
            color: var(--first-color);
            background-color: #ddd;
        }

        font-size: 16px;
        font-weight: 700;
        color: #000;
        float: left;
        padding: 6px 15px;
        text-decoration: none;
        -webkit-transition: background-color 0.3s;
        transition: background-color 0.3s;
        border: 1px solid #eee;
        margin: 0 4px;
    }

    .active {
        a {
            color: #fff;
            background-color: var(--first-color);
        }
    }
}
</style>
