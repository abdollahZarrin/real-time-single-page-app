<template>
    <edit-question v-if="editing" :data="question"></edit-question>
    <div v-else>
        <show-question :data="question"></show-question>
    </div>
</template>

<script>
    import showQuestion from './ShowQuestion';
    import EditQuestion from './EditQuestion';
    export default {
        name: "Read",
        components:{showQuestion,EditQuestion},
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
