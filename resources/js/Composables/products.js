import { ref } from 'vue'
export default function useProducts(){
   const products = ref([])

   const getProducts = async (status=null) =>{
      await axios.get('/api/v1/products',{
         params:{
            status: status,
         }
      })
      .then(res =>{
         if(res.data.status == true){
            products.value = res.data.data;
         }
      })
   }

   return{
      products,
      getProducts,
   }

}