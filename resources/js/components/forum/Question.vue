<template>
    <v-card class="mt-2">

        <v-card-title primary-title>
            <div>
                <h3 clqass="headline mb-0">
                    <router-link :to="data.path">
                        {{data.title}}
                    </router-link>
                </h3>
                <div class="grey--text">
                    {{data.created_at}}
                    {{data.user}}
                </div>
            </div>
        </v-card-title>

        <v-card-text class="text--primary" v-html="body">
        </v-card-text>
    </v-card>
</template>

<script>
    import md from 'marked';
    export default {
        name: "Question",
        props:['data'],
        computed:{
            body(){
                return md.parse(this.data.body)
            }
        }
    }
</script>

<style scoped>

</style>
