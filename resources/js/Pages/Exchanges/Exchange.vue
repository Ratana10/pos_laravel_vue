<template>
<div>
   <div class="content-header">
      <div class="container-fluid">
         <div class="mb-2 row">
            <div class="col-sm-6">
               <h1 class="m-0">Exchange</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                  <li class="breadcrumb-item active">Exchange</li>
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
                  Add New Exchange
               </button>
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
                     <ExchangeTable :exchanges="exchanges" @delete="deleteExchange" @edit="editExchange"/>
                  </div>
               </div>
               <div class="d-flex justify-content-between">
                     <div class="dataTables_info" role="status" aria-live="polite">
                        Showing {{ (exchanges.current_page - 1) * exchanges.per_page + 1 }}
                        - {{ Math.min(exchanges.current_page * exchanges.per_page, exchanges.total) }}
                        of {{ exchanges.total }}
                     </div>
                  <div class="">
                     <Bootstrap4Pagination :data="exchanges" @pagination-change-page="onPageChange" />
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <ModalAddExchange :editing="editing" @submit="getExchanges" />
</div>
</template>

<script setup>
import {Bootstrap4Pagination} from 'laravel-vue-pagination';
import usePagination from '../../pagination';
import ExchangeTable from './ExchangeTable.vue';
import ModalAddExchange from './ModalAddExchange.vue';
import { onMounted, ref } from 'vue';
import useExchanges from '../../Composables/exchanges';
import useNotifications from '../../notifications';

const {exchanges, getExchanges, destroyExchange} = useExchanges();

const {pages, perpage, onPageChange} = usePagination(getExchanges);

onMounted(()=> {getExchanges(); console.log('test',exchanges.value)});

const {confirmNotification} = useNotifications();

const deleteExchange = async (exchange) =>{
   await confirmNotification(exchange.khmer)
   .then((result) =>{
      if(result){
         destroyExchange(exchange.id)
         getExchanges();
      }
   });  
}

const editing = ref(null);

const editExchange = (exchange) =>{
   editing.value = exchange;
   $('#modal-add-exchange').modal('show');
}

const openModal = async ()=>{
   editing.value = null;
   await $('#modal-add-exchange').modal('show');
}
</script>

<style>
   
</style>
