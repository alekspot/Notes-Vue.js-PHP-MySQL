<template>
    <ul class="list">
        <li   v-for="(post,index) in postList" class="list__item" :key="index">
            <div class="list__post">
                <h3>{{post.dt|dateFormat}}</h3>
                <img class="list__img" v-for="img in imgFilter(post.img)" :key="img"  :src="'../uploads/' + img" alt="">
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
                "Января", "Февраля", "Марта",
                "Апреля", "Мая", "Июня", "Июля",
                "Августа", "Сентября", "Октября",
                "Ноября", "Декабря"
            ];
            let monthId; 
                      
            let arr = date.split('-');
           // return arr[1][0];
            if(arr[1][0]=='0'){
                monthId = +arr[1][1]
            } else monthId = + arr[1];

            let day;
            if(arr[2][0]=='0'){
                day = +arr[2][1];
            } else day = + arr[2];
            
            let month = monthNames[monthId-1];
            let year = arr[0];
            
           return `${day}  ${month}  ${year}`;
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
        flex:1;
    }
    .list__img {
        max-width: 200px;
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