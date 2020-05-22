<template>
    <v-card>
        <v-toolbar color="cyan" dark dense class="mt-2">
            <v-toolbar-title>دسته بندی ها</v-toolbar-title>
        </v-toolbar>
        <v-list dense>
            <v-list-item-group v-model="category" color="primary">
                <v-list-item
                    v-for="category in categories"
                    :key="category.id"
                >
                    <v-list-item-content>
                        <v-list-item-title v-text="category.name"></v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list-item-group>
        </v-list>
    </v-card>
</template>

<script>
    export default {
        name: "AppSidebar",
        data(){
            return{
                categories:{},
                category:1
            }
        },
        created() {
            axios.get('/api/category')
                .then(res =>{
                    this.categories = res.data.data;
                })
                .catch(error => {
                   console.log(error.response.data);
                });
        }
    }
</script>

<style scoped>

</style>
