<template>
    <div class="search">
        <div class="search__icon">
            <i class="material-icons">search</i>
        </div>                    
        
        <input v-model="searchText" class="search__input" type="text">
    </div>
</template>
<script>


export default {
   name:'Search',
    data(){
        return {
            searchText:'',
            posts:[],
        }
    },
    methods:{
       
    },
    computed:{
        search(){
            let query = this.searchText;
            
           
            
            
        }
    },
    created(){
       
    }
}
</script>
<style lang="less">
    .search {
        position: relative;
       
    }
    .search__input {
        padding: 5px 36px;
       font-size: 18px;
       resize: none;
       border-radius: 5px; 
       overflow: hidden;
       height: 30px;
       outline: none;
      
    }
    .search__icon {
        position: absolute;
        top:10px;
        left:10px;
    }
</style>