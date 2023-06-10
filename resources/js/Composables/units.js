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
   
   return{
      units,
      getUnits,
   }
}