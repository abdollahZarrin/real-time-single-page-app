<template>
    <v-card>
        <v-container>
            <v-form @submit.prevent="create">
                <v-text-field
                    v-model="form.title"
                    label="عنوان سوال"
                    required
                    type="text"
                ></v-text-field>

                <v-select
                    :items="categories"
                    item-text="name"
                    item-value="id"
                    label="دسته بندی"
                    v-model="form.category_id"
                    autocomplete
                ></v-select>

                <ckeditor :editor="editor"  v-model="form.body" :config="editorConfig"></ckeditor>


                <v-btn
                    color="success"
                    class="mr-4"
                    type="submit"
                >
                    ایجاد
                </v-btn>

            </v-form>
        </v-container>
    </v-card>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    export default {
        name: "Create",
        data(){
            return{
                form:{
                    title:null,
                    category_id:null,
                    body:null
                },
                categories:{},
                editor: ClassicEditor,
                editorConfig: {
                    language: 'fa'
                }
            }
        },
        created() {
            axios.get('/api/category').then(res =>{
                this.categories = res.data.data;
            }).catch(error =>{
                console.log(error.response.data);
            })
        },
        methods:{
            create(){
                axios.post('/api/question',this.form).then(res =>{
                    this.$router.push(res.data.path);
                }).catch(error =>{
                    console.log(error.response.data);
                })
            }
        }
    }
</script>

<style scoped>

</style>
