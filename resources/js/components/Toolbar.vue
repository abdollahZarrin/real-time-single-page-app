<template>
    <v-toolbar>
        <v-toolbar-title>Realtime SPA</v-toolbar-title>
        <v-spacer></v-spacer>
        <app-notification v-if="loggedIn"></app-notification>
        <div class="hidden-sm-and-down">
            <router-link
                v-for="item in items"
                :key="item.title"
                :to="item.to"
                v-show="item.show"
            >
                <v-btn text>{{item.title}}</v-btn>
            </router-link>
        </div>
    </v-toolbar>
</template>

<script>
    import AppNotification from "./AppNotification";
    export default {
        components: {AppNotification},
        data(){
            return{
                items:[
                    {title:'انجمن',to:'/forum',show: true},
                    {title:'سوال بپرسید',to:'/ask',show: User.loggedIn()},
                    {title:'ایجاد دسته بندی',to:'/category',show: User.admin()},
                    {title:'ورود',to:'/login',show: !User.loggedIn()},
                    {title:'خروج',to:'/logout',show: User.loggedIn()},
                ],
                loggedIn:User.loggedIn()
            }
        },
        created() {
            EventBus.$on('logout',()=>{
                User.logout();
            });
        }
    }
</script>

<style scoped>

</style>
