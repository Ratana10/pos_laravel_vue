import { ref, watch } from 'vue';

export default function usePagination(getData){

   const perpage = ref(10);
   const pages = ref([
      { label: '5', value: 5 },
      { label: '10', value: 10 },
      { label: '25', value: 25 },
      { label: '50', value: 50 },
      { label: '100', value: 100 },
   ]);

   // watch perpage showing changed
   watch(perpage, (newperpage) => getData(newperpage));

   // when click to next page on pagination
   const onPageChange = (newpage) => {
      getData(perpage.value, newpage);
   };

   return{
      perpage,
      pages,
      onPageChange,
   }
}