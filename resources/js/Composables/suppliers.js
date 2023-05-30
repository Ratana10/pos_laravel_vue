import { ref } from "vue";

export default function useSuppliers(){
   const suppliers = ref({data:[]});

   const getSuppliers = async (status=null)=>{
      await axios.get('/api/v1/suppliers', {
         params:{
            status: status,
         }
      })
      .then(res =>{
         if(res.data.status == true){
            suppliers.value = res.data.data;
         }
      })
   };


   return {
      suppliers,
      getSuppliers,
   }
}