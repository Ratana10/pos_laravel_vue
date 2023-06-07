import { ref } from "vue";

export default function useSuppliers(){
   const suppliers = ref({data: []});

   const getSuppliers = async (perpage=10, page=1)=>{
      await axios.get('/api/v1/suppliers',{
         params:{ page: page, perpage: perpage }
      })
      .then(res =>{
         if(res.data.status){
            suppliers.value = res.data.data;
         }
      })
   }

   const storeSupplier = async (data) => {
      try {
         const res = await axios.post(`/api/v1/suppliers`, data)
         return res.data.status;
      } catch (error) {
         throw error.response.data.errors;  
      } 
   }
   
   const updateSupplier = async (data) => {
      try {
         const res = await axios.put(`/api/v1/suppliers/${data.id}`, data)
         return res.data.status;
      } catch (error) {
         throw error.response.data.errors;  
      } 
   }

   const destroySupplier = async (id) => {
      await axios.delete(`/api/v1/suppliers/${id}`)
   }

   return{
      suppliers,
      getSuppliers,
      storeSupplier,
      updateSupplier,
      destroySupplier,
   }
}