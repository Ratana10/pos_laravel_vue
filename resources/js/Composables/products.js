import { ref } from 'vue'
export default function useProducts(){
   const products = ref([])
   const product = ref(null);

   const getProducts = async (perpage=10, page=1) =>{
      await axios.get('/api/v1/products',{
         params:{page: page, perpage: perpage}
      })
      .then(res =>{
         if(res.data.status == true){
            products.value = res.data.data;
         }
      })
   }

   const storeProduct = async (data) =>{
      try {
         const res = await axios.post(`/api/v1/products`, data)
         return res.data.status;
      } catch (error) {
         throw error.response.data.errors;  
      } 
   };

   const editProduct = async (id) =>{
      await axios.get(`/api/v1/products/${id}/edit`)
      .then(res =>{
         if(res.data.status == true){
            product.value = res.data.data;
            console.log('product', product.value);
         }
      })
   }
      
   const updateProduct = async (data) => {
      try {
         const res = await axios.put(`/api/v1/products/${data.id}`, data)
         return res.data.status;
      } catch (error) {
         throw error.response.data.errors;  
      } 
   }

   const destroyProduct= async (id) => {
      await axios.delete(`/api/v1/products/${id}`, )
   };

   const product_code = ref(null);

   const getProductCode = async ()=>{
      const res = await axios.get('/api/v1/products-code')
      product_code.value = res.data;
      console.log('code');
   }

   return{
      products,
      product,
      product_code,
      getProducts,
      getProductCode,
      storeProduct,
      editProduct,
      updateProduct,
      destroyProduct,
   }

}