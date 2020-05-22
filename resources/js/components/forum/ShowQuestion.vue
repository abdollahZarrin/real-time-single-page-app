<template>
    <v-card>
        <v-container>
            <v-card-title>
                <div>
                    <div class="headline">
                        {{data.title}}
                    </div>
                    <span class="grey--text">{{data.created_at}} {{data.user}}</span>
                </div>
                <v-spacer></v-spacer>
                <v-btn color="teal">{{data.replies_count}} پاسخ</v-btn>
            </v-card-title>
            <v-card-text v-html="data.body"></v-card-text>
            <v-card-actions v-if="data.own">
                <v-btn small icon @click="edit">
                    <v-icon color="orange">edit</v-icon>
                </v-btn>
                <v-btn small icon @click="destroy">
                    <v-icon color="red">delete</v-icon>
                </v-btn>
            </v-card-actions>
        </v-container>
    </v-card>
</template>

<script>
    export default {
        props:['data'],
        methods:{
            destroy(){
                axios.delete('/api/question/'+this.data.slug).then(res =>{
                    this.$router.push('/forum');
                }).catch(error =>{
                   console.log(error.response.data);
                });
            },
            edit(){
                EventBus.$emit('startEditing');
            }
        }
    }
</script>

<style scoped>

</style>
