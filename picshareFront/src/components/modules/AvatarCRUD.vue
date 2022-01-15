<template>
  <div class="avatar-box">
    <div class="avatar-setting-title title-middle">Avatar settings</div>
    <div class="avatar-setting-body">
      <div class="avatar-modal-upload avatar-setting-button">
        <form enctype="multipart/form-data">
          <input type="file" id="avatar-refresh" ref="avatar-refresh" name="image-avatar-refresh" class="input-avatar-refresh" v-on:change="onChange">
          <label for="avatar-refresh" class="avatar-modal-button input-avatar-refresh-label">
            <div class="button">Refresh avatar</div>
          </label>
        </form>
      </div>
      <div class="avatar-modal-delete avatar-setting-button">
        <div class="button" @click="deleteAvatar">Delete avatar</div>
      </div>
    </div>
  </div>
</template>

<script>

import axios from 'axios'

export default {
  name: 'AvatarCRUD',
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
      data.append('image-avatar-refresh', this.file);

      let userID = this.$store.state.userID;
      data.append('userID', userID);

      axios
          .post('/refresh-avatar', data, config)
      },

    deleteAvatar () {
      axios
        .delete('/delete-avatar' + this.$store.state.userID)
    }
  }
}
</script>

<style>
  .avatar-setting-body{
    padding: 20px 0;
  }
  .avatar-setting-button{
    padding: 10px 0;
  }
  .avatar-modal-upload{
    display: flex;
    justify-content: center;
  }
  .avatar-modal-delete{
    display: flex;
    justify-content: center;
  }
  .input-avatar-refresh{
    display: none;
  }
  .input-avatar-refresh-label{
    cursor: pointer;
  }
</style>
