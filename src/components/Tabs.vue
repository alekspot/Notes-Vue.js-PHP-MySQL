<template>
    <div class="content">
        <ul class="content__navigation">
           <li class="content__navigationItem ripple" ref="tabItem" v-for="(category, index) in categories" :key="category" @click="chooseList(index)">{{category}}</li>
           <li class="content__line" :style="setWidthLine"></li>
        </ul>

         <div ref="slide" class="content__slider">
            <transition name="slide" mode="out-in"  v-on:enter="afterEnter">   
                <List :postList="posts[currentTab]" class="content__item" :key="currentTab"></List>
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
           categories:['Раздел 1','Раздел 2','Раздел 3'],
           test:'',
           line:{
              width:0,
              left:0
           },
           currentTab:0
        }
    },
    methods:{
        afterEnter(){
            setTimeout(this.resizeTabs,20)
            
        },
        resizeTabs(){
            this.line.width = this.$refs.tabItem[0].clientWidth;
            this.updateLeft(this.line);
        },
        chooseList(n){
            this.currentTab = n;  
            this.setLeft(this.line,n);
            this.$store.dispatch('changeTable', n);
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
        this.line.width = this.$refs.tabItem[0].clientWidth;
        window.addEventListener('resize',()=>{
             this.resizeTabs();
        })   
    },
    updated(){
        this.resizeTabs();
    }
}
</script>
<style lang="less">

.content {
    position: relative;

        &__navigation {
            display: flex;
            list-style: none;
            padding: 0;
            margin:0;
            position: fixed;
            width: 100%;
            z-index: 200;
            background:#fff;
            top:65px;
        }
        &__navigationItem {
            flex:1;
            text-align: center;
            padding: 10px 20px;
            cursor: pointer;
        }  
        &__line {
            position: absolute;
            background:rgb(7, 177, 245);
            padding: 0;
            height: 2px;
            transition: left 0.4s;
            bottom: 0;
        }
        &__slider {  
            display:flex;
            margin:103px 0 40px;    
        }
        &__item {  
            flex: 0 0 100%;
        }
}
    
.slide-enter-active, .slide-leave-active {
  transition: all 0.4s;
}
.slide-enter, .slide-leave-to {
  opacity: 0;
  transform: translateX(-100%);
}
</style>