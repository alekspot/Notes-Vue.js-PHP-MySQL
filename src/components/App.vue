<template>
    <div class="app">
        <Tabs :posts="getPosts"></Tabs>
        <AppInput></AppInput>
        
    </div>  
</template>
<script>
import Tabs from './Tabs.vue'
import AppInput from './Input.vue'

export default {
    components:{
        Tabs,
        AppInput
    },
    data(){
        return {
        
        }
    },
    computed:{
         getPosts:function(){
            return this.$store.getters.postLists
        }
    }
}
</script>
<style lang="less">
  .app{
      box-sizing: border-box;
      font-family: Arial;
  }
</style>
