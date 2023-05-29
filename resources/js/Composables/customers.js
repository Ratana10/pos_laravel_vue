import { ref } from 'vue';

export default function useCustomers(){
   const customers = ref({data: []})

   const getCustomers = async (perPage, page=1) => {
      await axios.get(`/api/v1/customers?page=${page}&perPage=${perPage}`)
      .then(res =>{
         if(res.data.status == true){
            customers.value = res.data.data;
         }
      })
   }

   const store = async (data) => {
      await axios.post(`/api/v1/customers`, data)
   }

   return {
      customers,
      getCustomers,
      store,
   }
}