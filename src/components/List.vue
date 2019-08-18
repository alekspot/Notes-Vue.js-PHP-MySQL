<template>
    <ul class="notes">
        <Post v-for="(post,index) in postList" :post="post" :index="index" :key="index"></Post>
    </ul>
</template>
<script>
import Post from './Post.vue'
export default {
   name:'List',
   components:{
    Post
   },
   props:['postList']
}
</script>
<style lang="less">
</style>