<template>
<div class="register-box">
      <div class="card card-outline card-primary">
         <div class="text-center card-header">
            <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
         </div>
         <div class="card-body">
            <p class="login-box-msg">Register a new membership</p>
            <form @submit.prevent="register" >
               <div class="mb-3 input-group">
                  <input type="text" class="form-control" placeholder="Full name">
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-user"></span>
                     </div>
                  </div>
               </div>
               <div class="mb-3 input-group">
                  <input type="email" class="form-control" placeholder="Email">
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                     </div>
                  </div>
               </div>
               <div class="mb-3 input-group">
                  <input type="password" class="form-control" placeholder="Password">
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                     </div>
                  </div>
               </div>
               <div class="mb-3 input-group">
                  <input type="password" class="form-control" placeholder="Retype password">
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-8">
                     <div class="icheck-primary">
                        <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                        <label for="agreeTerms">
                           I agree to the <a href="#">terms</a>
                        </label>
                     </div>
                  </div>

                  <div class="col-4">
                     <button type="submit" class="btn btn-primary btn-block">Register</button>
                  </div>

               </div>
            </form>
            <div class="text-center social-auth-links">
               <a href="#" class="btn btn-block btn-primary">
                  <i class="mr-2 fab fa-facebook"></i>
                  Sign up using Facebook
               </a>
               <a href="#" class="btn btn-block btn-danger">
                  <i class="mr-2 fab fa-google-plus"></i>
                  Sign up using Google+
               </a>
            </div>
            <a href="login.html" class="text-center">I already have a membership</a>
         </div>

      </div>
   </div>
</template>

<script setup>
import axios from 'axios';
import { reactive } from 'vue';

const form = reactive({
   name: null,
   email: null,
   password: null,
})

const register = ()=>{
   axios.post('/register', form)
   .then((res)=>{
      console.log(res);
   })
   .catch((err)=>{
      console.log('err', err);
   })
}
</script>

<style lang="">
   
</style>
