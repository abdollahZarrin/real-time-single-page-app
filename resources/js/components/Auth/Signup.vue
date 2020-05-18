<template>
    <div>
        <v-container>
            <v-form @submit.prevent="signup">
                <v-text-field
                    v-model="form.name"
                    label="نام"
                    required
                    type="text"
                ></v-text-field>
                <v-text-field
                    v-model="form.email"
                    label="ایمیل"
                    required
                    type="email"
                ></v-text-field>
                <v-text-field
                    v-model="form.password"
                    label="رمز عبور"
                    required
                    type="password"
                ></v-text-field>
                <v-text-field
                    v-model="form.password_confirmation"
                    label="تکرار رمز عبور"
                    required
                    type="password"
                ></v-text-field>


                <v-btn
                    color="success"
                    class="mr-4"
                    type="submit"
                >
                    ثبت نام
                </v-btn>
                <v-btn color="blue" to="/login">ورود </v-btn>

            </v-form>
        </v-container>
    </div>
</template>

<script>
    export default {
        name: "Signup",
        data(){
            return{
                form:{
                    name:null,
                    email:null,
                    password:null,
                    password_confirmation:null
                }
            }
        },
        created(){
          if(User.loggedIn()){
              this.$router.push({name:'forum'});
          }
        },
        methods:{
            signup(){
                axios.post('/api/auth/signup',this.form).then(res =>{
                    User.responseAfterLogin(res);
                }).catch(error => {
                    console.log(error.response.data);
                });
            }
        }
    }
</script>

<style scoped>

</style>
