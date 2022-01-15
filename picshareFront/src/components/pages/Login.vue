<template>
  <div class="login">
    <form class="login-form" v-on:submit.prevent="login" >
      <h1>Sign in</h1>
      <div class="login-form-item login-form-email">
        <input required v-model="email" type="email" placeholder="Input your email"/>
      </div>
      <div class="login-form-item login-form-password">
        <input required v-model="password" type="password" placeholder="Input your password"/>
      </div>
      <button class="login-form-item" type="submit">Login</button>
      <hr/>
      <div class="login-form-item login-form-registration">
        Not registered yet?
        <a href="/register">registration</a>
      </div>
    </form>
  </div>
</template>

<script>

import axios from "axios";

export default {
  name: 'Login',
  data(){
    return {
      email : "",
      password : ""
    }
  },
  methods: {
    login: function () {
      let data = {
        email: this.email,
        password: this.password,
      }
      axios
          .post('/log-user', data)
          .then(response => {
            let id = response.data.userID
            let token = response.data.userToken
            let user = {
              id: id,
              token: token,
            }
            this.$store.dispatch('login', {user})
            window.location.href = '/user' + response.data.userID
          });
    }
  }
}
</script>

<style scoped>
   .start_page-login{
    padding: 20px;
  }
  .login-form-item{
    margin: 10px 0;
  }
  .login-form-registration a{
    border-bottom: 1px;
    border-bottom: 1px solid #3c3c3c;
  }
  .login-form button{
    height: 40px;
    width: 50%;
  }
</style>
