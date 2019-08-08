import Vue from 'vue';
import App from './components/App.vue'
import {store} from './store'

import './less/test.less'

window.addEventListener('load',()=>{
    new Vue({
        store,
        el:'#app',
        render: h=>h(App),
         
    })
})
