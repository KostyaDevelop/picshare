<template>
  <div class="detail-photo-container">
    <div class="row">
      <div class="col-md-7">
        <img class="modal-photo" :src="photoPath">
      </div>
      <div class="col-md-5">
        <div class="photo-info-header" >
          <div class="photo-info-header-left" >
            <svg  @click="setPhotoLike(photoID)" width="56px" height="56px" viewBox="0 0 56 56" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
              <g id="Icons-56/like_outline_56" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g id="like_outline_56">
                  <polygon points="0 0 56 0 56 56 0 56"></polygon>
                  <path d="M18.2894737,11 C11.5021848,11 6,16.5021848 6,23.2894737 C6,30.1547097 8.75158974,33.5980763 20.454993,42.7007233 L25.8512079,46.8977793 C27.1150945,47.8808023 28.8849055,47.8808023 30.1487921,46.8977793 L35.545007,42.7007233 C47.2484103,33.5980763 50,30.1547097 50,23.2894737 C50,16.5021848 44.4978152,11 37.7105263,11 C34.050349,11 30.7993729,12.7358213 28,16.0983552 C25.2006271,12.7358213 21.949651,11 18.2894737,11 Z M18.2894737,14 C21.4186747,14 24.2227444,15.7559317 26.7662689,19.4339873 L26.9718908,19.7313261 C27.3645538,20.2991351 28.1431702,20.441119 28.7109792,20.0484561 C28.8349437,19.9627296 28.9423827,19.8552906 29.0281092,19.7313261 L29.2337311,19.4339873 L29.2337311,19.4339873 C31.7772556,15.7559317 34.5813253,14 37.7105263,14 C42.840961,14 47,18.159039 47,23.2894737 C47,28.9059372 44.7096941,31.7720486 33.7031852,40.3326667 L28.3069703,44.5297227 C28.1264151,44.6701545 27.8735849,44.6701545 27.6930297,44.5297227 L22.2968148,40.3326667 C11.2903059,31.7720486 9,28.9059372 9,23.2894737 C9,18.159039 13.159039,14 18.2894737,14 Z" id="↳-Icon-Color" fill="currentColor" fill-rule="nonzero"></path>
                </g>
              </g>
            </svg>
            <span class="like-number">{{photoLike}}</span>
          </div>
          <div class="photo-info-header-right" >
            <div class="delete-photo" v-if="this.$store.state.userID === this.$route.params.id" @click="photoDelete(photoID)">Delete</div>
          </div>
        </div>
        <div class="modal-photo-comments" >
          <div class="modal-photo-comments-content" >
            <div class="photo-comment"  v-for="(photoCom, photoComNumber) in photoComments" :key="photoComNumber">
              <div class="photo-comment-head">
                <div class="photo-comment-head-avatar">
                  <!--                  <a :href="'/user' + photoCom.photoUserID">-->
                  <img :src="photoCom.photoUserAvatar">
                  <!--      </a>-->
                </div>
                <div class="photo-comment-head-login">
<!--                  <a :href="'/user' + photoCom.photoUserID">-->
                    {{photoCom.photoUserLogin}}
<!--                  </a>-->
                </div>
              </div>
              <div class="photo-comment-text">
                {{photoCom.photoComText}}
              </div>
            </div>
          </div>
          <div class="modal-photo-comments-input" >
            <input id="photoComment" v-model="inputPhotoCom" @keyup.enter="sendPhotoComment(userID, photoID, inputPhotoCom)" type="text" placeholder="Comment!">
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import axios from 'axios'

export default {
  name: 'PhotoDetail',
  props: ['photoID', 'photoPath', 'photoLike', 'photoComments'],
  data () {
    return {
      id: null,
      inputPhotoCom: '',
      userID: this.$route.params.id,
    }
  },
  methods: {
    sendPhotoComment (userID, photoID, photoCom) {
      let data = {
        photoID: photoID,
        photoCom: photoCom,
        userID: userID,
      };
      axios
            .post('/set-photo-com', data)
    },
    setPhotoLike (photoID, userLogID = this.$store.state.userID) {
      axios
        .put('/set-photo-like/' + photoID + '/' + userLogID)
    },
    photoDelete (photoID) {
      axios
        .delete('/delete-photo' + photoID)
    }
  }
}
</script>

<style>
  .modal-photo {
    width: 100%;
    height: 400px;
    border-radius: 15px;
  }
  .detail-photo-container{
    height: 400px;
  }
  .photo-info-header{
    display: flex;
    align-items: center;
    padding: 15px 0;
  }
  .photo-info-header svg{
    width: 35px;
    height: 35px;
    margin: 0 5px;
    cursor: pointer;
  }
  .photo-like-img{
    cursor: pointer;
    margin: 0 5px;
  }
  .modal-photo-comments-content{
    height: 275px;
    min-height: 0;
    overflow: auto;
    -webkit-flex-shrink: 1;
    margin: 10px 0;
  }
  .photo-info-header-left{
    width: 100%;
  }
  .delete-photo{
    cursor: pointer;
    color: #3c3c3c;
    text-decoration: underline;
  }
  .modal-photo-comments-input input{
    width: 100%;
    border: 2px solid #3c3c3c;
  }
  .photo-comment{
    padding-bottom: 10px;
  }
  .photo-comment-head{
    display: flex;
    justify-content: flex-start;
    align-items: center;
  }
  .photo-comment-head-avatar img{
    width: 30px;
    height: 30px;
    border-radius: 100%;
  }
  .photo-comment-head-login{
    padding-left: 10px;
    font-weight: bold;
  }
</style>
