<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li @click.prevent="this.$emit('getData', pagination.current_page - 1)" class="page-item"
                v-if="pagination.current_page !== 1"><a class="page-link" href="#">Назад</a></li>
            <li :class="link.active ? 'active' : ''" class="page-item" v-for="link in pagination.links">
                <template v-if="Number(link.label)
                        && (pagination.current_page - link.label < 2
                        && pagination.current_page - link.label > -2) || Number(link.label) === 1 || Number(link.label) === pagination.last_page ">
                    <a @click.prevent="this.$emit('getData', link.label)" class="page-link" href="#">{{
                            link.label
                        }}</a>
                </template>
                <template v-if="Number(link.label) &&
                        pagination.current_page !== 3 &&
                        pagination.current_page - link.label === 2 ||
                        Number(link.label) &&
                        pagination.current_page !== pagination.last_page -2 &&
                        pagination.current_page - link.label === -2">
                    <a class="page-link">...</a>
                </template>
            </li>
            <li @click.prevent="this.$emit('getData', pagination.current_page + 1)" class="page-item"
                v-if="pagination.current_page !== pagination.last_page"><a class="page-link" href="#">Вперед</a>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        name: 'AppPagination',
        props: {
            pagination: {
                required: true,
            }
        },
        emits: ['getData'],
    }
</script>

<style  lang="scss">
    .active.page-item{
        .page-link {
            color: #fff;
            border-color: var(--first-color);
            background-color: var(--first-color);
        }
    }
    .page-link {
        color: var(--first-color);
    }
</style>
