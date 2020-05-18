<template>
    <div>
        <v-container>
            <v-form @submit.prevent="login">
                <v-text-field
                    v-model="form.email"
                    label="ایمیل"
                    required
                    type="email"
                ></v-text-field>
                <v-text-field
                    v-model="form.password"
                    label="پسورد"
                    required
                    type="password"
                ></v-text-field>


                <v-btn
                    color="success"
                    class="mr-4"
                    type="submit"
                >
                    ورود
                </v-btn>

                <v-btn color="blue" to="/signup">ثبت نام</v-btn>

            </v-form>
        </v-container>
    </div>
</template>

<script>
    export default {
        name: "Login",
        data(){
            return{
                form:{
                    email:null,
                    password:null
                }
            }
        },
        created(){
            if(User.loggedIn()){
                this.$router.push({name:'forum'});
            }
        },
        methods:{
            login(){
                User.login(this.form);
            }
        }
    }
</script>

<style scoped>

</style>
