 <template>
  <div class="info-acc">
      <div class="avatar" >
        <img :src="userInfo.userAvatarPath" v-if="userInfo.userAvatarPath !== null && this.$store.state.userID !== this.$route.params.id">
        <form  enctype="multipart/form-data" v-if="this.$store.state.userID === this.$route.params.id">
          <img class="avatar-img-this-user" :src="userInfo.userAvatarPath" v-if="userInfo.userAvatarPath !== null " v-b-modal.modal-avatar>
          <input type="file" id="avatar-set" ref="avatar-set" name="image-avatar-set" class="input-avatar-set" v-on:change="onChange">
          <label for="avatar-set" class="avatar-modal-button input-avatar-set-label" v-if="userInfo.userAvatarPath === null">
            <img src="../../assets/img/nameless.png">
          </label>
        </form>
      </div>
      <div class="name">
          {{userInfo.userName }}
      </div>
    <div v-if="userID !== userPageID" class="subscription-on-user">
      <div class="button">Subscribe</div>
    </div>
    <div class="info-container">
      <div class="posts-count">
        Posts - {{ userInfo.userPostsCount }}
      </div>
      <div class="likes-count">
        Likes- {{ userInfo.userLikesCount }}
      </div>
      <div class="subscribers-count">
        <a :href="'/user' + $route.params.id + '/subscribers'">Subscribers</a>  - {{ userInfo.userSubscribersCount }}
      </div>
      <div class="subscriptions-count">
        <a :href="'/user' + $route.params.id + '/subscriptions'">Subscriptions</a> - {{ userInfo.userSubscriptionsCount }}
      </div>
    </div>
    <b-modal hide-footer hide-header id="modal-avatar" >
      <AvatarCRUD />
    </b-modal>
  </div>
</template>

<script>

import axios from 'axios'
import AvatarCRUD from '@/components/modules/AvatarCRUD'

export default {
  name: 'UserInfo',
  data() {
    return {
      userInfo: '',
      userID: this.$store.state.userID,
      userPageID: this.$route.params.id
    }
  },
  methods: {
    onChange(e) {
      this.file = e.target.files[0];
      this.formSubmit(e)
    },
    formSubmit(e) {
      e.preventDefault();
      const config = {
        headers: {
          'content-type': 'multipart/form-data'
        }
      }

      let data = new FormData();
      data.append('image-avatar-set', this.file);

      let userID = this.$store.state.userID;
      data.append('userID', userID);

      axios.post('/set-avatar', data, config)
    }
  },
  mounted() {
      axios
          .get('/get-user-info' + this.$route.params.id)
          .then(response => (this.userInfo = response.data))
  },
  components: {
    AvatarCRUD
  }
}
</script>

<style scoped>
@media (min-width: 450px) {
  .info-acc{
    border-right: 5px solid #3c3c3c;
  }
  .input-avatar-set{
    display: none;
  }
}
@media (max-width: 450px) {
  .posts-count{
    width: 100%;
    display: flex;
    justify-content: center;
  }
  .likes-count{
    width: 100%;
    display: flex;
    justify-content: center;
  }
  .subscribers-count{
    width: 100%;
    display: flex;
    justify-content: center;
  }
  .subscriptions-count{
    width: 100%;
    display: flex;
    justify-content: center;
  }
}
  .info-acc{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    margin: 20px 0;
    padding: 10px;
  }
  .name{
    margin: 25px 0;
    display: flex;
    justify-content: center;
    font-size: 24px;
    width: 100%;
  }
  .avatar{
    width: 50%;
    display: flex;
    justify-content: center;
  }
  .avatar form{
    width: 100%;
  }
  .avatar img{
    width: 100%;
    height: 110px;
    border-radius: 35%;
    border: 2px solid #3c3c3c;
  }
  .avatar .avatar-img-this-user{
    cursor: pointer;
  }
  .avatar img:focus {
    outline: none !important;
  }
  .posts-count{
    font-size: 20px;
  }
  .likes-count{
    font-size: 20px;
  }
  .subscribers-count{
    font-size: 20px;
  }
  .subscribers-count a{
    color: #000 !important;
    text-decoration: none;
    border-bottom: 1px solid #3c3c3c;
  }
  .subscriptions-count{
    font-size: 20px;
  }
  .subscriptions-count a{
    color: #000 !important;
    text-decoration: none;
    border-bottom: 1px solid #3c3c3c;
  }
  .input-avatar{
    display: none;
  }
   .info-container{
     padding: 10px 0 0 0;
   }
   .input-avatar-set-label img{
     cursor: pointer;
   }
</style>
