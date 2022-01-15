<template>
  <div class="settings-user">
    <div class="settings-title title-middle">
      Settings
    </div>
    <div class="settings-user-fields">
      <div class="settings-user-fields-field">
        <div>Change username</div><input type="text" autocomplete="new-password" :placeholder="userInfo.userLogin">
      </div>
      <div class="settings-user-fields-field">
        <div>Change name</div><input type="text" autocomplete="new-password" :placeholder="userInfo.userName">
      </div>
      <div class="settings-user-fields-field">
        <div>Change email</div><input type="email" autocomplete="new-password" :placeholder="userInfo.userEmail">
      </div>
      <div class="settings-user-fields-field">
        <div>Change password</div><input type="password" autocomplete="new-password">
      </div>
    </div>
  </div>
</template>

<script>

import axios from 'axios'
export default {
  name: 'SettingsUser',
  data(){
    return {
      userInfo: null
    }
  },
  mounted() {
    axios.get('/get-user-info-settings/' + this.$store.state.userID)
        .then(response => (this.userInfo = response.data))
  }
}
</script>

<style scoped>
  .settings-user {
    width: 100%;
    height: 350px;
  }
  .settings-title{
    margin: 20px 0;
  }
  .settings-login{
    width: 80%;
    display: flex;
    justify-content: center;
  }
  .settings-user-fields-field{
    padding: 15px 0;
    display: flex;
    justify-content: start;
    align-items: center;
  }
  .settings-user-fields-field div{
    padding: 0 20px 0 0;
    width: 25%;
  }
  .settings-user-fields-field input{
    width: 200px;
  }
  .settings-user-fields-field input::placeholder{
    padding: 15px 0;
  }
</style>
