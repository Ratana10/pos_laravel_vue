import {ref} from 'vue';

export default function useUsers(){

   const users = ref({data: []});

   const getUsers = async (perpage=10, page=1)=>{
      await axios.get('/api/v1/users',{
         params:{ page: page, perpage: perpage }
      })
      .then(res =>{
         if(res.data.status){
            users.value = res.data.data;
         }
      })
   }

   const storeUser = async (data) => {
      try {
         const res = await axios.post(`/api/v1/users`, data)
         return res.data.status;
      } catch (error) {
         throw error.response.data.errors;  
      } 
   }
   
   const updateUser = async (data) => {
      try {
         const res = await axios.put(`/api/v1/users/${data.id}`, data)
         return res.data.status;
      } catch (error) {
         throw error.response.data.errors;  
      } 
   }

   const destroyUser = async (id) => {
      await axios.delete(`/api/v1/users/${id}`)
   }

   return{
      users,
      getUsers,
      storeUser,
      updateUser,
      destroyUser,
   }
}