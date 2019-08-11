<template>
    <div class="app">
        <Search></Search>
        <Tabs :posts="getPosts"></Tabs>
        <AppInput></AppInput>
        
    </div>  
</template>
<script>
import Tabs from './Tabs.vue'
import AppInput from './Input.vue'
import Search from './Search.vue'
export default {
    components:{
        Tabs,
        AppInput,
        Search
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
      height: 100vh;
      display: flex;
      flex-direction: column;
      //justify-content: space-between;
      position: relative;
     
  }
  .noselect{
      user-select: none;
  }
</style>
