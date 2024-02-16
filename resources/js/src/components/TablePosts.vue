<template>
    <div class="wrap-table mb-3">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Пост</th>
                    <th scope="col">Тэги</th>
                    <th scope="col" colspan="2">Статус</th>
                </tr>
            </thead>
            <tbody>
                <table-posts-item :post="post" v-for="post in posts" :key="post.id"></table-posts-item>
            </tbody>
        </table>
    </div>
</template>

<script>
import TablePostsItem from "./TablePostsItem.vue";

export default {
    name: 'TablePosts',
    components: {
        TablePostsItem,
    },
    props: {
        posts: {
            type: Array,
            required: true,
        }
    }
}
</script>

<style scoped lang="scss">
    .wrap-table{
        overflow: auto;
        min-height: 400px;
    }
</style>
