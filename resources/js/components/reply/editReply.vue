<template>
    <div>
        <ckeditor :editor="editor"  v-model="reply.body" :config="editorConfig"></ckeditor>
        <v-btn dark color="green" class="mt-1" @click="update" :disabled="!reply.body">بروزرسانی</v-btn>
        <v-btn icon class="mt-1" @click="cancel">
            <v-icon color="black">cancel</v-icon>
        </v-btn>
    </div>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    export default {
        name: "editReply",
        props:['reply'],
        data(){
            return{
                editor: ClassicEditor,
                editorConfig: {
                    language: 'fa'
                }
            }
        },
        methods:{
            update(){
                EventBus.$emit('updateReply',this.reply.id,this.reply.body);
            },
            cancel(){
                EventBus.$emit('cancelEdit');
            }
        }
    }
</script>

<style scoped>

</style>
