<template>
  <div class="user-page">
      <UserHeader />
      <div class="row">
         <div  class="col-lg-3 col-md-3 col-sm-3">
           <UserInfo />
         </div>
        <div  class="col-lg-9 col-md-9 col-sm-9">
          <PhotoList />
        </div>
    </div>
  </div>
</template>
<script>

import PhotoList from '@/components/modules/PhotoList'
import UserInfo from '@/components/modules/UserInfo'
import UserHeader from '@/components/modules/UserHeader'

export default {
  name: 'UserPage',
  components: {
    UserHeader,
    UserInfo,
    PhotoList
  }
}
</script>

