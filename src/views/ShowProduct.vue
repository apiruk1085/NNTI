<template>
  <body>
    <div id="app" class="container mt-4">
      <!-- Header -->
      <h2 class="text-center mb-4 text-gold gradient-text">รายการสินค้า</h2>

      <!-- Loading Spinner -->
      <div v-if="loading" class="text-center py-5">
        <div class="spinner-border spinner-custom" role="status">
          <span class="visually-hidden">กำลังโหลด...</span>
        </div>
      </div>

      <!-- Product List -->
      <div v-else class="row gy-4">
        <div v-for="product in products" :key="product.id" class="col-md-4 col-sm-6">
          <div class="card card-hover shadow-lg rounded-3 overflow-hidden">
            <!-- Product Image -->
            <img
              :src="getImageUrl('http://localhost:226/app-show/php-vue/product_crud/' + product.image)"
              class="card-img-top img-hover"
              alt="product.name"
              style="height: 250px; object-fit: cover;"
            />
            <div class="card-body text-center">
              <!-- Product Name -->
              <h5 class="card-title text-primary fw-bold">{{ product.name }}</h5>
              <!-- Product Price -->
              <p class="card-text text-danger fw-bold">{{ formatPrice(product.price) }} บาท</p>
              
              <!-- Toggle Details Button -->
              <button 
                v-if="!product.showDetails" 
                @click="toggleDetails(product)" 
                class="btn btn-info btn-hover me-2">
                ดูรายละเอียด
              </button>

              <!-- Show Details -->
              <transition name="fade">
                <div v-if="product.showDetails" class="mt-3">
                  <p class="card-text text-muted">{{ product.details }}</p>
                  <button 
                    @click="toggleDetails(product)" 
                    class="btn btn-warning btn-hover">
                    ซ่อนรายละเอียด
                  </button>
                </div>
              </transition>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      products: [],
      loading: true,
    };
  },
  mounted() {
    this.fetchProducts();
  },
  methods: {
    async fetchProducts() {
      try {
        const res = await axios.get("http://localhost:226/app-show/php-vue/product_crud/get_products.php");
        this.products = res.data.map(product => ({ ...product, showDetails: false }));
      } catch (error) {
        console.error("Error fetching products:", error);
        alert("ไม่สามารถโหลดข้อมูลสินค้าได้");
      } finally {
        this.loading = false;
      }
    },
    formatPrice(price) {
      return new Intl.NumberFormat("th-TH").format(price);
    },
    getImageUrl(image) {
      return image.startsWith("http") ? image : `http://localhost:226/app-show/php-vue/product_crud/uploads/${image}`;
    },
    toggleDetails(product) {
      product.showDetails = !product.showDetails;
    },
  },
};
</script>

<style scoped>
/* Global Styles */
body {
  font-family: 'Poppins', sans-serif;
  background-color: #f4f4f9;
  color: #6a0dad;
}

/* Gradient Text */
.gradient-text {
  background: linear-gradient(90deg, #ff6f61, #6a0dad);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  font-size: 2rem;
  font-weight: bold;
}

/* Card Styles */
.card-hover {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card-hover:hover {
  transform: translateY(-10px);
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
}

/* Image Hover Effect */
.img-hover {
  transition: transform 0.3s ease;
}
.img-hover:hover {
  transform: scale(1.1);
}

/* Button Hover Effect */
.btn-hover {
  transition: transform 0.3s ease, background-color 0.3s ease;
}
.btn-hover:hover {
  transform: scale(1.05);
  background-color: #338a3e;
}

/* Spinner Customization */
.spinner-custom {
  width: 4rem;
  height: 4rem;
  border-width: 0.3rem;
  border-color: #6a0dad transparent #6a0dad transparent;
  animation: spin 1s linear infinite;
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Fade Transition for Details */
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
  .card-title {
    font-size: 1.1rem;
  }
  .card-text {
    font-size: 0.9rem;
  }
}
</style>