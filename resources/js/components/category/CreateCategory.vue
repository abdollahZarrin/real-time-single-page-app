<template>
    <v-container>
        <v-form @submit.prevent="create">
            <v-text-field
                v-model="form.name"
                label="نام دسته بندی"
                required
                type="text"
            ></v-text-field>
            <v-btn color="teal" v-if="!editing" type="submit">ایجاد</v-btn>
            <v-btn color="teal" v-else @click="editCategory">بروزرسانی</v-btn>
        </v-form>
        <v-card>
            <v-toolbar color="cyan" dark dense class="mt-2">
                <v-toolbar-title>دسته بندی ها</v-toolbar-title>
            </v-toolbar>
            <v-list dense>
                <v-list-item-group v-model="category" color="primary">
                    <v-list-item
                        v-for="(category,index) in categories"
                        :key="category.id"
                    >
                        <v-list-item-content>
                            <v-list-item-title v-text="category.name"></v-list-item-title>
                        </v-list-item-content>
                        <v-spacer></v-spacer>
                        <v-btn icon small @click="edit(index)">
                            <v-icon color="orange">edit</v-icon>
                        </v-btn>
                        <v-btn icon small @click="destroy(category.slug)">
                            <v-icon color="red">delete</v-icon>
                        </v-btn>
                    </v-list-item>
                </v-list-item-group>
            </v-list>
        </v-card>
    </v-container>
</template>

<script>
    export default {
        name: "CreateCategory",
        data(){
            return{
                form:{
                    name:null
                },
                categories:{},
                category:0,
                editing:false,
                editingCategory:{}
            }
        },
        created(){
            if(!User.admin()){
                this.$router.push('/forum');
            }
            axios.get('/api/category')
                .then(res =>{
                    this.categories = res.data.data;
                })
                .catch(error => {
                    console.log(error.response.data);
                });
        },
        methods:{
            create(){
                axios.post('/api/category',this.form)
                    .then(res =>{
                        var newCategory = [];
                        newCategory.push({
                           id:res.data.id,
                           name:res.data.name,
                           slug:res.data.slug,
                        });
                        this.categories.unshift(newCategory[0]);
                        this.form.name = null;
                    })
                    .catch(error =>{
                        console.log(error.response.data);
                    });
            },
            destroy(slug,index){
                axios.delete('/api/category/'+slug)
                    .then(res =>{
                        this.categories.splice(index,1);
                    })
                    .catch(error =>{
                        console.log(error.response.data);
                    });
            },
            edit(index){
                this.form.name = this.categories[index].name;
                this.editingCategory = this.categories[index];
                this.editing = true;
            },
            editCategory(){
                axios.patch('/api/category/'+this.editingCategory.slug,this.form)
                    .then(res =>{
                        for (let i = 0 ; i < this.categories.length ; i++){
                            if(this.categories[i].id === this.editingCategory.id){
                                this.categories[i].name = res.data.name;
                                this.categories[i].slug = res.data.slug;
                            }
                        }
                    })
                    .catch(error =>{
                       console.log(error.response.data);
                    });
            }
        }
    }
</script>

<style scoped>

</style>
