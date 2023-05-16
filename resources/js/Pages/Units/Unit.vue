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
               <button @click="handleAdd" type="button" class="btn btn-primary mb-2">
                  <i class="fa fa-plus"></i>
                  Add New Unit
               </button>
            </div>
         </div>
         <div class="card">
            <div class="card-body">
               <unit-table :units="units" @edit="handleEdit" @delete="handleDelete" />
            </div>
         </div>
      </div>
   </div>

   <modal-add-unit :editing="editing" @submit="handleSubmit" />
</div>
</template>

<script>
import UnitTable from './UnitTable.vue';
import ModalAddUnit from './ModalAddUnit.vue';
import { useToastr } from '../../toastr';

export default {
   components: {
      UnitTable,
      ModalAddUnit,
   },
   data() {
      return {
         units: [],
         editing: null,
         toastr: useToastr(),
      }
   },
   methods: {
      handleSubmit(){
         $('#modal-add-unit').modal('hide');
         this.getUnits();
      },
      handleDelete(unit_id){
         axios
            .delete(`/api/v1/units/${unit_id}`)
            .then(res =>{
               this.getUnits();
               this.toastr.success('Unit Deleted Successfully');
            })
      },
      handleEdit(unit){
         this.editing = unit;
         $('#modal-add-unit').modal('show');
      },
      handleAdd() {
         $('#modal-add-unit').modal('show');
      },
      getUnits(){
         axios.get('/api/v1/units')
         .then(res =>{
            this.units = res.data;
         })
      }

   },
   mounted() {
      this.getUnits();
   },
}
</script>

<style>
   
</style>
