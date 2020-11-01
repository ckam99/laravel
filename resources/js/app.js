//window.Vue = require('vue');
// Vue.component('tweet', require('./components/Tweet.vue').default);

import './bootstrap';
import 'ant-design-vue/dist/antd.css';
import Antd from 'ant-design-vue';
import Vue from 'vue'

import Tweet from './components/Tweet.vue';
import Upload from './components/Upload.vue';

Vue.use(Antd);

const app = new Vue({
    el: '#app',
    components:{
        Upload,
        Tweet
    }
});
