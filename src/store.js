import Vue from "vue";
import Vuex from 'vuex';
Vue.use(Vuex);
import axios from 'axios';
export const store = new Vuex.Store({
    state:{
        tables:['notes','code','books'],
        currentTable:'notes'
    },
    mutations:{
        'CHANGE_TABLE' (state,payload){
            state.currentTable = state.tables[payload]
        }
    },
    actions:{
        changeTable({commit},payload){
            commit('CHANGE_TABLE',payload)
        }
    },
    getters:{
        currentTable:state => state.currentTable
    }
})