<template>
<table class="table table-bordered">
   <thead>
      <tr>
         <th style="width: 10px;">#</th>
         <th>Code</th>
         <th>Product</th>
         <th>cost</th>
         <th>Price</th>
         <th>Qty</th>
         <th>Unit</th>
         <th>Category</th>
         <th>Image</th>
         <th>Barcode</th>
         <th>Status</th>
         <th style="width: 100px;">Actions</th>
      </tr>
   </thead>
   <tbody>
      <tr v-for="(product, index) in products.data" :key="index">
         <td>{{ index+1 }}</td>
         <td>{{ product.code }}</td>
         <td>{{ product.name }}</td>
         <td>{{ product.cost }}</td>
         <td>{{ product.price }}</td>
         <td>{{ product.quantity }}</td>
         <td>{{ product.unit.name }}</td>
         <td>{{ product.category.name }}</td>
         <td style="width: 100px">
            <img :src="'/uploads/products/' + product.image" alt="photo" class="mx-auto d-block">
         </td>
         <td>{{ product.barcode }}</td>
         <td>{{ product.status == 1 ? 'Active' : 'Inactive' }}</td>
         <td>
            <router-link :to="`/admin/products/${product.id}/edit`" class="btn btn-primary btn-sm" @click="$emit('edit', product)"><i class="fa fa-edit"></i></router-link>
            <button class="btn btn-danger btn-sm ml-1" @click="$emit('delete', product.id)"><i class="fa fa-trash"></i></button>
         </td>
      </tr>
   </tbody>
</table>
</template>

<script>
export default {
   props: {
      products: {
         data: Array,
         default: null,
      }
   },
}
</script>

<style scoped>
img {
   width: 100px;
   height: 75px;
}
</style>
