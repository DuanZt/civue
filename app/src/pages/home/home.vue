<template>
  <div class="home">
    <h1>home</h1>
  </div>
</template>

<script type="text/javascript">
import req from '@/lib/req'

export default {
  created () {
    req('get', 'user/view/2').then((data) => {
      console.log(data, 'xxxxx')
    }).catch((err) => {
      console.log(err, 'xxxxx')
    })
  }
}
</script>
<style lang="scss">
</style>
