<template>
    <section class="py-5">
      <div class="container">
        <!-- Header -->
        <h2 class="text-center display-4 gradient-text glow-header mb-5">
          <i class="fas fa-history me-2"></i> ประวัติการเติมเงิน
        </h2>
  
        <!-- No Data Alert -->
        <div v-if="topUpList.length === 0" class="alert alert-light text-center shadow-sm rounded-pill border border-primary">
          <i class="fas fa-info-circle me-2 text-primary"></i>
          <span class="fs-5">ยังไม่มีประวัติการเติมเงิน</span>
        </div>
  
        <!-- List of Transactions -->
        <div v-else class="row justify-content-center">
          <div class="col-md-8">
            <ul class="list-group shadow-sm">
              <li
                v-for="(item, index) in topUpList"
                :key="index"
                class="list-group-item d-flex justify-content-between align-items-center bg-white mb-2 rounded transaction-item"
              >
                <!-- Transaction Details -->
                <div class="transaction-details">
                  <p class="mb-1"><strong class="text-primary fs-6">จำนวนเงิน:</strong> {{ item.amount }} บาท</p>
                  <p class="mb-1"><strong class="text-success fs-6">ช่องทาง:</strong> {{ item.paymentMethod }}</p>
                  <p class="mb-0"><strong class="text-info fs-6">เบอร์โทร:</strong> {{ item.phoneNumber }}</p>
                </div>
  
                <!-- Action Buttons -->
                <div class="action-buttons">
                  <button class="btn btn-outline-warning btn-sm me-2 hover-scale" @click="editTopUp(index)">
                    <i class="fas fa-edit"></i> แก้ไข
                  </button>
                  <button class="btn btn-outline-danger btn-sm hover-scale" @click="deleteTopUp(index)">
                    <i class="fas fa-trash"></i> ลบ
                  </button>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script>
  export default {
    data() {
      return {
        topUpList: [],
      };
    },
    methods: {
      // Load Top-Up History from Local Storage
      loadTopUpList() {
        const storedList = JSON.parse(localStorage.getItem('topUpList')) || [];
        this.topUpList = storedList;
      },
  
      // Edit Transaction
      editTopUp(index) {
        const item = this.topUpList[index];
        if (confirm(`คุณต้องการแก้ไขรายการนี้ใช่ไหม?\nจำนวนเงิน: ${item.amount} บาท\nช่องทาง: ${item.paymentMethod}`)) {
          console.log("แก้ไขข้อมูล:", item);
        }
      },
  
      // Delete Transaction
      deleteTopUp(index) {
        if (confirm("คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลนี้?")) {
          this.topUpList.splice(index, 1);
          localStorage.setItem('topUpList', JSON.stringify(this.topUpList));
        }
      },
    },
    mounted() {
      this.loadTopUpList();
    },
  };
  </script>
  
  <style scoped>
  /* Gradient Text */
  .gradient-text {
    background: linear-gradient(90deg, #ff6f61, #6a0dad, #3498db);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-size: 3rem; /* Increase Font Size */
    font-weight: bold;
  }
  
  /* Glow Header Effect */
  .glow-header {
    animation: glow-animation 2s infinite alternate;
  }
  
  /* Glow Animation */
  @keyframes glow-animation {
    0% {
      text-shadow: 0 0 10px rgba(106, 13, 173, 0.8), 0 0 20px rgba(255, 111, 97, 0.8);
    }
    100% {
      text-shadow: 0 0 20px rgba(106, 13, 173, 1), 0 0 30px rgba(255, 111, 97, 1);
    }
  }
  
  /* Rounded Pill */
  .rounded-pill {
    border-radius: 50px;
  }
  
  /* Transaction Item */
  .transaction-item {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .transaction-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }
  
  /* Transaction Details */
  .transaction-details p {
    font-size: 1.1rem; /* Increase Font Size */
    line-height: 1.5;
    margin: 0;
  }
  
  /* Action Buttons */
  .action-buttons button {
    font-size: 0.9rem; /* Increase Font Size */
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
  }
  
  /* Hover Scale Effect */
  .hover-scale:hover {
    transform: scale(1.1);
    transition: transform 0.3s ease;
  }
  </style>