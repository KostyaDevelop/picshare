<template>
  <div class="subscribers">
    <div class="subscribers-list">
      <div :id="'user-subscriber-' + userSubscriber.id" class="subscriber-item" v-for="(userSubscriber, userSubscriberNum) in userSubscribers" :key="userSubscriberNum">
        <a :href="'/user' + userSubscriber.id">
          <img src="../../assets/img/nameless.png" v-if="userSubscriber.avatar === ''">
          <img :src="userSubscriber.avatar" v-if="userSubscriber.avatar !== ''">
          <div class="subscriber-item-login">{{userSubscriber.login}}</div>
        </a>
      </div>
    </div>
    <div class="empty-block" v-if="userSubscribers.length === 0">
      No subscriber
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Subscribers",
  data () {
    return {
     userSubscribers: ''
    }
  },
  mounted() {
    axios
        .get('/get-user-subscribers' + this.$route.params.id)
        .then(response => (this.userSubscribers = response.data))
  }
}
</script>

<style scoped>
  .subscribers-list{
    display: flex;
    padding: 20px;
  }
  .subscriber-item{
    padding: 10px;
  }
  .subscriber-item-login{
    padding: 5px;
    font-size: 18px;
    color: #3c3c3c;
  }
  .subscriber-item img{
    border-radius: 10px;
    width: 100px;
    height: 110px;
    border: 2px solid #3c3c3c;
  }
</style>