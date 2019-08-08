<template>
    <div class="app">
        <Tabs :posts="posts"></Tabs>
        <AppInput></AppInput>
        
    </div>  
</template>
<script>
import Tabs from './Tabs.vue'
import AppInput from './Input.vue'

export default {
    components:{
        Tabs,
        AppInput
    },
    data(){
        return {
            posts:[
                [
                    {date:'08.08.2019',post:'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur laboriosam iure perferendis rem eius modi, aliquam cum nesciunt dolores dolor labore vitae totam repellendus, doloribus assumenda consequuntur eos laudantium explicabo.'},
                    {date:'08.08.2019',post:'Запись2'},
                    {date:'08.08.2019',post:'Запись3'},
                    {date:'08.08.2019',post:'Запись4'}
                ],
                [
                    {date:'08.08.2019',post:'Код1'},
                    {date:'08.08.2019',post:'Код2'},
                    {date:'08.08.2019',post:'Код3'},
                    {date:'08.08.2019',post:'Код4'}
                ],
                [
                    {date:'08.08.2019',post:'Книга1'},
                    {date:'08.08.2019',post:'Книга2'},
                    {date:'08.08.2019',post:'Книга3'},
                    {date:'08.08.2019',post:'Книга4'},
                    
                ]
            ]
        }
    }
}
</script>
<style lang="less">
  .app{
      box-sizing: border-box;
      font-family: Arial;
  }
</style>
