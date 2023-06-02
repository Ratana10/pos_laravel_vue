import axios from "axios";
import {ref} from 'vue';

export default function usePayments(){

   const payments = ref({data:[]});
   
   const getPayments = async(perPage=10, page=1) =>{
      console.log(perPage, page)
      let response = await axios.get(`/api/v1/payments?page=${page}&perPage=${perPage}`)
      payments.value = response.data.data;      
   }

   const findPaymentBySale = async(sale_id=null) =>{
      let response = await axios.get(`/api/v1/payments?sale_id=${sale_id}`)
      payments.value = response.data.data;      
   }

   return{
      payments,
      getPayments,
      findPaymentBySale,
   }
}