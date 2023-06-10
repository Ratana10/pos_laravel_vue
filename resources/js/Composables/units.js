import {ref} from 'vue';

export default function useUnits(){
   const units = ref({data: []});

   const getUnits = async (perpage=10, page=1, status=null)=>{
      await axios.get('/api/v1/units',{
         params:{ perpage:perpage, page:page, status: status,}
      })
      .then(res =>{
         if(res.data.status == true){
            units.value = res.data.data;
         }
      })
   };

   const storeUnit = async (data) => {
      try {
         const res = await axios.post(`/api/v1/units`, data)
         return res.data.status;
      } catch (error) {
         throw error.response.data.errors;  
      } 
   };

   const updateUnit = async (data) => {
      try {
         const res = await axios.put(`/api/v1/units/${data.id}`, data)
         return res.data.status;
      } catch (error) {
         throw error.response.data.errors;  
      } 
   }

   const destroyUnit = async (id) => {
      await axios.delete(`/api/v1/units/${id}`, )
   };
   
   return{
      units,
      getUnits,
      storeUnit,
      updateUnit,
      destroyUnit,
   }
}