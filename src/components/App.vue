<template>
    <div class="app">
        <Search></Search>
        <Tabs :posts="whatShow"></Tabs>
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
        allPosts:function(){
            return this.$store.getters.postLists
        },
        foundPosts(){
            return this.$store.getters.searchPost
        },
        whatShow(){
            for(let i = 0;i < this.foundPosts.length; i++){
                if(this.foundPosts[i].length>0){
                    return this.foundPosts;
                }
            }
            return this.allPosts
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
