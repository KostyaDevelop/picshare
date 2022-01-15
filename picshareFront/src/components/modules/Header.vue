<template>
  <div class="header">
    <div class="header-container">
      <div class="title">
        <a href="/">
          PicShare
        </a>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'StartPage',
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
    border-radius: 10px 10px 0 0;
  }
  .title{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 60px;
    font-size: 40px;
    border-radius: 15%;
  }
  .title a{
    color: #fff !important;
  }
  .logout{
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .logout a{
    color: #fff !important;
  }
  .user-control{
    display: flex;
    justify-content: center;
  }
</style>
