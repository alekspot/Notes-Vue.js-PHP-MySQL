<template>
    <ul class="notes">
        <li @dblclick="showAction = !showAction" v-for="(post,index) in postList" class="notes__item" :key="index">
            <div class="notes__post">
                <p class="notes__date">{{post.dt|dateFormat}}</p>
                <img class="notes__img" v-for="img in imgFilter(post.img)" :key="img"  :src="'../uploads/' + img" alt="">
                <p class="notes__text" v-html="post.text" v-linkified:options="{ className: 'notes__link' }"></p>  
            </div>
            <div v-if="showAction" class="notes__actions noselect">
                <button @click="deletePost(post.id)" class="notes__actions_delete ripple"><i class="material-icons">delete</i></button>
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

        &__img {
            max-width: 200px;
        }

        &__link {
            word-break: break-all;
        }
        &__actions {
            margin:0 15px
        }
        &__actions_delete{
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

        &__date {
            font-size: 12px;
            font-weight: bold
        }
    }
  
</style>