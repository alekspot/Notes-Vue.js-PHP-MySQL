<template>
    <div class="tabs">
        <ul class="tabs__navigation">
           <li class="tabs__navigationItem ripple" ref="tabItem" v-for="(category, index) in categories" :key="category" @click="chooseList(index)">{{category}}</li>
           <li class="tabs__navigationItem tabs__line" :style="setWidthLine"></li>
        </ul>
         <!-- <div ref="slide" class="tabs__window" :style="setWidthSlide">
            <List v-for="(list,index) in posts" 
                :postList="list" 
                class="tabs__item"
                :key="index">
            </List>
         </div> -->


         <div ref="slide" class="tabs__window">
            <transition name="slide" mode="out-in"
            v-on:before-enter="resizeTabs"

            v-on:after-enter="resizeTabs"
            v-on:enter-cancelled="resizeTabs"

            v-on:before-leave="resizeTabs"
            v-on:leave="resizeTabs"
            v-on:after-leave="resizeTabs"
            v-on:leave-cancelled="resizeTabs">   
                <List 
                :postList="posts[currentTab]" 
                class="tabs__item"
                :key="currentTab">
                </List>
            </transition> 
         </div>
    </div>
</template>
<script>
import List from './List.vue'
import { setTimeout } from 'timers';
export default {
    name:'Tabs',
    props:['posts'],
    components:{
        List
    },
    data(){
        return {
           categories:['Заметки','Код','Книги'],
           test:'',
           line:{
              width:0,
              left:0
           },
           slide:{
              width:0,
              left:0
           },
           currentTab:0
        }
    },
    methods:{
        resizeTabs(){
           // this.line.width = this.$refs.tabItem[0].offsetWidth;
            this.line.width = this.$refs.tabItem[0].clientWidth;
            //сдесь нужно будет добавть индекс массива 
            this.updateLeft(this.line);
        },
        chooseList(n){
            this.currentTab = n;  
            this.setLeft(this.line,n);
            this.$store.dispatch('changeTable', n);
            this.resizeTabs();
        },
        setLeft(elem, n){
            elem.left = elem.width * n 
        },
        updateLeft(elem){
            elem.left = this.currentTab * elem.width;
        }   
    },
    computed:{
        setWidthLine(){
            return { width : this.line.width + 'px', left:this.line.left + 'px'}
        }
    },
    mounted(){
        //this.line.width = this.$refs.tabItem[0].offsetWidth;
        this.line.width = this.$refs.tabItem[0].clientWidth;
        //сдесь нужно будет добавть индекс массива 
        this.slide.width = this.$refs.slide.offsetWidth;
        window.addEventListener('resize',()=>{
             this.resizeTabs();
        })
    }
}
</script>
<style lang="less">
.slide-enter-active, .slide-leave-active {
  transition: all 0.6s;
}
.slide-enter, .slide-leave-to /* .list-leave-active до версии 2.1.8 */ {
  opacity: 0;
  transform: translateX(-100%);
}





    .tabs {
        //overflow: hidden;
        position: relative;
    }
    .tabs__navigation {
        display: flex;
        list-style: none;
        padding: 0;
        margin:0;
        position: fixed;
        width: 100%;
        z-index: 100;
    }
    .tabs__navigationItem {
        flex:1;
        text-align: center;
        padding: 10px 20px;
        cursor: pointer;
    }  
    .tabs__line {
        position: absolute;
        background:red;
        padding: 0;
        height: 2px;
        transition: 0.5s;
        bottom: 0;
    }
    .tabs__window {
        position: relative;
        display:flex;
        margin-top:40px;
        left:0;
        transition: left 0.5s;  
    }
    .tabs__item {  
        flex: 0 0 100%;
        
    }
</style>