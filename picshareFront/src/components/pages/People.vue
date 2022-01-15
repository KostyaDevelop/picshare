<template>
  <div class="people">
    <div class="row">
      <div :class="'user'+ user.userID + ' ' + 'user' + 'col-lg-2 col-md-2 col-sm-2'"
           v-for="(user, userNumber) in people" :key="userNumber">
        <div v-if="user.userAvatar" class="user-avatar">
          <a :href="'/user'+ user.userID">
            <img :src="user.userAvatar">
          </a>
        </div>
        <div v-if="!user.userAvatar"  class="user-avatar">
          <a :href="'/user'+ user.userID">
            <img src="../../assets/img/nameless.png">
          </a>
        </div>
        <div class="user-login">
          <a :href="'/user'+ user.userID">
             {{user.userLogin}}
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import axios from "axios";

export default {
  name: "People",
  data () {
    return {
      people: '',
      userID: this.$store.state.userID
    }
  },
  mounted () {
    axios
        .get('/get-people')
        .then(response => (this.people = response.data))
  }
}
</script>

<style scoped>
  .people{
    padding: 20px;
  }
  .user{
    padding: 10px;
  }
  .user-login{
    padding: 5px;
    font-size: 18px;
    color: #3c3c3c;
  }
  .user-avatar img{
    border-radius: 10px;
    width: 100px;
    height: 110px;
    border: 2px solid #3c3c3c;
  }
</style>