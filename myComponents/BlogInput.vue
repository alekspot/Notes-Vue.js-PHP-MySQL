<template>
    <div class="blogInput">
        <div class="blogInput__wrap">
            <textarea v-model="text" class="blogInput__input" type="text"></textarea>
            <label class="blogInput__label" for="file"><i class="material-icons">attach_file</i></label>
            <input class="blogInput__inputFile" type="file" name="addFile" id="file">
            <button @click="clearInput" class="blogInput__clear ripple"><i class="material-icons">close</i></button>
        </div>    
        <button class="blogInput__btn ripple">Добавить</button>
    </div>
</template>
<script>
export default {
    name:'BlogInput',
    data(){
        return {
            text:''
        }
    },
    methods:{
        clearInput(){
            this.text=''
        }
    }
}
</script>
<style lang="less">
   .blogInput {
       display: flex;
   }
   .blogInput__wrap {
       position: relative;
       display: flex;
       flex:1;
   }
   .blogInput__input {
       padding-top: 10px;
       padding-left: 30px;
       font-size: 18px;
       resize: none;
       border-radius: 5px 0 0 5px; 
       overflow: hidden;
       height: 30px;
       outline: none;
       flex:1;
       width: 100px;
   }
   .blogInput__input:focus {
       border:solid 1px rgb(7, 177, 245);
   }
   .blogInput__label {
       position: absolute;
       top:10px;
       color:gray;
       left: 5px;
   }
   .blogInput__inputFile{
       width: 0.1px;
       height: 0.1px;
       opacity: 0;
       overflow: hidden;
       position: absolute;
       z-index: -1;
   }
   .blogInput__clear {
        position: absolute;
        right: 7px;
        top:7px;
        bottom:0;
        background: none;
        border: none;
        border-radius: 50px 50px;
        align-self: center;
        width: 30px;
        height: 30px;
        padding: 2px 0 0 0;
        outline:none;
        color: gray;
   }
   .blogInput__btn {
       margin-left: -1px;
       border-radius: 0 5px 5px 0;
       border: none;
       outline: none; 
       padding: 0 15px; 
       font-size: 16px;
   }
</style>
