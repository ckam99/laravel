<template>
    <div class="alert alert-warning" role="alert">
      <h4 class="alert-heading" v-if="message">{{ message }}</h4>
      <hr>
         <div v-for="(err,e) in validators" :key="e">
            <span class="col-sm-4">{{ err.field }}</span>
            <p v-for="(msg,m) in err.messages" :key="m" class="col-sm-8">
                {{ msg }}
            </p>
         </div>

    </div>
</template>

<script>
import { computed, defineComponent } from "vue";

export default defineComponent({
    props:{
        error: Object
    },
    setup(props){

        const message = computed(()=>{
            if(props.error.status == 422){
                return props.error.message
            }
            return props.error.data.error || null
        })

        const validators = computed(()=>{
            const err = []
            if(props.error.status == 422){
                const fields = Object.keys(props.error.data.errors);
                const messages = Object.values(props.error.data.errors);
                fields.forEach((el, i) => {
                    err.push({
                        field: el,
                        messages: messages[i]
                    })
                })
            }
            return err
        })

        return {
            message,
            validators
        }
    }
})
</script>

<style>

</style>