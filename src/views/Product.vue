<template>
  <div class="container">
    <h2 class="text-center mb-4">เพิ่มข้อมูลสินค้า</h2>
    <button @click="showAddForm" class="btn-submit mb-4">Add Product</button>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Details</th>
          <th>Image</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in products" :key="product.id">
          <td>{{ product.id }}</td>
          <td>{{ product.name }}</td>
          <td>{{ product.price }}</td>
          <td>{{ product.details }}</td>
          <td>
            <img :src="'http://localhost:226/app-show/php-vue/product_crud/' + product.image" width="100" />
          </td>
          <td>
            <button @click="editProduct(product)" class="btn btn-warning btn-sm">Edit</button>
            <button @click="confirmDelete(product.id)" class="btn btn-danger btn-sm">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Popup สำหรับเพิ่ม/แก้ไขสินค้า -->
    <div v-if="editing || adding" class="popup-overlay">
      <div class="popup">
        <h3 class="mb-4">{{ adding ? 'Add Product' : 'Edit Product' }}</h3>
        <form @submit.prevent="saveProduct">
          <input type="text" v-model="editProductData.name" placeholder="Product Name" required class="input-style mb-3" />
          <input type="number" v-model="editProductData.price" placeholder="Price" required class="input-style mb-3" />
          <textarea v-model="editProductData.details" placeholder="Product Details" required class="input-style mb-3"></textarea>
          <input type="file" @change="handleFileChange" ref="fileInput" :required="adding" class="input-style mb-3" />
          
          <div v-if="editProductData.imagePreview" class="mb-3">
            <img :src="editProductData.imagePreview" width="100" class="img-thumbnail" />
          </div>

          <button type="submit" class="btn-submit w-100 mb-2">{{ adding ? 'Add' : 'Update' }}</button>
          <button type="button" @click="cancelEdit" class="btn btn-secondary w-100">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      products: [],
      editing: false,
      adding: false,
      editProductData: { id: null, name: "", price: "", details: "", image: "", imagePreview: "" },
      selectedFile: null,
    };
  },
  mounted() {
    this.fetchProducts();
  },
  methods: {
    async fetchProducts() {
      try {
        const res = await axios.get("http://localhost:226/app-show/php-vue/product_crud/get_products.php");
        this.products = res.data;
      } catch (error) {
        alert("Error fetching products");
      }
    },
    showAddForm() {
      this.adding = true;
      this.resetForm();
    },
    editProduct(product) {
      this.editProductData = { ...product, imagePreview: product.image ? 'http://localhost:226/app-show/php-vue/product_crud/' + product.image : null };
      this.editing = true;
    },
    handleFileChange(event) {
      this.selectedFile = event.target.files[0];
    },
    async saveProduct() {
      const formData = new FormData();
      formData.append("action", this.adding ? "create" : "update");
      formData.append("id", this.editProductData.id);
      formData.append("name", this.editProductData.name);
      formData.append("price", this.editProductData.price);
      formData.append("details", this.editProductData.details);

      if (this.selectedFile) {
        formData.append("image", this.selectedFile);
      }

      try {
        await axios.post("http://localhost:226/app-show/php-vue/product_crud/upload.php", formData);
        this.fetchProducts();
        alert(this.adding ? "Product added successfully!" : "Product updated successfully!");
        this.cancelEdit();
      } catch (error) {
        alert("Error saving product");
      }
    },
    confirmDelete(id) {
      if (window.confirm("Are you sure you want to delete this product?")) {
        this.deleteProduct(id);
      }
    },
    async deleteProduct(id) {
      try {
        await axios.post("http://localhost:226/app-show/php-vue/product_crud/upload.php", new URLSearchParams({ action: "delete", id }));
        this.fetchProducts();
        alert("Product deleted successfully!");
      } catch (error) {
        alert("Error deleting product");
      }
    },
    cancelEdit() {
      this.editing = false;
      this.adding = false;
      this.resetForm();
    },
    resetForm() {
      this.editProductData = { id: null, name: "", price: "", details: "", image: "", imagePreview: "" };
      this.selectedFile = null;
      if (this.$refs.fileInput) {
        this.$refs.fileInput.value = "";
      }
    }
  }
};
</script>

<style scoped>
body {
  font-family: 'Poppins', sans-serif;
  background-color: #f4f4f9;
  color: #6a0dad;
}
.container {
  max-width: 1000px;
  margin: auto;
  background: rgba(255, 255, 255, 0.3);
  padding: 40px;
  border-radius: 15px;
  box-shadow: 0 0 20px rgba(106, 13, 173, 0.6);
  backdrop-filter: blur(10px);
  animation: fadeIn 1s ease-in-out;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 30px;
}

th, td {
  padding: 10px;
  text-align: left;
  border: 1px solid #ddd;
}

th {
  background-color: #f8f9fa;
}

button {
  padding: 8px 12px;
  font-size: 14px;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

/* Popup Styles */
.popup-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.7);
  display: flex;
  justify-content: center;
  align-items: center;
}

.popup {
  background-color: white;
  padding: 20px;
  width: 400px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.input-style {
  flex: 1;
  font-size: 16px;
  padding: 12px;
  border: none;
  border-radius: 10px;
  background: transparent;
  color: #6a0dad;
  outline: none;
}

.input-style::placeholder {
  color: rgba(106, 13, 173, 0.6);
}

button[type="submit"] {
  background: linear-gradient(45deg, #ffb400, #ff8800);
  color: white;
  font-size: 18px;
  padding: 12px;
  border: none;
  border-radius: 10px;
  transition: all 0.3s ease;
  box-shadow: 0 0 15px rgba(255, 176, 0, 0.6);
  font-weight: bold;
}

button[type="submit"]:hover {
  background: linear-gradient(45deg, #ff8800, #ff6500);
  transform: translateY(-3px);
  box-shadow: 0 0 20px rgba(255, 136, 0, 0.8);
}

button[type="button"] {
  background-color: #6c757d;
  color: white;
  border: none;
}

button[type="button"]:hover {
  background-color: #5a6268;
}

img {
  max-width: 100%;
  max-height: 100px;
  border-radius: 5px;
}

.img-thumbnail {
  border: 1px solid #ddd;
}

/* Fade In animation */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
