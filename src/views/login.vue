<template>
  
  <div class="login">
    <h2 class="text-center">Login</h2>
    <form @submit.prevent="handleLogin" class="form">
      <div class="input-group">
        <span class="input-group-text"><i class="fas fa-user"></i></span>
        <input type="text" v-model="username" id="username" required class="input-style" placeholder="Username" />
      </div>

      <div class="input-group">
        <span class="input-group-text"><i class="fas fa-lock"></i></span>
        <input type="password" v-model="password" id="password" required class="input-style" placeholder="Password" />
      </div>

      <button type="submit" class="btn-submit">
        <i class="fas fa-sign-in-alt"></i> Login
      </button>

      <p v-if="errorMessage" class="error">{{ errorMessage }}</p>
    </form>
  </div>
  
</template>

<script>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

export default {
  name: 'Login',
  setup() {
    const username = ref('');
    const password = ref('');
    const errorMessage = ref('');
    const router = useRouter();

    const handleLogin = async () => {
      try {
        const response = await fetch('http://localhost:226/app-show/Backen/login.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ username: username.value, password: password.value })
        });
        const data = await response.json();
        
        if (data.message === 'Login successful') {
          sessionStorage.setItem('user', JSON.stringify(data.user));
          router.push({ name: 'blog' });
        } else {
          errorMessage.value = data.message;
        }
      } catch (error) {
        console.error('Error logging in:', error);
        errorMessage.value = 'เกิดข้อผิดพลาดในการเชื่อมต่อเซิร์ฟเวอร์';
      }
    };

    return { username, password, errorMessage, handleLogin };
  }
};
</script>

<style scoped>

/* ฟอร์มล็อกอินโปร่งใส + ขอบออร่าสีม่วง */
.login {
  max-width: 400px;
  margin: auto;
  padding: 40px;
  background: rgba(255, 255, 255, 0.2); /* โปร่งแสง */
  border-radius: 15px;
  box-shadow: 0 0 20px rgba(106, 13, 173, 0.6); /* ออร่าสีม่วง */
  backdrop-filter: blur(10px);
  animation: fadeIn 1s ease-in-out;
}

/* หัวข้อ */
h2 {
  font-size: 28px;
  color: #6a0dad; /* ม่วงเข้ม */
  text-transform: uppercase;
  text-align: center;
  letter-spacing: 2px;
  text-shadow: 0 0 10px rgba(106, 13, 173, 0.8);
  margin-bottom: 30px;
}

/* ช่องกรอกข้อมูลพร้อมไอคอน */
.input-group {
  display: flex;
  align-items: center;
  background: rgba(255, 255, 255, 0.8);
  border-radius: 10px;
  margin-bottom: 15px;
  padding: 5px;
  border: 2px solid #6a0dad;
  box-shadow: 0 0 10px rgba(106, 13, 173, 0.4);
}

.input-group-text {
  background: transparent;
  border: none;
  color: #6a0dad;
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
  color: #6a0dad;
  outline: none;
}

.input-style::placeholder {
  color: rgba(106, 13, 173, 0.6);
}

/* ปุ่มล็อกอิน */
.btn-submit {
  width: 100%;
  padding: 12px;
  background: linear-gradient(45deg, #ffb400, #ff8800);
  color: white;
  border: none;
  border-radius: 10px;
  font-size: 18px;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 0 15px rgba(255, 176, 0, 0.6);
  font-weight: bold;
}

.btn-submit:hover {
  background: linear-gradient(45deg, #ff8800, #ff6500);
  transform: translateY(-3px);
  box-shadow: 0 0 20px rgba(255, 136, 0, 0.8);
}

/* ข้อความแสดงข้อผิดพลาด */
.error {
  color: #ff4757;
  font-size: 14px;
  margin-top: 10px;
  text-align: center;
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

.input-style, .btn-submit {
  opacity: 0;
  transform: translateY(10px);
  animation: fadeIn 0.5s ease forwards;
}

.input-style:nth-child(1), .btn-submit:nth-child(3) {
  animation-delay: 0.2s;
}

.input-style:nth-child(2) {
  animation-delay: 0.4s;
}
</style>
