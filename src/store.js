import Vue from "vue";
import Vuex from 'vuex';
Vue.use(Vuex);

import api from '../api/notes';

import "regenerator-runtime/runtime";

export const store = new Vuex.Store({
    state:{
        //Названия таблиц в БД
        tables:['notes','code','books'],
        //текущая вкладка
        currentTab:'notes',
        //список постов получаемых с сервера
        postLists:[],
        searchText:null,
        editId:'',
        editText:'',
    },
    mutations:{
        'CHANGE_TABLE' (state,payload){
            state.currentTab = state.tables[payload]
        },
        'INIT_POST_LIST' (state, payload){
            state.postLists = payload
        },
        'SET_SEARCH' (state, payload){
            state.searchText = payload;
        },
        'CLEAR_SEARCH' (state){
            state.searchText = '';
        }
    },
    actions:{
        clearSearch({commit}){
            commit('CLEAR_SEARCH')
        },
        setSearch({commit},payload){
            commit('SET_SEARCH',payload)
        },
        changeTable({commit},payload){
            commit('CHANGE_TABLE',payload)
        },
        async initPostList({commit}){
            
            commit('INIT_POST_LIST', await api.getPosts());
        },
        async addPost({state},payload){
            if(payload.text!='' || payload.haveFiles){

                payload.postData.append('table', state.currentTab);
                payload.postData.append('msg', payload.text);
                // postData содержит в себе текст и картинки поста 
                await api.addPost(payload.postData);
                store.dispatch('initPostList');   
            }        
        },
        async changePost({state},payload){  
            await api.changePost(state.currentTab,payload.id,payload.text);
            store.dispatch('initPostList');
        },
        async deletePost({state},payload){
            await api.deletePost(state.currentTab, payload);
            store.dispatch('initPostList');  
        }
    },
    getters:{
        currentTab:state => state.currentTab,
        postLists:state => state.postLists,
        searchPost:function(state){
            let arr = [];
           for(let i = 0;i<state.postLists.length;i++){
            
            let find = state.postLists[i].filter((value)=>{
                if(state.searchText!==''){
                    return value.text.includes(state.searchText)
                } else return false
            })
            arr.push(find);   
           }
          return arr;
        } 
    }
})