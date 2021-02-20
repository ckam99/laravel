import {createApp} from 'vue'
import router from './router'
import App from './App'
import DefaultLayout from './layouts/Main'
import FrameLayout from './layouts/Frame'
import './modules/request'

createApp(App)
    .use(router)
    .component('default-layout', DefaultLayout)
    .component('blank-layout', FrameLayout)
    .mount('#app')