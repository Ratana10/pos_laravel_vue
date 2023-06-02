import axios from "axios";
import {ref} from 'vue';

export default function useSaleDetails(){

   const sale_details = ref({data:[]});
   

   const findSaleDetailBySale = async(sale_id=null) =>{
      let response = await axios.get(`/api/v1/saledetails?sale_id=${sale_id}`)
      sale_details.value = response.data.data;      
   }

   return{
      sale_details,
      findSaleDetailBySale,
   }
}