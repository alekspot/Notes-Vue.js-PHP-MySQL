<template>
<div class="search">
    <div class="search__wrap">
        <div class="search__icon">
            <i class="material-icons">search</i>
        </div>                       
        <input class="search__input" @input="updateMessage" v-model="searchText"  type="text" placeholder="Найти запись">
        <button class="search__clear ripple" @click="clearSearch" ><i class="material-icons">close</i></button>
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
    }
}
</script>
<style lang="less">
.search{
    position:fixed;
    z-index: 101;
    background:#fff;
    padding: 10px 0 20px;
    width: 100%;

        &__wrap {
            position: relative;
            padding: 0 5px;
            display: flex;
        }
        &__input {
            padding: 5px 36px;
            font-size: 18px;
            border-radius: 5px; 
            border:solid 1px gray;
            overflow: hidden;
            height: 30px;
            outline: none;
            flex:1;
        }
        &__input:focus {
            border:solid 1px rgb(7, 177, 255);
        }
        &__icon {
            position: absolute;
            top:10px;
            left:10px;
            color:gray;
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
}
</style>