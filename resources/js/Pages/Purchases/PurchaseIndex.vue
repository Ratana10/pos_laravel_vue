<template>
   <div>
=      <div class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1 class="m-0">Purchases</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                     <li class="breadcrumb-item active">Purchases</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="content">
         <div class="container-fluid">
            <div class="d-flex justify-content-between">
               <div>
                  <router-link to="/admin/purchases/create" type="button" class="btn btn-primary mb-2">
                     <i class="fa fa-plus"></i>
                     Add New Purchase
                  </router-link>
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
                          <label for="">Showing: </label>
                          <select v-model="perpage" class="ml-2">
                             <option v-for="(page, index) in pages" :key="index" :value="page.value">{{ page.label }}
                             </option>
                          </select>
                       </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <purchase-table :purchases="purchases" @edit="handleEdit" @delete="deletePurchase" />
                     </div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="dataTables_info" role="status" aria-live="polite">
                       Showing {{ (purchases.current_page - 1) * purchases.per_page + 1 }}
                       - {{ Math.min(purchases.current_page * purchases.per_page, purchases.total) }}
                       of {{ purchases.total }}
                    </div>
                    <div class="">
                       <Bootstrap4Pagination :data="purchases" @pagination-change-page="onPageChange" />
                    </div>
                 </div>

               </div>
            </div>
         </div>
      </div>

   </div>
</template>
 
<script setup>
import { onMounted } from 'vue';
import PurchaseTable from './PurchaseTable.vue';
import {Bootstrap4Pagination} from 'laravel-vue-pagination';
import usePurchases from '../../Composables/purchases';
import usePagination from '../../pagination';


const {purchases, getPurchases, destroyPurchase} = usePurchases();
const { perpage, pages, onPageChange } = usePagination(getPurchases);

onMounted(()=>{
   getPurchases(); 
})

const deletePurchase = async (id) =>{
   await destroyPurchase(id)
   await getPurchases();
}

</script>
 
<style scoped>
/* Add your component's styles here */
</style>
 