import { ref } from 'vue';

export default function useCustomers(){
   const customers = ref({data: []})

   const getCustomers = async (perpage=10, page=1) => {
      await axios.get(`/api/v1/customers`,{
         params:{page: page, perpage: perpage}
      })
      .then(res =>{
         if(res.data.status){
            customers.value = res.data.data;
         }
      })
   };

   const storeCustomer = async (data) => {
      try {
         const res = await axios.post(`/api/v1/customers`, data)
         return res.data.status;
      } catch (error) {
         throw error.response.data.errors;  
      } 
   };

   const updateCustomer = async (data) => {
      try {
         const res = await axios.put(`/api/v1/customers/${data.id}`, data)
         return res.data.status;
      } catch (error) {
         throw error.response.data.errors;  
      } 
   }

   const destroyCustomer = async (id) => {
      await axios.delete(`/api/v1/customers/${id}`, )
   };


   return {
      customers,
      getCustomers,
      storeCustomer,
      updateCustomer,
      destroyCustomer,
   }
}