<template>
  <div class="content">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4" v-for="(photo, photoNumber) in userPhotos" :key="photoNumber">
            <div :id="'photo-' + photo.photoID" class="photo-container"  v-b-modal="'modal-photo-' + photo.photoID">
                <div class="photo-hover">
                  <div class="photo-hover-item photo-hover-like">
                    <svg viewBox="0 0 24 24">
                      <path class="a"
                            d="M20,15.659h0a1.5,1.5,0,1,1,0,3H19a1.5,1.5,0,0,1,1.5,1.5c0,.829-.672,1-1.5,1H12.5c-2.851,0-3.5-.5-7-1v-8.5c2.45,0,6.5-4.5,6.5-8.5,0-1.581,2.189-2.17,3,.719.5,1.781-1,5.281-1,5.281h8a1.5,1.5,0,0,1,1.5,1.5c0,.829-.672,2-1.5,2H21a1.5,1.5,0,0,1,0,3H20"/>
                      <path class="a" d="M3.25,19.659a.25.25,0,1,0,.25.25.25.25,0,0,0-.25-.25"/>
                    </svg>
                    <div class="photo-hover-item-count photo-hover-like-count">
                      {{photo.photoLike}}
                    </div>
                  </div>
                  <div class="photo-hover-item photo-hover-com">
                    <svg viewBox="0 0 24 24">
                      <path d="M8.2881437,19.1950792 C8.38869181,19.1783212 8.49195996,19.1926955 8.58410926,19.2362761 C9.64260561,19.7368747 10.8021412,20 12,20 C16.418278,20 20,16.418278 20,12 C20,7.581722 16.418278,4 12,4 C7.581722,4 4,7.581722 4,12 C4,13.7069096 4.53528582,15.3318588 5.51454846,16.6849571 C5.62010923,16.830816 5.63909672,17.022166 5.5642591,17.1859256 L4.34581002,19.8521348 L8.2881437,19.1950792 Z M3.58219949,20.993197 C3.18698783,21.0590656 2.87870208,20.6565881 3.04523765,20.2921751 L4.53592782,17.0302482 C3.54143337,15.5576047 3,13.818993 3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 C21,16.9705627 16.9705627,21 12,21 C10.707529,21 9.4528641,20.727055 8.30053434,20.2068078 L3.58219949,20.993197 Z"/>
                    </svg>
                    <div class="photo-hover-item-count photo-hover-item-com-count" v-if="photo.photoComCount">
                      {{photo.photoComCount}}
                    </div>
                    <div class="photo-hover-item-count photo-hover-item-com-count" v-if="!photo.photoComCount">
                      0
                    </div>
                  </div>
                </div>
              <div class="photo">
                <img :src="photo.photoPath">
              </div>
              <b-modal hide-footer hide-header :id="'modal-photo-' + photo.photoID" class="photo-detail">
                <PhotoDetail  :photoComments="photo.photoComments" :photoID="photo.photoID" :photoPath="photo.photoPath" :photoLike="photo.photoLike"  />
              </b-modal>
            </div>
        </div>
      </div>
      <div class="empty-block" v-if="userPhotos.length === 0">
        No photos
      </div>
  </div>
</template>

<script>

import axios from 'axios'

import PhotoDetail from '@/components/modules/PhotoDetail'

export default {
  name: 'PhotoList',
  components: {
    PhotoDetail
  },
  data () {
    return {
      userPhotos: ''
    }
  },
  mounted () {
    axios
      .get('/get-user-photos' + this.$route.params.id)
      .then(response => (this.userPhotos = response.data))
  }
}
</script>

<style>
  .modal-body{
    padding: 0;
  }
  .modal-dialog{
    max-width: 700px;
  }
  .photos{
    padding: 20px;
    margin: 20px 0;
  }
  .photo-container{
     cursor: pointer;
    position: relative;
    border-radius: 10px;
    margin: 30px 30px 30px 0;
  }
  .photo-container:before{
    content: " ";
    position: absolute;
    display: none;
    height: 100%;
    width: 100%;
    top: 0;
    background-color: #000;
    opacity: 0.5;
    border-radius: 15px;
  }
  .photo-container:hover::before{
    display: block;
  }
  .photo-container:hover .photo-hover{
    display: flex;
  }
  .photo-hover{
    display: none;
    position: absolute;
    top: 40%;
    height: 20%;
    width: 60%;
    left: 50%;
    transform: translate(-50%, 0);
  }
  .photo-hover svg{
    height: 100%;
    width: 100%;
    fill: white;
    padding-top: 10px;
  }
  .photo-hover-item{
    display: flex;
    justify-content: center;
    align-items: flex-end;
  }
  .photo-hover-item-count{
    color: #fff;
    font-size: 22px;
    padding: 0 3px;
  }
  .photo img{
    height: 240px;
    width: 100%;
    border-radius: 15px;
    border: 2px solid #3c3c3c;
  }
  .modal-photo .modal-dialog {
    max-width: 670px;
  }
  .photo-container:focus {
    outline: none !important;
  }
  .photo-detail .modal-dialog {
    max-width: 70% !important;
  }
  @media (max-width: 450px) {
    .photos{
      margin: 0;
    }
    .photo-container{
      padding: 0 25px;
    }
  }
</style>
