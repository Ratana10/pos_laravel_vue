import { ref } from 'vue';
import { useRouter } from 'vue-router';
export default function usePurchases(){

   const purchases = ref({data: []})
   const purchaseCode = ref(null);
   const router = useRouter();

   const getPurchases = async (perpage=10, page=1) =>{
      await axios.get(`/api/v1/purchases`,{
         params:{
            perpage: perpage,
            page: page,
         }
      })
      .then(res =>{
         if(res.data.status == true){
            purchases.value = res.data.data;
         }
      })
   };

   const getPurchaseCode = async () =>{
      await axios.get('/api/v1/purchases-code')
      .then(res =>{
         purchaseCode.value = res.data.data
      })
   };

   const storePurchase = async (data) =>{
      await axios.post('/api/v1/purchases', data)
      await router.push({name: 'admin.purchases.index'})
   };

   const destroyPurchase = async (id) =>{
      await axios.delete(`/api/v1/purchases/${id}`)
   }

   return {
      purchases,
      purchaseCode,
      getPurchases,
      getPurchaseCode,
      storePurchase,
      destroyPurchase,
   }
}