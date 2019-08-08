<template>
    <div class="tabs">
        <ul class="tabs__navigation">
           <li class="tabs__navigationItem ripple" ref="tabItem" v-for="(category, index) in categories" :key="category" @click="chooseList(index)">{{category}}</li>
           <li class="tabs__navigationItem tabs__line" :style="setWidthLine"></li>
        </ul>
        <div ref="slide" class="tabs__window" :style="setWidthSlide">
            <List v-for="(list,index) in posts" 
                :postList="list" 
                class="tabs__item"
                :key="index">
            </List>
        </div> 
    </div>
</template>
<script>
import List from './List.vue'
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
           }
        }
    },
    methods:{
        resizeTabs(){
            this.line.width = this.$refs.tabItem[0].offsetWidth;
            //сдесь нужно будет добавть индекс массива 
            this.slide.width = this.$refs.slide.offsetWidth;
            this.updateLeft(this.line);
            this.updateLeft(this.slide);
        },
        chooseList(n){
            this.currentTab = n;  
            this.setLeft(this.line,n);
            this.setLeft(this.slide,n);
            
            
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
        },
        setWidthSlide(){
            return { left: - this.slide.left + 'px'}
        }
    },
    mounted(){
        this.line.width = this.$refs.tabItem[0].offsetWidth;
        //сдесь нужно будет добавть индекс массива 
        this.slide.width = this.$refs.slide.offsetWidth;
        window.addEventListener('resize',()=>{
             this.resizeTabs();
        })
    }
}
</script>
<style lang="less">
    .tabs {
        overflow: hidden;
    }
    .tabs__navigation {
        display: flex;
        list-style: none;
        padding: 0;
        margin:0;
    }
    .tabs__navigationItem {
        flex:1;
        text-align: center;
        padding: 10px 20px;
        cursor: pointer;
    }  
    .tabs__line {
        position: absolute;
        border-bottom:solid 4px rgb(7, 177, 245);
        padding: 0;
        padding-top: 37px;
        transition: 0.5s;
    }
    .tabs__window {
        position: relative;
        display:flex;
        left:0;
        transition: 0.5s;  
    }
    .tabs__item {  
        flex: 0 0 100%;
    }
</style>