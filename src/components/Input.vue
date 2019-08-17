<template>
<div class="input">
    <div v-for="(file,index) in files" :key="index">{{file.name}}</div>
    <div class="input__wrap">
        <form class="input__form" ref="form" id="uploadForm" method="POST" enctype="multipart/form-data">
            <textarea class="input__input" v-model="text"  type="text" placeholder="Добавить запись"></textarea>
            <label   class="input__label" for="file"><i class="material-icons">attach_file</i></label>
            <input class="input__inputFile" @change="previewFiles"  ref="inputFiles" type="file" name="pictures[]" id="file" multiple accept=".jpg, .jpeg, .png">
            <button class="input__clear ripple" @click.prevent="clearInput" ><i class="material-icons">close</i></button>
        </form>    
        <button class="input__btn" @click="addPost" >Добавить</button>
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
    .input {
       position: fixed;
        padding: 0 33px 10px 5px;
        bottom:0;
        width: 98.4%;
        background:#fff;
    
        &__wrap {
            display: flex;
        }
        &__form {
            position: relative;
            display: flex;
            flex:1;
        }
        &__input {
            padding: 10px 30px 0 30px;
            font-size: 18px;
            resize: none;
            border-radius: 5px 0 0 5px; 
            overflow: hidden;
            height: 30px;
            outline: none;
            flex:1;
            width: 100px;
        }
        &__input:focus {
            border:solid 1px rgb(7, 177, 245);
        }
        &__label {
            position: absolute;
            top:10px;
            color:gray;
            left: 5px;
        }
        &__inputFile{
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }
        &__clear {
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
        &__btn {
            margin-left: -1px;
            border-radius: 0 5px 5px 0;
            border: none;
            outline: none; 
            padding: 0 15px; 
            font-size: 16px;
            color:#fff;
            cursor: pointer;
            background: rgb(7, 177, 245);
        }
       
    }
</style>
