<template>
    <div>
        <v-btn icon @click="likeIt">
            <v-icon :color="liked?'red':'red lighten-4'">favorite</v-icon> {{count}}
        </v-btn>
    </div>
</template>

<script>
    export default {
        props:['content'],
        data(){
            return{
                liked:this.content.liked,
                count:this.content.like_count
            }
        },
        methods:{
            likeIt(){
                if(User.loggedIn()){
                    this.liked ? this.decr() : this.incr();
                    this.liked = !this.liked;
                }
            },
            incr(){
                axios.post('/api/like/'+this.content.id).then(res =>{
                    this.count ++;
                });
            },
            decr(){
                axios.delete('/api/like/'+this.content.id).then(res =>{
                    this.count --;
                });
            }
        }
    }
</script>

<style scoped>

</style>
