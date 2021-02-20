
<template>
    <component :is="layout">
      <router-view></router-view>
    </component>
</template>

<script>
import { defineComponent } from "vue";
export default defineComponent({
    computed: {
       layout(){
           return (this.$route.meta.layout || 'default') + '-layout'
       }  
    },
    mounted(){
        console.log('device', navigator.appName);
        console.log('verion',  navigator.appVersion);
        console.log('plateform', navigator.platform);
    }
})
</script>

<style>
*, *::before,*::after{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body{ background: #eee;}
.center{
    display:flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
}
.layer{
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}
.bg-white{
    background: #fff;
}
</style>