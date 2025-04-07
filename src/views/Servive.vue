<template>
    <div class="container">
      <h2 class="title">🔧 Service Request Form</h2>
      <form @submit.prevent="submitForm">
        <div class="form-group">
          <label for="name">Name:</label>
          <input id="name" v-model="form.customer_name" required />
        </div>
  
        <div class="form-group">
          <label for="email">Email:</label>
          <input id="email" v-model="form.email" type="email" required />
        </div>
  
        <div class="form-group">
          <label for="phone">Phone:</label>
          <input id="phone" v-model="form.phone" required />
        </div>
  
        <div class="form-group">
          <label for="description">Description:</label>
          <textarea id="description" v-model="form.description" required></textarea>
        </div>
  
        <button type="submit" class="btn-submit">Submit</button>
      </form>
  
      <p v-if="message" :class="{ success: isSuccess, error: !isSuccess }">{{ message }}</p>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    data() {
      return {
        form: {
          customer_name: "",
          email: "",
          phone: "",
          description: "",
        },
        message: "",
        isSuccess: false,
      };
    },
    methods: {
      async submitForm() {
        try {
          const response = await axios.post("http://localhost:226/app-show/Backen/service_api.php", this.form);
          this.message = response.data.success || response.data.error;
          this.isSuccess = !!response.data.success;
  
          if (this.isSuccess) {
            this.form = { customer_name: "", email: "", phone: "", description: "" };
          }
        } catch (error) {
          this.message = "Error submitting form";
          this.isSuccess = false;
        }
      },
    },
  };
  </script>
  
  <style scoped>
  /* ฟอนต์ & สีพื้นหลัง */
  body {
    font-family: "Poppins", sans-serif;
    background-color: #f4f4f9;
    color: #6a0dad;
  }
  
  /* กล่องฟอร์ม */
  .container {
    max-width: 400px;
    margin: auto;
    padding: 30px;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid #6a0dad;
    box-shadow: 0 4px 15px rgba(106, 13, 173, 0.5);
    text-align: center;
  }
  
  /* หัวข้อ */
  .title {
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 20px;
  }
  
  /* ช่องกรอกข้อมูล */
  .form-group {
    position: relative;
    margin-bottom: 15px;
  }
  
  label {
    font-size: 14px;
    font-weight: bold;
    color: #6a0dad;
    display: block;
    margin-bottom: 5px;
  }
  
  input,
  textarea {
    width: 100%;
    padding: 12px;
    border: 2px solid #6a0dad;
    border-radius: 8px;
    font-size: 16px;
    background: rgba(255, 255, 255, 0.8);
    box-shadow: 0 0 8px rgba(106, 13, 173, 0.3);
    text-align: center;
    transition: all 0.3s ease;
  }
  
  textarea {
    resize: vertical;
    min-height: 80px;
  }
  
  input:focus,
  textarea:focus {
    border-color: #ffb400;
    outline: none;
    box-shadow: 0 0 10px rgba(255, 180, 0, 0.5);
  }
  
  /* ปุ่ม Submit */
  .btn-submit {
    width: 100%;
    padding: 12px;
    background: linear-gradient(to right, #ffb400, #ff8800);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s ease;
  }
  
  .btn-submit:hover {
    background: linear-gradient(to right, #ff8800, #ff5500);
  }
  
  /* ข้อความแจ้งเตือน */
  .success {
    color: green;
    font-weight: bold;
    margin-top: 10px;
  }
  
  .error {
    color: red;
    font-weight: bold;
    margin-top: 10px;
  }
  </style>
  