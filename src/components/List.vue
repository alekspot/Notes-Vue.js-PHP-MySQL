<template>
    <ul class="list">
        <li v-for="(post,index) in postList" class="list__item" :key="index"> 
            <h3>{{post.date}}</h3>
            <p>{{post.post}}</p>
        </li>
    </ul>
</template>
<script>
export default {
   name:'List',
   props:['postList'],
    data(){
        return {
           
        }
    },
    methods:{
        
    }
}
</script>
<style lang="less">
    .list {
        padding: 0;
        margin:0;
        list-style:none
    }
</style>