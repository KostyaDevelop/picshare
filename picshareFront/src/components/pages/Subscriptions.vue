<template>
  <div class="subscriptions">
    <div class="subscriptions-list">
      <div :id="'user-subscription-' + userSubscription.id" class="subscription-item" v-for="(userSubscription, userSubscriptionNum) in userSubscriptions" :key="userSubscriptionNum">
        <a :href="'/user' + userSubscription.id">
          <img src="../../assets/img/nameless.png" v-if="userSubscription.avatar === ''">
          <img :src="userSubscription.avatar" v-if="userSubscription.avatar !== ''">
          <div class="subscription-item-login">{{userSubscription.login}}</div>
        </a>
      </div>
    </div>
    <div class="empty-block" v-if="userSubscriptions.length === 0">
      No subscriber
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Subscriptions",
  data () {
    return {
      userSubscriptions: ''
    }
  },
  mounted() {
    axios
        .get('/get-user-subscriptions' + this.$route.params.id)
        .then(response => (this.userSubscriptions = response.data))
  }
}
</script>

<style scoped>
  .subscriptions-list{
    display: flex;
    padding: 20px;
  }
  .subscription-item{
    padding: 10px;
  }
  .subscription-item-login{
    padding: 5px;
    font-size: 18px;
    color: #3c3c3c;
  }
  .subscription-item img{
    border-radius: 10px;
    width: 100px;
    height: 110px;
    border: 2px solid #3c3c3c;
    
  }
</style>