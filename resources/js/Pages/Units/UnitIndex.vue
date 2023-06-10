<template>
<div>
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Units</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                  <li class="breadcrumb-item active">Units</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   <div class="content">
      <div class="container-fluid">
         <div class="d-flex justify-content-between">
            <div>
               <button @click="openModal" type="button" class="btn btn-primary mb-2">
                  <i class="fa fa-plus"></i>
                  Add New Unit
               </button>
            </div>
            <div>
               <div class="input-group">
                  <input v-model="search" type="text" class="form-control" placeholder="Search Unit">
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
                           <option v-for="page in pages" :key="page.name" :value="page.value">{{ page.label}}</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <UnitTable :units="units" @edit="editUnit" @delete="deleteUnit" />
                  </div>
               </div>
               <div class="d-flex justify-content-between">
                     <div class="dataTables_info" role="status" aria-live="polite">
                        Showing {{ (units.current_page - 1) * units.per_page + 1 }}
                        - {{ Math.min(units.current_page * units.per_page, units.total) }}
                        of {{ units.total }}
                     </div>
                  <div class="">
                     <Bootstrap4Pagination :data="units" @pagination-change-page="onPageChange" />
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <ModalAddUnit :editing="editing" @submit="getUnits" />
</div>
</template>

<script setup>
import {Bootstrap4Pagination} from 'laravel-vue-pagination';
import usePagination from '../../pagination';
import UnitTable from './UnitTable.vue';
import ModalAddUnit from './ModalAddUnit.vue';
import { onMounted, ref } from 'vue';
import useNotifications from '../../notifications';
import useUnits from '../../Composables/units';

const { units, getUnits, destroyUnit } = useUnits();

const {pages, perpage, onPageChange} = usePagination(getUnits);

onMounted(()=> getUnits());

const {confirmNotification} = useNotifications();

const deleteUnit = (unit) =>{
    confirmNotification(unit.name)
   .then((result) =>{
      if(result){
         destroyUnit(unit.id)
         getUnits();
      }
   });  
}

const editing = ref(null);

const editUnit = (unit) =>{
   editing.value = unit;
   $('#modal-add-unit').modal('show');
}

const openModal = ()=>{
   editing.value = null;

   $('#modal-add-unit').modal('show');
}

</script>

<!-- <script>
import UnitTable from './UnitTable.vue';
import ModalAddUnit from './ModalAddUnit.vue';
import { showToast } from '../../swalUtils';
import { debounce } from 'lodash';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';

export default {
   components: {
      UnitTable,
      ModalAddUnit,
      Bootstrap4Pagination,
   },
   mounted() {
      this.getUnits();
   },
   watch:{
      perPage: function(){
         this.getUnits();
      },
      search: debounce(function(){
         this.searchUnits();
      }, 200),
   },
   data() {
      return {
         units: [],
         editing: null,
         search: null,
         perPage: 10,
         pages:[
            {
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
         ],
      }
   },
   methods: {
      searchUnits(){
         axios
            .get(`/api/v1/units-search?search=${this.search}`)
            .then(res =>{
               this.units = res.data.data;
            })
      },
      handleSubmit(icon, title){
         $('#modal-add-unit').modal('hide');
         showToast(icon, title);               
         this.getUnits();
      },
      handleDelete(unit_id){
         axios
            .delete(`/api/v1/units/${unit_id}`)
            .then(res =>{
               this.getUnits();
            })
      },
      handleEdit(unit){
         this.editing = unit;
         $('#modal-add-unit').modal('show');
      },
      handleAdd() {
         this.editing = null;
         $('#modal-add-unit').modal('show');
      },
      getUnits(page=1){
         axios
         .get(`/api/v1/units?page=${page}&perPage=${this.perPage}`)
         .then(res =>{
            this.units = res.data.data;
         })
         .catch(err =>{
            console.log('error: ', err);
         })
      }

   },

}
</script> -->

<style>
   
</style>
