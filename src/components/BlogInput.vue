<template>
    <div class="blogInput">
        <textarea class="blogInput__input" type="text"></textarea>
        <button class="blogInput__btn">Добавить</button>
        <button class="addFile">dasd</button>
    </div>
</template>
<script>
export default {
    name:'BlogInput'
}
</script>
<style lang="less">
   .blogInput {
       display: flex;
   }
   .blogInput__wrap {
       position: relative;
   }
   .blogInput__input {
       padding-top: 10px;
       padding-left: 15px;
       font-size: 18px;
       resize: none;
       border-radius: 5px 0 0 5px; 
       overflow: hidden;
       height: 30px;   
   }
   .addFile {
       position: absolute;
   }
   .blogInput__btn {
       margin-left: -1px;
       border-radius: 0 5px 5px 0;
       border: none;
       outline: none;
      
   }
</style>
