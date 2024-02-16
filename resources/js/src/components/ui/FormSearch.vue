<template>
    <form class="d-flex" @submit.prevent="this.$emit('getData', this.search)">
        <input class="form-control rounded-end-0" name="search" type="text" v-model="this.search"
               placeholder="Поиск...">
        <ui-button class="rounded-start-0" type="submit">Найти</ui-button>
    </form>
</template>

<script>
    import UiButton from "./UiButton.vue";

    export default {
        name: 'FormSearch',
        components: {UiButton},
        data(){
            return{
                search: '',
            }
        },
        emits: ['getData'],
    }
</script>

<style scoped lang="scss">

</style>
