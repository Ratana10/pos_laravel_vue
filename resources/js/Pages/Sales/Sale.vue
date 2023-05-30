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
         <div class="d-flex justify-content-between mb-1">
            <div>

            </div>
            <div>
               <div class="btn-group mr-3">
                  <button :class="selectedStatus === null ? 'btn btn-secondary':'btn btn-info' " @click="getSales(perPage, 1)">
                     All
                  </button>
                  <div class="btn-group" v-for="(item, index) in saleStatuses" :key="index">
                     <button :class="selectedStatus === item.value ? 'btn btn-secondary':`btn btn-${item.color}` "   @click="getSales(perPage, 1, item.value)">
                        <span class="mr-2">{{ item.name }}</span>
                        <span class="badge badge-pill badge-info">{{ item.count }}</span>
                     </button>
                  </div>
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
                           <option v-for="page in pages" :key="page.name" :value="page.value">{{ page.label}}</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <sale-table 
                        :sales="sales" :actionOptions="actionOptions" 
                        @edit="handleEdit" @delete="handleDelete" @show="openModal" />
                  </div>
               </div>
               <div class="d-flex justify-content-between">
                  <div class="dataTables_info" role="status" aria-live="polite">
                     Showing {{ (sales.current_page - 1) * sales.per_page + 1 }}
                     - {{ Math.min(sales.current_page * sales.per_page, sales.total) }}
                     of {{ sales.total }}
                  </div>
                  <div class="">
                     <Bootstrap4Pagination :data="sales" @pagination-change-page="onPageChange" />
                  </div>
               </div>

            </div>
         </div>
      </div>
   </div>

   <modal-add-payment :editing="editing" />
</div>
</template>
<script setup>
import {
   ref,
   onMounted,
   watch
} from 'vue'
import { Bootstrap4Pagination } from 'laravel-vue-pagination';
import ModalAddPayment from '../Payments/ModalAddPayment.vue'
import SaleTable from './SaleTable.vue';
import UseSales from '../../Composables/sales';

const { sales, getSales, saleStatuses, getCountSaleStatuses } = UseSales();

onMounted(()=>{
   getSales(perPage.value);
   getCountSaleStatuses();
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
   getSales(perPage.value, newPage);
};

watch(perPage, (newValue) => {
      console.log('perpage',perPage.value)
      getSales(perPage.value);
   },
);

const actionOptions = ref([
   {label: 'Add Payment', value: 'add_payment', function: addPayment},
   {label: 'View Payment', value: 'view_payment', function: viewPayment},
])
const editing = ref(null);
function addPayment(sale){
   editing.value = sale
   console.log('editing', editing, sale);
   openModal();
}
function viewPayment(){
   alert('view payment function')
}

const openModal= () =>{
   $('#modal-add-payment').modal('show');
}

</script>
<!-- <script>KENJI SPA
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
      this.getNumberOfSaleStatus();
   },

   data() {
      return {
         sales: [],
         editing: null,
         saleStatuses: null,
         selectedStatus: null,
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
      getNumberOfSaleStatus() {
         axios
            .get(`/api/v1/sales-status`)
            .then(res => {
               if (res.data.status == true) {
                 this.saleStatuses = res.data.data
               }
            })
            .catch(err => {
               showToast('error', err)
            })
      },
      handleAddInvoice() {
         $('#invoice-modal').modal('show');
      },
      showModalAddPayment(sale) {
         this.editing = sale;
         $('#modal-add-payment').modal('show')
      },
      getSales(status = null, page = 1) {
         this.selectedStatus = status;
         console.log(this.selectedStatus);
         axios
            .get(`/api/v1/sales?page=${page}&perPage=${this.perPage}`, {
               params: {
                  status: status,
               }
            })
            .then(res => {
               if (res.data.status == true) {
                  this.sales = res.data.data;
               }
            })
            .catch(err => {
               showToast('error', err)
            })
      }
   }
}
</script> -->

<style scoped>
</style>
