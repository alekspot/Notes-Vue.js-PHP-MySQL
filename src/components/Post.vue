<template>
    <li @dblclick="showAction = !showAction" class="notes__item">
        <div class="notes__post">
            <p class="notes__date">{{post.dt|dateFormat}}</p>
            <img class="notes__img" v-for="img in imgFilter(post.img)" :key="img"  :src="'../uploads/' + img" alt="">
            <p ref="post" v-if="!edit" class="notes__text" v-html="post.text" v-linkified:options="{ className: 'notes__link' }"></p>
            <textarea v-model="post.text" @input="changeEditText" @dblclick.stop="" v-else class="notes__edit" :style="editHeight"></textarea> 
        </div>
        

        <div v-if="showAction" class="actions noselect">
            <button class="action action__delete ripple" @click="deletePost(post.id)"><i class="material-icons">delete</i></button>
            <button class="action action__edit ripple" @click="changePost"><i class="material-icons">edit</i></button>
        </div> 
                         
    </li>
</template>
<script>


export default {
   props:['post','index'],
   name:'Post',
    data(){
        return {
           showAction : false,
           edit: false,
           postHeight:0,
           newText:'',
           haveChangeInput: false,
        }
    },
    methods:{
        deletePost(id){
            this.$store.dispatch('deletePost', id);
        },
        imgFilter:function (imgStr){
            if(!imgStr) return false
            else return imgStr.split(':');    
        },
        changePost:function(){
            if(!this.edit){
                this.edit = true;
                //this.$store.dispatch('changeEditId', this.post.id);
            } else if(this.edit && this.haveChangeInput){
                alert('Сохранено');
                this.$store.dispatch('changePost',{text:this.post.text, id:this.post.id});
                this.edit = false;
                this.haveChangeInput = false;
            } else {
                this.edit = false;
            }   
        },
        changeEditText(e){
            this.haveChangeInput = true;
            this.$store.dispatch('changeEditText', e.target.value);
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
    },
    computed:{
        editHeight(){
            return {height:this.postHeight + 'px'}
        }
    },
    mounted(){     
        this.postHeight = this.$refs.post.offsetHeight;
    },
}
</script>
<style lang="less">
.actions{
    display: flex;
}
 .action {
    margin:0 5px;
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

     &_delete{

     }

     &_edit{

     }
 }
</style>