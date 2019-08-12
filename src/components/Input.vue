<template>
<div class="app__input">
    <div v-for="(file,index) in files" :key="index">{{file.name}}</div>
    <div class="input">
        <form ref="form" class="input__wrap" id="uploadForm" method="POST" enctype="multipart/form-data">
            <textarea @keyup.enter='addPost' v-model="text" class="input__input" type="text"></textarea>
            <label   class="input__label" for="file"><i class="material-icons">attach_file</i></label>
            <input @change="previewFiles" class="input__inputFile" ref="inputFiles" type="file" name="pictures[]" id="file" multiple accept=".jpg, .jpeg, .png">
            <button @click.prevent="clearInput" class="input__clear ripple"><i class="material-icons">close</i></button>
        </form>    
        <button @click="addPost" class="input__btn ripple">Добавить</button>
    </div>
</div>
    
</template>
<script>
export default {
    name:'Appinput',
    data(){
        return {
            text:'',
            files:[]
        }
    },
    methods:{
        clearInput(){
            this.text='';
            this.$refs.form.reset();
            this.files = [];
        },
        addPost(){
            let postData = new FormData(this.$refs.form);
            let data = {
                text:this.text,
                haveFiles:this.haveFiles,
                postData  
            }
            this.$store.dispatch('addPost', data);
            this.clearInput();
        },
        previewFiles() {
            this.files = this.$refs.inputFiles.files;
        },
    },
    computed:{
        haveFiles(){
            return this.files.length!=0 ? true : false
        }
    }
}
</script>
<style lang="less">
    .app__input {
       position: fixed;
        padding: 0 33px 10px 5px;
        bottom:0;
        width: 98.4%;
        background:#fff;
    }
   .input {
       display: flex;
   }
   .input__wrap {
       position: relative;
       display: flex;
       flex:1;
   }
   .input__input {
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
   .input__input:focus {
       border:solid 1px rgb(7, 177, 245);
   }
   .input__label {
       position: absolute;
       top:10px;
       color:gray;
       left: 5px;
   }
   .input__inputFile{
       width: 0.1px;
       height: 0.1px;
       opacity: 0;
       overflow: hidden;
       position: absolute;
       z-index: -1;
   }
   .input__clear {
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
        padding: 3px 1px 0 0;
        outline:none;
        color: gray;
   }
   .input__btn {
       margin-left: -1px;
       border-radius: 0 5px 5px 0;
       border: none;
       outline: none; 
       padding: 0 15px; 
       font-size: 16px;
       background: gray;
       color:#fff;
       cursor: pointer;
   }
   .input__btn:hover {
       background:rgb(7, 177, 245) !important;
   }
</style>
