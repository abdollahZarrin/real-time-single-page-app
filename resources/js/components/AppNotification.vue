<template>
    <div class="text-center">
        <v-menu offset-y>
            <template v-slot:activator="{ on }">
                <v-btn
                    icon
                    v-on="on"
                >
                    <v-icon :color="unreadCount > 0 ? 'red' : 'red lighten-4'">
                        add_alert
                    </v-icon> {{unreadCount}}
                </v-btn>
            </template>
            <v-list>
                <v-list-item
                    v-for="item in unread"
                    :key="item.id"
                >
                    <router-link :to="item.path">
                        <v-list-item-title @click="readIt(item)">{{item.question}}</v-list-item-title>
                    </router-link>
                </v-list-item>
                <v-divider></v-divider>
                <v-list-item
                    v-for="item in read"
                    :key="item.id"
                >
                        <v-list-item-title>{{item.question}}</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                read:{},
                unread:{},
                unreadCount:0,
                sound:'https://notificationsounds.com/soundfiles/d7a728a67d909e714c0774e22cb806f2/file-sounds-1150-pristine.mp3'
            }
        },
        created() {
            if(User.loggedIn()){
                this.getNotifications();
            }
            Echo.private('App.User.' + User.id())
                .notification((notification) => {
                    this.unread.unshift(notification);
                    this.unreadCount++;
                    var audio = new Audio(this.sound);
                    audio.play();
                });
        },
        methods:{
            getNotifications(){
                axios.post('/api/notifications')
                    .then(res =>{
                       this.read = res.data.read;
                       this.unread = res.data.unread;
                       this.unreadCount = res.data.unread.length;
                    }).catch(error =>{
                   Exception.handle(error);
                });
            },
            readIt(item){
                axios.post('/api/markAsRead',{id:item.id})
                    .then(res =>{
                       this.unread.splice(item,1);
                       this.read.push(item);
                       this.unreadCount--;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
