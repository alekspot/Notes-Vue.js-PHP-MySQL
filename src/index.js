import Vue from 'vue';
import App from './components/App.vue'
import {store} from './store'

import './less/test.less'

import linkify from 'vue-linkify';
Vue.directive('linkified', linkify);

import VueTextareaAutosize from 'vue-textarea-autosize'
Vue.use(VueTextareaAutosize);

window.addEventListener('load',()=>{
    new Vue({
        store,
        el:'#app',
        render: h=>h(App),
        methods:{
            call(){
                store.dispatch('initPostList')
            }
        },
        mounted(){
            this.call();
        }    
    })
})
