import Vue from "vue";
import Vuex from 'vuex';
Vue.use(Vuex);
import axios from 'axios';
export const store = new Vuex.Store({
    state:{
        //Названия таблиц в БД
        tables:['notes','code','books'],
        //текущая вкладка
        currentTab:'notes',
        //список постов получаемых с сервера
        postLists:[]
    },
    mutations:{
        'CHANGE_TABLE' (state,payload){
            state.currentTab = state.tables[payload]
        },
        'INIT_POST_LIST' (state, payload){
            state.postLists = payload
        }
    },
    actions:{
        changeTable({commit},payload){
            commit('CHANGE_TABLE',payload)
        },
        initPostList({commit,state}){
           let counter = 0;
           let arr = [];
           const readTable = function(){
               if(counter < state.tables.length){
                
                axios.post('../ajax_quest.php', {
                    'table': state.tables[counter]
                })
                .then(function (response) {
                    arr.push(response.data);
                    counter++;
                    readTable();
                })
                .catch(function (error) {
                    console.log(error);
                });
               } else {
                commit('INIT_POST_LIST', arr);
               }  
           }
           readTable();
        },
        addPost({state},payload){
            if(payload.text!='' || payload.files.length!=0){
                let data = new FormData(document.getElementById('uploadForm'));
                
                data.append('file', payload.files);

                let table = state.currentTab;
                let msg = payload.text;
                
                data.append('table', table);
                data.append('msg', msg);
                axios.post('../ajax_add.php', data, {
                headers: {
                'Content-Type': 'multipart/form-data'
                }
                }).then(function (response) {
                       //this.files =[];
                        store.dispatch('initPostList');
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }        
        },
        deletePost({state},payload){
            let table = state.currentTab;
            let postId = payload;
            
            axios.post('../ajax_remove.php', {
                table: table,
                postId: postId
            })
            .then(function (response) {
                store.dispatch('initPostList');
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    },
    getters:{
        currentTab:state => state.currentTab,
        postLists:state => state.postLists
    }
})