<script>
import { ref, onBeforeMount} from 'vue';
import { useRoute } from 'vue-router';
import modal from "../../components/EditModal.vue"

const API_URL = import.meta.env.VITE_API_URL;
export default {
    components: {
    },
    setup () {

        function editModal(){
    let element = this.$refs.modal.$el
    $(element).modal('show')
  }

        async function createNewProduct(name, price) {
          const formData = {}
          formData.name = name;
          formData.price = price;
          console.log(typeof(formData))
          console.log(JSON.stringify({formData}))
          const response = await fetch(`${API_URL}/products`, {
            method: 'POST',
            headers: {
              'Content-type': 'application/json; charset=UTF-8' 
            },
            body: JSON.stringify(formData)
          });
          return await response.json();
        }
        
        const products = ref({});
      
        function deleteProduct(id){
          fetch(`${API_URL}/products/` + id, {
            method: 'DELETE',
          })
       
        }

        onBeforeMount(async () => {
            try {
                const res_products = await fetch(`${API_URL}/products`);
                const data_products = await res_products.json();
                products.value = data_products;
                products.value = products["value"]["hydra:member"];
            } catch (error) {
                console.log(error);
            }
        
        });
        
      
        return {
            products,
            deleteProduct,
            createNewProduct,
            editModal
        }
    }      
         
    
    

};

</script>


<template>
  <div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Price</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in products" :key="product.id">
          <th scope="row">{{ product.id }}</th>
          <td>{{ product.name }}</td>
          <td>{{ product.price }}</td>
          <td><button class="buttonAction"><i class="bi bi-trash text-danger" @click.prevent="deleteProduct(product.id)"></i></button><button class="buttonAction"><i class="bi bi-pencil-square text-warning" @click.prevent="showModal()"><editModal ref="modal"></editModal></i></button></td>
          
        </tr>
        <tr>
          <td>
            <form @submit.prevent="createNewProduct(name, price)">
              <input type="text" v-model="name" placeholder="Name">
              <input type="number" v-model="price" placeholder="Price">
              <button class="buttonAdd">Add Product</button>    
            </form>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>


<style lang="css">
  .buttonAction {
    background: none;
    border: none;
    padding: 0;
    cursor: cursor;
    outline: none;
    margin-right: 2em;
  }
 
  .buttonAdd {
    color: #fff;
    border-radius: 5px;
    font-family: 'Lato', sans-serif;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    display: inline-block;
    box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),
    7px 7px 20px 0px rgba(0,0,0,.1),
    4px 4px 5px 0px rgba(0,0,0,.1);
    outline: none;
    background: linear-gradient(0deg, rgba(255,151,0,1) 0%, rgba(251,75,2,1) 100%);
    width: 130px;
    height: 40px;
    line-height: 42px;
    padding: 0;
    border: none;
    text-align: center;
  }
</style>