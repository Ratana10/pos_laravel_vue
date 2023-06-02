import axios from "axios";
import {ref} from 'vue';

export default function useSaleDetails(){

   const saleDetails = ref({data:[]});
   

   const findSaleDetailBySale = async(sale_id=null) =>{
      let response = await axios.get(`/api/v1/saledetails?sale_id=${sale_id}`)
      saleDetails.value = response.data.data;      
   }

   return{
      saleDetails,
      findSaleDetailBySale,
   }
}