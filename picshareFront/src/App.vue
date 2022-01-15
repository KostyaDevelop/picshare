<template>
  <div id="app">
    <div class="page">
      <div class="container">
        <Header/>
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script>
import Header from './components/modules/Header.vue'

export default {
  name: 'App',
  components: {
    Header
  }
}
</script>

<style>
  @font-face {
    font-family: 'Yahfie';
    src: url('./assets/fonts/Yahfie.woff2') format('woff2'),
    url('./assets/fonts/Yahfie.woff') format('woff');
    /*font-weight: 400;*/
    /*font-style: normal;*/
    /*font-display: swap;*/
  }
  *{
    font-family: 'Yahfie', serif;
  }
  a{
    color: #000 !important;
    text-decoration: unset !important;
  }
  .page{
    width: 100%;
    margin: 60px auto 30px;
    max-width: 935px;
    text-align: center;
    color: #2c3e50;
  }
  input{
    padding: 5px;
    border: 2px solid #000;
    border-radius: 5px;
  }
  .modal-dialog{
    max-width: 50% !important;
  }
  .modal-content{
    padding: 20px;
    border-radius: 15px !important;
  }
  .empty-block{
    padding: 50px;
    font-size: 26px;
  }
  .button{
    padding: 4px 6px;
    background-color: #2c3e50;
    color: #fff;
    cursor: pointer;
  }
  .title-middle{
    font-size: 24px;
    text-align: center;
  }
  img{
    object-fit: cover;
  }
</style>
