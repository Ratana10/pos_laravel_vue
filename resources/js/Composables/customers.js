import { ref } from 'vue';

export default function useCustomers(){
   const customers = ref({data: []})

   const getCustomers = async (perpage=10, page=1) => {
      await axios.get(`/api/v1/customers`,{
         params:{
            page: page,
            perpage: perpage,
         }
      })
      .then(res =>{
         console.log(res);
         if(res.data.status){
            customers.value = res.data.data;
         }
      })
   };

   const storeCustomer = async (data) => {
      await axios.post(`/api/v1/customers`, data)
   };

   const destroyCustomer = async (id) => {
      await axios.post(`/api/v1/customers/${id}`, )
   };


   return {
      customers,
      getCustomers,
      storeCustomer,
      destroyCustomer,
   }
}