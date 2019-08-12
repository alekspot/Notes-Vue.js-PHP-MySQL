<template>
<div class="search__wrap">
    <div class="search">
        <div class="search__icon">
            <i class="material-icons">search</i>
        </div>                       
        <input @input="updateMessage" v-model="searchText" class="search__input" type="text" placeholder="Найти запись">
        <button @click="clearSearch" class="search__clear ripple"><i class="material-icons">close</i></button>
    </div>
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
        updateMessage (e) {
            this.$store.dispatch('setSearch', e.target.value);
        },
        clearSearch(){
           this.$store.dispatch('clearSearch');
           this.searchText = ''
        }
    },
    computed:{
        
        
    },
    created(){
       
    }
}
</script>
<style lang="less">
.search__wrap{
    position:fixed;
    z-index: 101;
    background:#fff;
    padding: 10px 0;
    width: 100%;
}
    .search {
        position: relative;
       padding: 0 5px;
       
       display: flex;
    }
    .search__input {
        padding: 5px 36px;
       font-size: 18px;
       border-radius: 5px; 
       border:solid 1px gray;
       overflow: hidden;
       height: 30px;
       outline: none;
       flex:1;
    }
    .search__input:focus {
        border:solid 1px rgb(7, 177, 255);
    }
    .search__icon {
        position: absolute;
        top:10px;
        left:10px;
        color:gray;
    }
    .search__clear {
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
</style>