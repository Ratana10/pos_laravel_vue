import { ref } from 'vue';

export default function usePurchases(){

   const purchases = ref({data: []})
   const purchaseCode = ref(null);

   const getPurchases = async () =>{
      await axios.get('/api/v1/purchases')
      .then(res =>{
         if(res.data.status == true){
            purchases.value = res.data.data;
         }
      })
   };

   const store = async (data) =>{
      await axios.post('/api/v1/purchases', data)
      .then(res =>{
         console.log('success');
      })
   };

   const getPurchaseCode = async () =>{
      await axios.get('/api/v1/purchases-code')
      .then(res =>{
         purchaseCode.value = res.data.data
      })
   };


   return {
      purchases,
      purchaseCode,
      getPurchases,
      store,
      getPurchaseCode,
   }
}