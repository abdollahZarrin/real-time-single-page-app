<template>
    <div>
        <toolbar></toolbar>
        <router-view></router-view>
        <!--<parallax v-if="['home'].includes($route.name)"></parallax>-->
        <app-footer></app-footer>
    </div>
</template>

<script>
    import toolbar from './Toolbar';
    import AppFooter from './AppFooter';
    import Parallax from "./Parallax";
    export default {
        components:{
            Parallax,
            toolbar,
            AppFooter
        }
    }
</script>

<style scoped>

</style>
