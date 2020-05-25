<template>
    <div class="mt-3">
        <ckeditor :editor="editor"  v-model="body" :config="editorConfig"></ckeditor>
        <v-btn dark color="green" :disabled="!body" class="mt-1" @click="reply">پاسخ</v-btn>
    </div>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    export default {
        props:['questionSlug'],
        name: "newReply",
        data(){
          return{
              body:null,
              editor: ClassicEditor,
              editorConfig: {
                  language: 'fa'
              }
          }
        },
        methods:{
            reply(){
                axios.post('/api/question/'+this.questionSlug+'/reply',{body:this.body,user_id:User.id()}).then(res =>{
                    this.body = '';
                    EventBus.$emit('newReply',res.data.reply);
                }).catch(error =>{
                    console.log(error.response.data);
                })
            }
        }

    }
</script>

<style scoped>

</style>
