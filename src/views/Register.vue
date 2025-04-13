<template>
  <div class="container mt-5">
    <h2 class="text-center">สมัครสมาชิก</h2>
    <form @submit.prevent="register" class="form">
      <div class="input-group">
        <span class="input-group-text"><i class="fas fa-user"></i></span>
        <input v-model="first_name" class="form-control input-style" placeholder="First Name" required />
      </div>

      <div class="input-group">
        <span class="input-group-text"><i class="fas fa-user"></i></span>
        <input v-model="last_name" class="form-control input-style" placeholder="Last Name" required />
      </div>

      <div class="input-group">
        <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
        <input v-model="username" class="form-control input-style" placeholder="Username" required />
      </div>

      <div class="input-group">
        <span class="input-group-text"><i class="fas fa-lock"></i></span>
        <input v-model="password" type="password" class="form-control input-style" placeholder="Password" required />
      </div>

      <button class="btn btn-submit w-100"> 
        <i class="fas fa-user-plus"></i> Register
      </button>
    </form>

    <p v-if="message" class="message mt-3">{{ message }}</p>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const first_name = ref('');
const last_name = ref('');
const username = ref('');
const password = ref('');
const message = ref('');

async function register() {
  try {
    const res = await fetch('http://localhost:226/app-show/Backen/register.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        first_name: first_name.value,
        last_name: last_name.value,
        username: username.value,
        password: password.value
      })
    });
    const data = await res.json();
    
    if (res.ok) {
      alert('Registration successful!');
      clearForm();
    }
    message.value = data.message;
  } catch (error) {
    message.value = 'Registration failed: ' + error.message;
  }
}

function clearForm() {
  first_name.value = '';
  last_name.value = '';
  username.value = '';
  password.value = '';
}
</script>

<style scoped>

/* กรอบแบบโปร่งใสพร้อมออร่า */
.container {
  max-width: 450px;
  margin: auto;
  background: rgba(255, 255, 255, 0.3); /* พื้นหลังขาวจางๆ */
  padding: 40px;
  border-radius: 15px;
  box-shadow: 0 0 20px rgba(106, 13, 173, 0.6); /* ออร่าสีม่วง */
  backdrop-filter: blur(10px); /* ทำให้ดูเบลอ */
  animation: fadeIn 1s ease-in-out;
}

/* หัวข้อ */
h2 {
  font-size: 28px;
  color: #6a0dad; /* ม่วงเข้ม */
  text-transform: uppercase;
  letter-spacing: 2px;
  text-shadow: 0 0 10px rgba(106, 13, 173, 0.8);
  margin-bottom: 30px;
}

/* ช่องกรอกข้อมูลพร้อมไอคอน */
.input-group {
  display: flex;
  align-items: center;
  background: rgba(255, 255, 255, 0.8); /* สีขาวโปร่งใส */
  border-radius: 10px;
  margin-bottom: 15px;
  padding: 5px;
  border: 2px solid #6a0dad; /* เส้นขอบม่วงเข้ม */
  box-shadow: 0 0 10px rgba(106, 13, 173, 0.4);
}

.input-group-text {
  background: transparent;
  border: none;
  color: #6a0dad; /* ม่วงเข้ม */
  padding: 10px;
  font-size: 18px;
}

/* ช่องป้อนข้อมูล */
.input-style {
  flex: 1;
  font-size: 16px;
  padding: 12px;
  border: none;
  border-radius: 10px;
  background: transparent;
  color: #6a0dad; /* ตัวอักษรม่วงเข้ม */
  outline: none;
}

.input-style::placeholder {
  color: rgba(106, 13, 173, 0.6); /* ม่วงอ่อน */
}

/* ปุ่มสมัครสมาชิก */
.btn-submit {
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

.btn-submit:hover {
  background: linear-gradient(45deg, #ff8800, #ff6500);
  transform: translateY(-3px);
  box-shadow: 0 0 20px rgba(255, 136, 0, 0.8);
}

/* ข้อความแสดงผลลัพธ์ */
.message {
  font-size: 16px;
  color: #ff4757;
  text-align: center;
  font-weight: bold;
}

/* เอฟเฟ็คการเลื่อน */
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
