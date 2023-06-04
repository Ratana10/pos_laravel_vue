<template>
<table class="table text-center table-bordered" >
   <thead>
      <tr >
         <th style="width: 10px;">#</th>
         <th class="text-left">Date</th>
         <th class="text-left">Sale Code</th>
         <th class="text-left">Customer</th>
         <th>Due Amount</th>
         <th>Paid Amount</th>
         <th>Remain</th>
         <th>Status</th>
         <th>SellBy</th>
         <th style="width: 120px;">Actions</th>

      </tr>
   </thead>
   <tbody v-if="sales.data && sales.data.length > 0">
      <tr v-for="(sale, index) in sales.data" :key="index">
         <td>{{ index + 1 }}</td>
         <td class="text-left">{{ sale.created_at }}</td>
         <td class="text-left">{{ sale.sale_code }}</td>
         <td class="text-left">{{ sale.customer }}</td>
         <td>$ {{ sale.due_amount }}</td>
         <td>$ {{ sale.paid_amount }}</td>
         <td>$ {{ (sale.due_amount - sale.paid_amount).toFixed(2) }}</td>
         <td class="text-center">
            <span 
               :class="`btn btn-sm btn-${sale.status.color} text-white font-semibold `" style="width: 75px;">
               {{ sale.status.name }}
            </span>
         </td>
         <td>{{ sale.sell_by }}</td>
         <td>
            <div class="relative inline-block dropdown ">
               <button  
                  class="inline-flex items-center px-4 py-2 font-semibold text-gray-700 bg-gray-300 rounded"
                  @click="toggleDropDown">
                  <span class="mr-1">Action</span>
                  <i class="fa fa-caret-down"></i>
               </button>
               <ul v-if="isDropDownOpen"  class="absolute pt-1 text-gray-700 dropdown-menu">
                  <li v-for="(item, index) in actionOptions" :key="index" >
                     <p 
                        class="block px-4 py-2 whitespace-no-wrap bg-gray-200 rounded-t hover:bg-gray-400 hover:text-white hover:font-semibold"
                        style="cursor: pointer"
                        @click="onChangeAction(sale, item.value)" >
                        {{ item.label }}
                     </p>
                  </li>
               </ul>
            </div>
         </td>
      </tr>
   </tbody>
   <tbody v-else>
      <tr>
         <td colspan="10" class="text-center">No Record</td>
      </tr>
   </tbody>
</table>
</template>

<script setup>
import {
   defineProps,
   ref
} from 'vue';

const props = defineProps({
   sales: {
      data: Array,
      default: null,
   },
   actionOptions: {
      data: Array,
      default: null,
   }
})

const isDropDownOpen = ref(false);

const toggleDropDown = ()=>{
   isDropDownOpen.value = !isDropDownOpen.value;
}

const onChangeAction = (sale, value) => {
   let selectedOption = props.actionOptions.find(e => e.value === value)
   if (selectedOption && selectedOption.function) {
      selectedOption.function(sale);
   }
}
</script>

<style scoped>
.dropdown:hover .dropdown-menu {
   display: block;
}

</style>
