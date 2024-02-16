<template>
    <section class="post-detail my-3">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 p-0">

                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12 post-detail__header">
                    <div class="post-detail__bg"
                         :style="{ backgroundImage: 'url(' + post.image?.path + ')'}"></div>
                    <div class="post-detail__meta">
                        <div class="post-detail__tags">
                            <div v-for="tag in post.tags" :key="tag.id" class="post-detail__tag">
                                {{tag.title}}
                            </div>
                        </div>
                        <h2 class="post-detail__title title">{{ post.title }}</h2>
                        <div class="post-detail__date" v-if="post.created_at">
                            {{ formatDate(post.created_at) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 post-detail__content">
                    <div v-html="post.content"></div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import moment from "moment/moment.js";
import 'moment/locale/ru';

export default {
    name: 'ShowView',
    data() {
        return {
            post: [],
            loading: true,
        }
    },
    mounted() {
        this.id = this.$route.params.id;
        this.getPost();
    },
    methods: {
        getPost() {
            axios.get(`/api/posts/${this.id}`)
                .then(res => {
                    this.post = res.data.data;
                })
                .catch(err => {
                    this.$router.push({name: 'home'});
                })

        },
        formatDate(date) {
            return moment(date).format('M MMMM YYYY');
        }
    },
}
</script>

<style scoped lang="scss">
.post-detail {
    &__header {
        padding-top: 240px;
        padding-bottom: 80px;
        position: relative;
        background-color: #1b1c1e;
    }

    &__bg {
        position: absolute;
        background-position: center center;
        background-size: cover;
        background-repeat: no-repeat;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;

        &:after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            background: -webkit-gradient(linear, left top, left bottom, from(rgba(27, 28, 30, 0)), color-stop(90%, rgba(27, 28, 30, 0.8)));
            background: linear-gradient(180deg, rgba(27, 28, 30, 0) 0%, rgba(27, 28, 30, 0.8) 90%);
        }
    }

    &__meta {
        position: relative;
        z-index: 2;
        padding: 0 30px;
    }

    &__tags {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    &__tag {
        clear: both;
        color: #fff;
        display: inline-block;
        font-size: 13px;
        margin-bottom: 15px;
        padding: 5px 8px;
        background: linear-gradient(285deg, #f92a28 27%, #da1752 100%, #fff 100%);
        line-height: 15px;
        text-transform: uppercase;
        font-family: Montserrat, sans-serif;
        font-weight: 600;
    }

    &__title {
        font-size: 30px !important;
        color: #FFF;
        font-weight: 700;
    }

    &__date {
        color: #fff;
        font-weight: 700;
        font-size: 15px;
    }

    &__content {
        * {
            max-width: 100% !important;
        }
    }
}
</style>
