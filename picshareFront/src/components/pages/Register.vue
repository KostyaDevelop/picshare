<template>
  <div class="register">
    <form @submit.prevent="register">
      <div class="row">
        <div class="col-lg-6">
          <div class="register-image-container">
            <img src="../../assets/img/start-image.jpg" >
          </div>
        </div>
        <div class="col-lg-6">
          <h1>Register</h1>
          <div class="register-item">
            <label for="name">Name</label>
            <input placeholder="Input your name" id="name" type="text" v-model="name" required autofocus>
          </div>
          <div class="register-item">
            <label for="login">Login</label>
            <input placeholder="Input your login" id="login" type="text" v-model="login" required>
          </div>
          <div class="register-item">
            <label for="email" >E-Mail Address</label>
            <input placeholder="Input your email" id="email" type="email" v-model="email" required>
          </div>
          <div class="register-item">
            <label for="password">Password</label>
            <input placeholder="Input your password" id="password" type="password" v-model="password" required>
          </div>
          <div class="register-item">
            <button type="submit">Register</button>
          </div>
          <div class="login-form-item login-form-registration">
            Registered yet?
            <a href="/login">login</a>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data(){
    return {
      name: "",
      login: "",
      email: "",
      password: "",
    }
  },
  methods: {
    register: function () {
      let data = {
        login: this.login,
        name: this.name,
        email: this.email,
        password: this.password,
        is_admin: this.is_admin
      }
      axios
          .post('/reg-user', data)
            .then(
              window.location.href = '/'
            )
    }
  }
}
</script>

<style scoped>
  .register{
    padding: 60px 0 60px 10%;
  }
  .register .register-item{
    padding: 5px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
  }
  .register .register-item label{
    width: 100%;
  }
  .register .register-item button{
    height: 40px;
    margin: 10px 0;
    width: 120px;
  }
  .register-image-container{
    border: 1px solid #000;
    border-radius: 15px;
  }
  .register-image-container img{
    height: 400px;
    width: 100%;
    border-radius: 10px;
  }
</style>