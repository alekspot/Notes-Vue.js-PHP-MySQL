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
   props:['postList'],
    data(){
        return {
           showAction : false
        }
    },
    methods:{
        deletePost(id){
            this.$store.dispatch('deletePost', id);
        },
        imgFilter:function (imgStr) {
            if(!imgStr) return false
            else return imgStr.split(':');    
        }
    },
    filters:{
        dateFormat:function(dt){
            let date = dt.substring(0,10);
            let time = dt.substring(11,16);
            var monthNames = [
                "января", "февраля", "марта",
                "апреля", "мая", "июня", "июля",
                "августа", "сентября", "октября",
                "ноября", "декабря"
            ];
            let monthId;                   
            let arr = date.split('-');
            if(arr[1][0]=='0'){
                monthId = +arr[1][1]
            } else monthId = + arr[1];

            let day;
            if(arr[2][0]=='0'){
                day = +arr[2][1];
            } else day = + arr[2];
            
            let month = monthNames[monthId-1];
            let year = arr[0];
            
           return `Добавлено ${day}  ${month}  ${year} в ${time}`;
        }    
    }
}
</script>
<style lang="less">
    .notes {
        padding: 0;
        margin:0;
        list-style:none;

        &__item{
            display:flex;
            align-items: center;
            min-height: 80px;
            padding:10px;
            justify-content: space-between;
        }
        &__post{
            display: flex;
            flex-direction: column;
            width:100%;
        }
        &__img {
            max-width: 200px;
        }

        &__link {
            word-break: break-all;
        }

        &__date {
            font-size: 12px;
            font-weight: bold
        }
        &__edit {
            align-self: stretch;
            resize: none;
            width: 100%;
            margin:16px 0;
            padding: 0;
        }
    }
  
</style>