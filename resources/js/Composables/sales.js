import { param } from 'jquery';
import { ref } from 'vue';

export default function useSales(){
   const sales = ref({data: []})
   const saleStatuses = ref([])

   const getSales = async (perPage, page=1, status=null) => {
      console.log(perPage, page, status)
      await axios.get(`/api/v1/sales?page=${page}&perPage=${perPage}`, {
         params: {
            status: status,
         }
      })
      .then(res =>{
         if(res.data.status == true){
            sales.value = res.data.data;
            console.log('test1',sales)
         }
      })
   }

   const getCountSaleStatuses = async ()=>{
      await axios.get('/api/v1/sales-status')
      .then(res =>{
         console.log(res)
         if(res.data.status == true){
            saleStatuses.value = res.data.data
         }
      })
   }

   return {
      sales,
      saleStatuses,
      getSales,
      getCountSaleStatuses,
   }
}