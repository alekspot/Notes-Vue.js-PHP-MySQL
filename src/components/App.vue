<template>
    <div class="app">
        <h1 class="red">Hellow World</h1>
        <BlogInput></BlogInput>
    </div>  
</template>
<script>
import BlogInput from './BlogInput.vue'

export default {
    components:{
        BlogInput
    }
}
</script>
<style lang="less">
  .app{
      box-sizing: border-box
  }
</style>
