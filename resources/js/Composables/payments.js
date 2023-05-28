import axios from "axios";
import {ref} from 'vue';

export default function UsePayments(){

   const payments = ref({data:[]});
   
   const getPayments = async(perPage=10, page=1) =>{
      console.log(perPage, page)
      let response = await axios.get(`/api/v1/payments?page=${page}&perPage=${perPage}`)
      payments.value = response.data.data;      
   }

   return{
      payments,
      getPayments,
   }
}