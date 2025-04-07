<template>
    <section class="top-up py-5">
      <div class="container">
        <!-- Header -->
        <h2 class="text-center display-4 gradient-text glow-header mb-5">
          <i class="fas fa-coins me-2"></i> เติมเงิน
        </h2>
  
        <!-- Form -->
        <div class="row justify-content-center">
          <div class="col-md-8">
            <form @submit.prevent="handleSubmit" class="p-5 shadow-lg rounded bg-white form-glow">
              <div class="mb-4">
                <label for="amount" class="form-label text-primary fw-bold">จำนวนเงิน (บาท)</label>
                <input
                  type="number"
                  class="form-control form-control-lg glow-input"
                  id="amount"
                  v-model="currentForm.amount"
                  required
                />
              </div>
              <div class="mb-4">
                <label for="paymentMethod" class="form-label text-primary fw-bold">ช่องทางการชำระเงิน</label>
                <select
                  class="form-select form-select-lg glow-input"
                  id="paymentMethod"
                  v-model="currentForm.paymentMethod"
                  required
                >
                  <option value="" disabled selected>เลือกช่องทางการชำระเงิน</option>
                  <option value="credit-card">บัตรเครดิต/เดบิต</option>
                  <option value="bank-transfer">โอนผ่านธนาคาร</option>
                  <option value="e-wallet">กระเป๋าเงินอิเล็กทรอนิกส์</option>
                </select>
              </div>
              <div class="mb-4">
                <label for="phoneNumber" class="form-label text-primary fw-bold">เบอร์โทรศัพท์</label>
                <input
                  type="tel"
                  class="form-control form-control-lg glow-input"
                  id="phoneNumber"
                  v-model="currentForm.phoneNumber"
                  required
                />
              </div>
              <button type="submit" class="btn btn-glow w-100 pulse-effect">
                <i class="fas fa-check me-2"></i> ยืนยันการเติมเงิน
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script>
  export default {
    data() {
      return {
        currentForm: {
          amount: null,
          paymentMethod: "",
          phoneNumber: "",
        },
      };
    },
    methods: {
      handleSubmit() {
        if (!this.currentForm.amount || !this.currentForm.paymentMethod || !this.currentForm.phoneNumber) {
          alert("กรุณากรอกข้อมูลให้ครบถ้วน");
          return;
        }
  
        // เก็บข้อมูลใน Local Storage
        const topUpList = JSON.parse(localStorage.getItem('topUpList')) || [];
        topUpList.push({ ...this.currentForm });
        localStorage.setItem('topUpList', JSON.stringify(topUpList));
  
        alert("ขอบคุณสำหรับการเติมเงิน!");
        this.currentForm = { amount: null, paymentMethod: "", phoneNumber: "" };
      },
    },
  };
  </script>
  
  <style scoped>
  /* Gradient Text */
  .gradient-text {
    background: linear-gradient(90deg, #ff6f61, #6a0dad, #3498db);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-size: 2.5rem;
    font-weight: bold;
    text-shadow: 0 0 10px rgba(106, 13, 173, 0.8), 0 0 20px rgba(255, 111, 97, 0.8);
  }
  
  /* Glow Header Effect */
  .glow-header {
    position: relative;
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
  
  /* Glow Input Effect */
  .glow-input:focus {
    box-shadow: 0 0 15px rgba(106, 13, 173, 0.7), 0 0 25px rgba(255, 111, 97, 0.7);
    border-color: #6a0dad;
  }
  
  /* Glow Button */
  .btn-glow {
    background: linear-gradient(90deg, #ff6f61, #6a0dad);
    border: none;
    color: #fff;
    font-size: 1.2rem;
    font-weight: bold;
    box-shadow: 0 0 10px rgba(106, 13, 173, 0.7), 0 0 20px rgba(255, 111, 97, 0.7);
    transition: all 0.3s ease;
  }
  .btn-glow:hover {
    box-shadow: 0 0 20px rgba(106, 13, 173, 1), 0 0 30px rgba(255, 111, 97, 1);
    transform: scale(1.05);
  }
  
  /* Pulse Effect */
  .pulse-effect {
    animation: pulse 1.5s infinite;
  }
  @keyframes pulse {
    0% {
      box-shadow: 0 0 0 0 rgba(106, 13, 173, 0.7);
    }
    70% {
      box-shadow: 0 0 0 10px rgba(106, 13, 173, 0);
    }
    100% {
      box-shadow: 0 0 0 0 rgba(106, 13, 173, 0);
    }
  }
  </style>