<template>
<div class=" login-box">
   <div class="card card-outline card-primary">
      <div class="text-center card-header">
         <a href="" class="h1"><b>Admin</b>LTE</a>
      </div>
      <div class="card-body">
         <p class="login-box-msg">Sign in to start your session</p>
         <form @submit.prevent="submit">
            <div class="mb-3 input-group">
               <input v-model="form.email" type="email" class="form-control" placeholder="Email">
               <div class="input-group-append">
                  <div class="input-group-text">
                     <span class="fas fa-envelope"></span>
                  </div>
               </div>
            </div>
            <div class="mb-3 input-group">
               <input v-model="form.password" type="password" class="form-control" placeholder="Password">
               <div class="input-group-append">
                  <div class="input-group-text">
                     <span class="fas fa-lock"></span>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-8">
                  <div class="icheck-primary">
                     <input type="checkbox" id="remember">
                     <label for="remember">
                        Remember Me
                     </label>
                  </div>
               </div>

               <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Sign In</button>
               </div>

            </div>
         </form>
      </div>

   </div>

</div>
</template>

<script setup>
import axios from 'axios';
import { reactive } from 'vue';

const form = reactive({
   email: null,
   password: null,
})

const submit = () => {
   axios.post('/login', form)
   .then(() =>{
      window.location.href = "/admin/admin/dashboard";
   })
}
</script>

<style lang="">
   
</style>
