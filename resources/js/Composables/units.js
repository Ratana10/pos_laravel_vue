import {ref} from 'vue';

export default function useUnits(){
   const units = ref({data: []});

   const getUnits = async (status=null)=>{
      await axios.get('/api/v1/units',{
         params:{
            status: status,
         }
      })
      .then(res =>{
         if(res.data.status == true){
            units.value = res.data.data;
         }
      })
   };
   
   return{
      units,
      getUnits,
   }
}