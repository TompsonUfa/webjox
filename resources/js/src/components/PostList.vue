<template>
    <div class="posts">
        <post-list-item :post="post" v-for="post in posts" :key="post.id">
        </post-list-item>
    </div>
</template>

<script>
    import PostListItem from "./PostListItem.vue";

    export default {
        name: 'PostList',
        components: {PostListItem},
        props: {
            posts: {
                type: Array,
                required: true,
            }
        }
    }
</script>

<style lang="scss">
.posts {
    &__item {
        margin-top: 30px;
        &:hover {
            .posts__img {
                transform: scale3d(1.1, 1.1, 1);
                -webkit-transform: scale3d(1.1, 1.1, 1);
                -moz-transform: scale3d(1.1, 1.1, 1) rotate(0.02deg);
            }
        }
    }
    &__prev{
        max-width: 100%;
        height: 230px;
        overflow: hidden;
    }
    &__img {
        max-width: 100%;
        height: 230px;
        -o-object-fit: cover;
        object-fit: cover;
        background-color: #000;
        margin-bottom: 0;
        -webkit-transition: 0.2s ease-in-out;
        transition: 0.2s ease-in-out;
    }
    &__tags{
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }
    &__tag{
        clear: both;
        color: #fff;
        display: inline-block;
        font-size: 10px;
        margin-bottom: 7px;
        padding: 5px 8px;
        background: linear-gradient(285deg, #f92a28 27%, #da1752 100%, #fff 100%);
        line-height: 15px;
        text-transform: uppercase;
        font-family: Montserrat, sans-serif;
        font-weight: 600;
    }
    &__meta {
        font-size: 12px;
        font-weight: 700;
        font-family: Montserrat, sans-serif;
        line-height: 1;
        margin: 0;
        padding: 0;
        list-style: none;
        letter-spacing: 0.5px;
        text-transform: capitalize;
    }
    &__title {
        font-family: Montserrat, sans-serif;
        font-weight: 700;
        margin-bottom: 10px;
        a {
            color: #000;
            text-decoration: none;
            text-transform: capitalize;
            transition: .2s ease;
            &:hover {
                color: var(--first-color);
            }
        }
    }
    &__desc {
        line-height: 24px;
        font-size: 14px;
        text-align: left;
        margin-bottom: 0;
    }
}
</style>
