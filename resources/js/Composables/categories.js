import { ref } from 'vue';
export default function useCategories(){
   const categories = ref({data: []});

   const getCategories = async (perpage=10, page=1) => {
      await axios.get(`/api/v1/categories`,{
         params:{page: page, perpage: perpage}
      })
      .then(res =>{
         if(res.data.status){
            categories.value = res.data.data;
         }
      })
   };

   const storeCategory = async (data) => {
      try {
         const res = await axios.post(`/api/v1/categories`, data)
         return res.data.status;
      } catch (error) {
         throw error.response.data.errors;  
      } 
   };

   const updateCategory = async (data) => {
      try {
         const res = await axios.put(`/api/v1/categories/${data.id}`, data)
         return res.data.status;
      } catch (error) {
         throw error.response.data.errors;  
      } 
   }

   const destroyCategory = async (id) => {
      await axios.delete(`/api/v1/categories/${id}`, )
   };

   return{
      categories,
      getCategories,
      storeCategory,
      updateCategory,
      destroyCategory,
   }

}