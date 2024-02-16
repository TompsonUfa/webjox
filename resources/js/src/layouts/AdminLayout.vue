<template>
    <div class="wrapper">
        <app-sidebar v-if="!isMobile"/>
        <mobile-nav v-else />
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content">
                        <div class="panel my-5">
                            <router-view></router-view>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AppSidebar from "../components/AppSidebar.vue";
import MobileNav from "../components/MobileNav.vue";

export default {
    name: 'AdminLayout',
    components: {MobileNav, AppSidebar},
    data(){
        return{
            isMobile: false,
        }
    },
    created() {
        this.checkScreenSize();
        window.addEventListener('resize', this.checkScreenSize);
    },
    destroyed() {
        window.removeEventListener('resize', this.checkScreenSize);
    },
    methods: {
        checkScreenSize() {
            this.isMobile = window.innerWidth < 768;
        }
    }
}
</script>


<style scoped lang="scss">
.wrapper {
    width: 100%;
    display: flex;
    align-items: stretch;
    overflow-x: clip;
}

.main {
    width: 100%;
    touch-action: pan-y;
}

.panel {
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    padding: 50px;
}

@media screen and (max-width: 768px) {
    .panel {
        padding: 25px;
    }
}
</style>
