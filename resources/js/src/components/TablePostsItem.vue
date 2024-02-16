<template>
    <tr>
        <td>
            <div class="table__img" v-if="post.image">
                <img :src="post.image.path" :alt="post.title">
            </div>
        </td>
        <td>
            <h5 class="table__title">
                {{ post.title }}
            </h5>
        </td>
        <td>
            <div class="tags">
                <div v-for="tag in post.tags" :key="tag.id" class="tags__item">
                    {{ tag.title }}
                </div>
            </div>
        </td>
        <td>
            <span class="badge badge-dot mr-4">
                <template v-if="Boolean(post.published)">
                    <i class="bg-success"></i>
                Опубликован
                </template>
                <template v-else>
                    <i class="bg-danger"></i>
                Черновик
                </template>
            </span>
        </td>
        <td>
            <ui-dropdown v-if="this.user.permissions.length > 0"
                         @delete-post="postId => this.deletePost(postId)"
                         class="table__dropdown"
                         :items="this.dropdownItems">
            </ui-dropdown>
        </td>
    </tr>
</template>

<script>
import UiDropdown from "./ui/UiDropdown.vue";
import {mapGetters} from "vuex";
import axios from "axios";

export default {
    name: 'TablePostsItem',
    data() {
        return {
            showMenu: false,
            dropdownItems: [
                {
                    id: 1,
                    name: 'Изменить',
                    task: 'update-tasks',
                    link: {
                        name: 'update-post',
                        params: {id: this.post.id},
                    },
                    eventClick: null,
                },
                {
                    id: 2,
                    name: 'Удалить',
                    link: null,
                    task: 'delete-tasks',
                    eventClick: {
                        name: 'delete-post',
                        params: {id: this.post.id},
                    },
                }
            ],
        }
    },
    props: {
        post: {
            type: Object,
            required: true,
        }
    },
    methods: {
        deletePost(postId) {
            axios.delete(`/api/panel/posts/${postId}`)
                .then(res => {
                    console.log(res)
                })
                .catch(err => {
                    console.log(err)
                })
        }
    },
    computed: {
        ...mapGetters(['user']),
    },
    components: {
        UiDropdown
    },
}
</script>

<style scoped lang="scss">
.table {
    &__img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        overflow: hidden;

        img {
            object-fit: cover;
            width: inherit;
            height: inherit;
        }
    }

    &__title {
        font-size: 15px;
    }
}

.tags {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    padding: 0;
    margin: 0;

    &__item {
        color: #fff;
        background-color: var(--first-color);
        padding: 5px;
        font-size: 13px;
        border-radius: 5px;
    }
}

.badge-dot {
    font-size: inherit;
    font-weight: 400;
    padding-right: 0;
    padding-left: 0;
    text-transform: none;
    background: transparent;
    color: var(--main-color);

    i {
        display: inline-block;
        width: 0.375rem;
        height: 0.375rem;
        margin-right: 0.375rem;
        vertical-align: middle;
        border-radius: 50%;
    }
}
</style>
