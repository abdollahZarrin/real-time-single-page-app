<template>
    <v-container>
        <v-form @submit.prevent="edit">
            <v-text-field
                v-model="form.title"
                label="عنوان سوال"
                required
                type="text"
            ></v-text-field>

            <ckeditor :editor="editor"  v-model="form.body" :config="editorConfig"></ckeditor>

            <v-card-actions>
                <v-btn small icon type="submit">
                    <v-icon color="teal">save</v-icon>
                </v-btn>
                <v-btn small icon @click="cancel">
                    <v-icon>cancel</v-icon>
                </v-btn>
            </v-card-actions>

        </v-form>
    </v-container>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    export default {
        props:['data'],
        data(){
            return{
                form:{
                    title: null,
                    body : null
                },
                editor: ClassicEditor,
                editorConfig: {
                    language: 'fa'
                }
            }
        },
        created(){
            this.form = this.data;
        },
        methods:{
            cancel(){
                EventBus.$emit('cancelEditing');
            },
            edit(){
                axios.patch('/api/question/'+this.data.slug,this.form).then(res =>{
                   this.cancel();
                }).catch(error =>{
                    console.log(error.response.data);
                })
            }
        }
    }
</script>

<style scoped>

</style>
