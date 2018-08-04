<template>
  <div></div>
</template>
<script type="text/javascript">
import { mapState, mapActions } from 'vuex'
export default {
  data () {
    return {
      name: ''
    }
  },
  computed: {
    // 映射State
    ...mapState([
      'token'
    ])
  },
  mounted () {
    // 监听滚动条
    window.addEventListener('scroll', this.increment)
  },
  methods: {
    // 映射Actions中的handlerScroll方法
    ...mapActions([
      'increment'
    ])
  }
}
</script>
<style lang="scss">
</style>
