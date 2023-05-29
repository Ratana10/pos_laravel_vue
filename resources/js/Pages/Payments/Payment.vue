<template>
   <div>
      <div class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1 class="m-0">Peyments</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                     <li class="breadcrumb-item active">Peyments</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="content">
         <div class="container-fluid">
            <div class="d-flex justify-content-between">
               <div>

               </div>
               <div>
                  <div class="input-group">
                     <input type="text" class="form-control" placeholder="Search payments" aria-label="Search Supplier">
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="card-body">
                  <div class="row">
                     <div class="col-sm-12">
                        <div>
                           <label for="">Pages: </label>
                           <select v-model="perPage" class="ml-2">
                              <option v-for="(page, index) in pages" :key="index" :value="page.value">{{ page.label }}
                              </option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <payment-table :payments="payments" @edit="handleEdit" @delete="handleDelete" />
                     </div>
                  </div>
                  <div class="d-flex justify-content-between">
                     <div class="dataTables_info" role="status" aria-live="polite">
                        Showing {{ (payments.current_page - 1) * payments.per_page + 1 }}
                        - {{ Math.min(payments.current_page * payments.per_page, payments.total) }}
                        of {{ payments.total }}
                     </div>
                     <div class="">
                        <Bootstrap4Pagination :data="payments" @pagination-change-page="onPageChange" />
                     </div>
                  </div>

               </div>
            </div>
         </div>
      </div>

   </div>
</template>

<script setup>
import {
   ref,
   onMounted,
   watch
} from 'vue'
import { Bootstrap4Pagination } from 'laravel-vue-pagination';

import PaymentTable from './PaymentTable.vue';
import UsePayments from '../../Composables/payments';

const { payments, getPayments } = UsePayments();

onMounted(()=>{
   getPayments(perPage.value);
});

const perPage = ref(10);
const pages = ref([
   { label: '5', value: 5 },
   { label: '10', value: 10 },
   { label: '25', value: 25 },
   { label: '50', value: 50 },
   { label: '100', value: 100 },
]);

const onPageChange = (newPage) => {
  getPayments(perPage.value, newPage);
};

watch(
   perPage, 
   (newValue) => {
      console.log('perpage',perPage.value)
      getPayments(perPage.value);
   },
)


</script>

<style lang="">
   
</style>
