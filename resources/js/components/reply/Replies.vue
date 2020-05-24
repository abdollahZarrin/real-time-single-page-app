<template>
    <div>
        <reply v-for="reply in content" :key="reply.id" :reply="reply"></reply>
    </div>
</template>

<script>
    import reply from './reply';
    export default {
        props:['replies'],
        name: "Replies",
        components:{reply},
        data(){
          return{
              content:{}
          }
        },
        created(){
          this.listen();
        },
        methods:{
            listen(){
                EventBus.$on('newReply',(reply)=>{
                    this.content.unshift(reply);
                });
                window.scrollTo(0,0);
                EventBus.$on('deleteReply',(reply_id)=>{
                   axios.delete('/api/reply/'+reply_id).then(res =>{
                       for (let i = 0 ; i < this.replies.length ; i++){
                           if(this.replies[i].id === reply_id){
                               var index = this.replies.indexOf(this.replies[i]);
                               this.replies.splice(index,1);
                           }
                       }
                   });
                });
                Echo.private('App.User.' + User.id())
                    .notification((notification) => {
                        this.content.unshift(notification.reply);
                    });
                Echo.channel('deleteReplyChannel')
                    .listen('DeleteReplyEvent', (e) => {
                        for (let i = 0 ; i < this.content.length ; i++){
                            if(this.content[i].id === reply_id){
                                var index = this.content.indexOf(this.content[i]);
                                this.content.splice(index,1);
                            }
                        }
                    });
            }
        },
        watch: {
            replies(value) {
                this.content = value;
            }
        }
    }
</script>

<style scoped>

</style>
