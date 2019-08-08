<template>
    <ul class="list">
        <li   v-for="(post,index) in postList" class="list__item" :key="index">
            <div class="list__post">
                <h3>{{post.dt}}</h3>
                <p v-html="post.text"></p>   
            </div>
            <div class="list__actions">
                <button @click="deletePost(post.id)" class="list__actions_delete ripple"><i class="material-icons">delete</i></button>
                 
            </div>           
           
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
        deletePost(id){
            this.$store.dispatch('deletePost', id);
        }
    }
}
</script>
<style lang="less">
    .list {
        padding: 0;
        margin:0;
        list-style:none
    }
    .list__item{
        display:flex;
        align-items: center;
        min-height: 80px;
    }
    .list__post {
        flex:1
    }
    .list__actions {
        margin-right: 30px
    }
    .list__actions_delete{
        background: none;
        border: none;
        border-radius: 50px 50px;
        align-self: center;
        width: 30px;
        height: 30px;
        padding: 3px 1px 0 0;
        outline:none;
        color: gray;
        cursor: pointer;
    }
</style>