<template>
    <div class="posts__item">
        <div class="row">
            <div class="col-md-5 mb-2 mb-md-0">
                <div class="posts__prev">
                    <router-link :to="{name: 'post-show', params: {id: post.id}}" class="posts__link">
                        <img :src="post.image.path" :alt="post.title" class="posts__img w-100">
                    </router-link>
                </div>
            </div>
            <div class="col-md-7 my-auto pl-0">
                <div class="posts__content">
                    <div class="posts__tags">
                        <div v-for="tag in post.tags" :key="tag.id" class="posts__tag">
                            {{tag.title}}
                        </div>
                    </div>
                    <div class="posts__meta mb-2">
                        {{formatDate(post.created_at)}}
                    </div>
                    <div class="posts__text">
                        <h5 class="title posts__title">
                            <router-link :to="{name: 'post-show', params: {id: post.id}}" class="posts__link">
                                {{post.title}}
                            </router-link>
                        </h5>
                        <p class="posts__desc">
                            {{post.desc}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment/moment.js";
import 'moment/locale/ru';
    export default {
        name: 'PostListItem',
        props: {
            post: {
                type: Object,
                required: true,
            }
        },
        methods: {
            formatDate(date) {
                return moment(date).format('M MMMM YYYY');
            }
        }
    }
</script>

<style scoped lang="scss">

</style>
