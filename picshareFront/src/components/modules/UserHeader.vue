<template>
  <div class="header-user">
    <div class="row">
      <div class="col-lg-2 col-md-2 col-sm-2">
        <div class="header-user-title posts">
          <a :href="'/user' + userID + '/posts'">
            Posts
          </a>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2">
        <div class="header-user-title people">
          <a :href="'/people'">
            People
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
<!--        <div class="user-control">-->
<!--          <div class="search-box">-->
<!--            <input type="search" placeholder="Find your friends">-->
<!--          </div>-->
<!--        </div>-->
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2">
        <div v-if="this.$store.state.userID === this.$route.params.id" class="add-photo-icon" >
          <form  enctype="multipart/form-data">
            <input type="file" id="file" ref="file" name="image" class="input-file" v-on:change="onChange">
            <label for="file">
              <div class="header-user-title add-photo">
                  Add photo
              </div>
            </label>
          </form>
        </div>
      </div>
      <div class="col-lg-1 col-md-1 col-sm-1">
        <div v-if="this.$store.state.userID === this.$route.params.id" class="header-user-title settings-icon" v-b-modal.modal-settings>
          <div class="header-user-title settings">
              Settings
          </div>
        </div>
        <div v-if="this.$store.state.userID === this.$route.params.id" v-on:click="logout" class="header-user-title button-logout">
          Logout
        </div>
      </div>
      <div class="col-lg-1 col-md-1 col-sm-1">
<!--        <div class="header-user notification"  v-if="this.$store.state.userID === this.$route.params.id" v-b-modal="'notifications-detail'">-->
<!--          <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">-->
<!--            <g data-name="Layer 30" id="Layer_30">-->
<!--              <path class="cls-1"-->
<!--                    d="M27,27H5a1,1,0,0,1-.89-1.45,18.14,18.14,0,0,0,1.89-8V14a10,10,0,0,1,20,0v3.53a18.14,18.14,0,0,0,1.89,8A1,1,0,0,1,27,27ZM6.55,25h18.9A20.14,20.14,0,0,1,24,17.53V14A8,8,0,0,0,8,14v3.53A20.14,20.14,0,0,1,6.55,25Z"/>-->
<!--              <path class="cls-1"-->
<!--                    d="M16,31a5,5,0,0,1-5-5,1,1,0,0,1,2,0,3,3,0,0,0,.88,2.12,3.08,3.08,0,0,0,4.24,0,1,1,0,0,1,1.42,1.42A5,5,0,0,1,16,31Z"/>-->
<!--              <path class="cls-1" d="M16,6a1,1,0,0,1-1-1V2a1,1,0,0,1,2,0V5A1,1,0,0,1,16,6Z"/>-->
<!--            </g>-->
<!--          </svg>-->
<!--          <div class="number" v-if="notifications === true" onclick="clearNotifications()">-->
<!--            5-->
<!--          </div>-->
<!--        </div>-->
      </div>
    </div>
    <b-modal hide-footer hide-header id="notifications-detail">
      <Notifications  />
    </b-modal>
    <b-modal hide-footer hide-header id="modal-settings" >
      <SettingsUser  />
    </b-modal>
    <b-modal ref="m" hide-footer hide-header id="modal-photo-success" >
      Изображение успешно добавлено!
    </b-modal>
  </div>
</template>

<script>

import SettingsUser from '@/components/modules/SettingsUser'
import Notifications from '@/components/modules/Notifications'
import axios from "axios";

export default {
  name: 'UserHeader',
  components: {
    SettingsUser,
    Notifications
  },
  data () {
    return {
      userID: this.$store.getters.getLoggedUserID,
      notifications: true
    }
  },
  methods: {
    clearNotifications() {
      document.getElementFromSelector('.number').html("");
    },
    onChange(e) {
      this.file = e.target.files[0];
      this.formSubmit(e)
    },
    formSubmit(e) {
      e.preventDefault();
      let existingObj = this;

      const config = {
        headers: {
          'content-type': 'multipart/form-data'
        }
      }
      let data = new FormData();
      data.append('image', this.file);

      let userID = this.$store.state.userID;
      data.append('userID', userID);

      axios.post('/add-user-photo',data, config)
          .then(function (res) {
            existingObj.success = res.data.success;
            this.$modal.show("modal-photo-success");
          })
    },
    logout(){
      this.$store.dispatch('logout')
    }
  }
}
</script>

<style scoped>
  .header-user{
    background-color: #3c3c3c;
    padding: 10px 0;
    border-radius: 0 0 15px 15px;
  }
  .header-user-title{
    font-size: 20px;
    text-decoration: underline;
    color: #fff !important;
    cursor: pointer;
  }
  .header-user-title a{
    color: #fff !important;
  }
  .input-file{
    display: none;
  }
  .notification svg{
    fill: #fff;
    width: 30px;
    height: 30px;
    cursor: pointer;
  }
  .notification{
    position: relative;
  }
  .notification .number{
    position: absolute;
    color: #fff;
    background: red;
    border-radius: 100%;
    width: 20px;
    height: 20px;
    right: 5px;
    top: 7px;
  }
  .notification:focus-visible, .header-user-title:focus-visible{
    border: none;
  }
  .button-logout{
    font-size: 20px;
    color: #fff;
    cursor: pointer;
  }
</style>
