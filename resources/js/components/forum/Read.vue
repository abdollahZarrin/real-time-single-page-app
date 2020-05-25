<template>
    <edit-question v-if="editing" :data="question"></edit-question>
    <div v-else>
        <v-container>
            <show-question :data="question"></show-question>
            <replies :replies="question.replies"></replies>
            <new-reply v-if="loggedIn" :questionSlug="question.slug"></new-reply>
            <div v-else class="mt-4">
                <router-link to="/login">ورود به حساب کاربری جهت دادن پاسخ</router-link>
            </div>
        </v-container>
    </div>
</template>

<script>
    import showQuestion from './ShowQuestion';
    import EditQuestion from './EditQuestion';
    import replies from '../reply/Replies';
    import newReply from '../reply/newReply'
    export default {
        name: "Read",
        components:{showQuestion,EditQuestion,replies,newReply},
        data(){
          return{
              question:{},
              editing : false
          }
        },
        created(){
            this.getQuestion();
            this.listen();
        },
        computed:{
          loggedIn(){
              return User.loggedIn();
          }
        },
        methods:{
            listen(){
                EventBus.$on('startEditing',()=>{
                   this.editing = true;
                });
                EventBus.$on('cancelEditing',()=>{
                   this.editing = false;
                });
            },
            getQuestion(){
                axios.get('/api/question/'+this.$route.params.slug).then(res =>{
                    this.question = res.data.data;
                }).catch(error => console.log(error.response.data));
            }
        }
    }
</script>

<style scoped>

</style>
