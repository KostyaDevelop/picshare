<template>
  <div class="start-page">
    <div class="start_page-image-container">
      <img src="../../assets/img/start-image.jpg" >
    </div>
    <div class="start_page-login">
      <Login />
    </div>
  </div>
</template>

<script>

import Login from '@/components/pages/Login'

export default {
  name: 'StartPage',
  components: {
    Login
  }
}
</script>

<style scoped>
  .header-container{
    width: 100%;
    display: flex;
    justify-content: space-evenly;
    padding: 0 25%;
    align-items: center;
    background-color: #3c3c3c;
    border-radius: 15px;
  }
  .start-page{
    display: flex;
    padding-top: 60px;
    padding-left: 10%;
  }
  .start_page-image-container{
    width: 50%;
    border: 1px solid #000;
    border-radius: 15px;
  }
  .start_page-image-container img{
    height: 400px;
    width: 100%;
    border-radius: 10px;
  }
  .start_page-login{
    width: 40%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
  }
  .login-form{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
  }
  @media (max-width: 450px) {
    .start_page-image-container{
      display: none;
    }
    .start_page-login{
      width: 100%;
    }
  }
</style>
