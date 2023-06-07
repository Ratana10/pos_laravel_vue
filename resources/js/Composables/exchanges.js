import { ref } from 'vue';

export default function useExchanges(){
   const exchanges = ref({data: []})

   const getExchanges = async (perpage=10, page=1) => {
      await axios.get(`/api/v1/exchanges`,{
         params:{page: page, perpage: perpage}
      })
      .then(res =>{
         if(res.data.status){
            exchanges.value = res.data.data;
         }
      })
   };

   const storeExchange = async (data) => {
      try {
         const res = await axios.post(`/api/v1/exchanges`, data)
         return res.data.status;
      } catch (error) {
         throw error.response.data.errors;  
      } 
   };

   const updateExchange = async (data) => {
      try {
         const res = await axios.put(`/api/v1/exchanges/${data.id}`, data)
         console.log('test')
         return res.data.status;
      } catch (error) {
         throw error.response.data.errors;  
      } 
   }

   const destroyExchange = async (id) => {
      await axios.delete(`/api/v1/exchanges/${id}`, )
   };


   return {
      exchanges,
      getExchanges,
      storeExchange,
      updateExchange,
      destroyExchange,
   }
}