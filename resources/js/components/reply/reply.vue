<template>
    <div class="mt-3">
        <v-card>
            <v-card-title>
                <div class="headline ml-2">
                    {{reply.user}}
                </div>
                <div class="grey--text">
                    {{reply.created_at}}
                </div>
            </v-card-title>
                <v-divider></v-divider>
                <editing-reply v-if="editing" :reply="reply"></editing-reply>
                <v-card-text v-else v-html="reply.body"></v-card-text>
            <v-divider></v-divider>
            <v-card-actions v-if="own && !editing">
                <v-btn icon small>
                    <v-icon color="orange" @click="edit">edit</v-icon>
                </v-btn>
                <v-btn icon small @click="destroy">
                    <v-icon color="red">delete</v-icon>
                </v-btn>
            </v-card-actions>
        </v-card>
    </div>
</template>

<script>
    import editingReply from './editReply'
    export default {
        name: "reply",
        components:{
          editingReply
        },
        props:['reply'],
        data(){
            return{
                own:User.own(this.reply.user_id),
                editing:false
            }
        },
        created(){
            this.listen();
        },
        methods:{
            destroy(){
                EventBus.$emit('deleteReply',this.reply.id);
            },
            edit(){
                this.editing=true;
            },
            listen(){
                EventBus.$on('cancelEdit',()=>{
                   this.editing = false;
                });
                EventBus.$on('updateReply',(reply_id,body) => {
                    axios.post('/api/reply/'+reply_id+'/edit',{body:body}).then(res =>{
                        this.reply.id === res.data.reply.id ? this.reply.body = res.data.reply.body : this.reply.body = this.reply.body;
                        this.editing = false;
                    }).catch(error => {
                        console.log(error.response.data);
                    })
                });
            }
        }
    }
</script>

<style scoped>

</style>
