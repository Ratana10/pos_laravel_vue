<template>
<div>
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Sales</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                  <li class="breadcrumb-item active">Sales</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   <div class="content">
      <div class="container-fluid">
         <div class="d-flex justify-content-between">
            <div>
               <button @click="handleAdd" type="button" class="btn btn-primary mb-2">
                  <i class="fa fa-plus"></i>
                  Add New payments
               </button>
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
                           <option v-for="page in pages" :key="page.name" :value="page.value">{{ page.name}}</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <sale-table :sales="sales" @edit="handleEdit" @delete="handleDelete" @show="showModalAddPayment" />
                  </div>
               </div>
               <div class="d-flex justify-content-between">
                  <div class="dataTables_info" role="status" aria-live="polite">
                     Showing {{ (sales.current_page - 1) * sales.per_page + 1 }}
                     - {{ Math.min(sales.current_page * sales.per_page, sales.total) }}
                     of {{ sales.total }}
                  </div>
                  <div class="">
                     <Bootstrap4Pagination :data="sales" @pagination-change-page="getSales" />
                  </div>
               </div>

            </div>
         </div>
      </div>
   </div>

   <modal-add-payment :editing="editing" />
   <invoice />

</div>
</template>

<script>
import SaleTable from './SaleTable.vue';
import ModalAddPayment from '../Payments/ModalAddPayment.vue'
import Invoice from './InvoiceModal.vue'
import {
   Bootstrap4Pagination
} from 'laravel-vue-pagination';

export default {
   components: {
      SaleTable,
      Bootstrap4Pagination,
      ModalAddPayment,
      Invoice,
   },
   mounted() {
      this.getSales();
   },

   data() {
      return {
         sales: [],
         editing: null,
         perPage: 10,
         pages: [{
               name: '10',
               value: 10,
            },
            {
               name: '25',
               value: 25,
            },
            {
               name: '50',
               value: 50,
            },
            {
               name: '100',
               value: 100,
            },
         ]
      }
   },
   methods: {
      handleAdd() {
         $('#invoice-modal').modal('show');
      },
      showModalAddPayment(sale) {
         this.editing = sale;
         $('#modal-add-payment').modal('show')
      },
      getSales(page = 1) {
         axios
            .get(`/api/v1/sales?page=${page}&perPage=${this.perPage}`)
            .then(res => {
               this.sales = res.data.data;
               console.log(this.sales)
            })
            .catch(err => {
               showToast('error', err)
            })
      }
   }
}
</script>

<style scoped>
</style>
