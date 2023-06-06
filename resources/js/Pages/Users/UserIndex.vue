<template>
<div>
   <div class="content-header">
      <div class="container-fluid">
         <div class="mb-2 row">
            <div class="col-sm-6">
               <h1 class="m-0">Users</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                  <li class="breadcrumb-item active">Users</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   <div class="content">
      <div class="container-fluid">
         <div class="d-flex justify-content-between">
            <div>
               <button @click="openModal" type="button" class="mb-2 btn btn-primary">
                  <i class="fa fa-plus"></i>
                  Add New User
               </button>
            </div>
            <div>
               <div class="input-group">
                  <input v-model="search" type="text" class="form-control" placeholder="Search Customer">
                  <div class="input-group-prepend">
                     <span class="input-group-text">
                        <i class="fa fa-search"></i>
                     </span>
                  </div>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-body">
               <div class="row">
                  <div class="col-sm-12">
                     <div>
                        <label for="">Showing: </label>
                        <select v-model="perpage" class="ml-2">
                           <option v-for="(page, index) in pages"  :key="index" :value="page.value">{{ page.label }} </option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <UserTable :users="users" @delete="deleteUser" @edit="editUser"/>
                  </div>
               </div>
               <div class="d-flex justify-content-between">
                     <div class="dataTables_info" role="status" aria-live="polite">
                        Showing {{ (users.current_page - 1) * users.per_page + 1 }}
                        - {{ Math.min(users.current_page * users.per_page, users.total) }}
                        of {{ users.total }}
                     </div>
                  <div class="">
                     <Bootstrap4Pagination :data="users" @pagination-change-page="onPageChange" />
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <ModalAddUser :editing="editing" @submit="getUsers" />

</div>
</template>

<script setup>
import {Bootstrap4Pagination} from 'laravel-vue-pagination';
import usePagination from '../../pagination';
import UserTable from './UserTable.vue';
import ModalAddUser from './ModalAddUser.vue';
import { onMounted, ref } from 'vue';
import useUsers from '../../Composables/users';
import useNotifications from '../../notifications';

const {users, getUsers, destroyUser} = useUsers();

const {pages, perpage, onPageChange} = usePagination(getUsers);

const {confirmNotification} = useNotifications();
onMounted(()=> getUsers());

const deleteUser = async (user) =>{
   await confirmNotification(user.name)
   .then((result) =>{
      if(result){
         destroyUser(user.id)
         getUsers();
      }
   });  
}

const editing = ref(null);
const editUser = (user) =>{
   editing.value = user;
   $('#modal-add-user').modal('show');
      
}

const openModal = async ()=>{
   editing.value = null;
   await $('#modal-add-user').modal('show');
}



</script>

<style>
   
</style>
