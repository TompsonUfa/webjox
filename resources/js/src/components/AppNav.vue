<template>
    <nav class="navbar navbar-expand-lg p-0 w-100">
        <div class="container">
            <router-link :to="{name: 'home'}" class="navbar-brand">
                Webjox
            </router-link>
        </div>
    </nav>
</template>

<script>
    export default {
        name: 'AppNav'
    }
</script>

<style scoped lang="scss">
    .navbar-brand{
        font-weight: 700;
        letter-spacing: 1px;
        transition: .3s ease all;
        &:hover {
            color: var(--first-color);
        }
    }
</style>
