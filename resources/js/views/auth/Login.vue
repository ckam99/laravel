<template>
  <div class="layer center">
    
    <form class="row bg-white p-10" @submit.prevent="submit">
      <h1 class="mt-2 mb-3">Sign in</h1>
      <errors :error="error" v-if="error"/>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" v-model="email" id="email" placeholder="Enter your email">
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="text" class="form-control" v-model="password" id="password" placeholder="Enter your password">
      </div>

      <div class="col-12 mb-4">
        <button type="submit" class="btn btn-primary">Sign in</button>
      </div>

    </form>
  </div>
</template>

<script>
import {useRouter, useRoute} from 'vue-router'
import {ref} from 'vue'
import Errors from '../../components/Errors.vue'

export default {
  components: { Errors },
  setup(){
    const router = useRouter()
    const route = useRoute()
    const email = ref('')
    const password = ref()
    const error = ref()

    const submit = () => {
      const payload  = {
        email: email.value, 
        password: password.value,
        device_name: navigator.appName
      }
      axios.post('/api/sign-in', payload).then((response => {
        console.log(response);
        localStorage.setItem('token', response.data.access_token)
         if(route.query.redirect){
            router.push({
              path: route.query.redirect
            })
          }
          router.push({
              path: '/'
          })
      })).catch(e => {
         console.error( e.response.data);
         error.value = e.response
      })
     
      
    }

    return {
      submit,
      email,
      password,
      error
    }
  }
}
</script>

<style>

</style>