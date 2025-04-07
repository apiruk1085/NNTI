<template>
  <body>
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
      <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
          <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">
            <img src="../assets/NNTI.png" alt="Hero Image" class="img-fluid" style="max-width: 90%; height: auto; margin-left: 10%; margin-right: 0;">
          </h1>
          
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
          <div class="login">
            <h2 class="text-center" style="color: #6a0dad;">Login</h2>
            <form class="p-4 p-md-5 border rounded-3 text-center" @submit.prevent="handleLogin">
              <div class="form-floating mb-3 position-relative">
                <i class="fas fa-user input-icon"></i>
                <input type="text" class="form-control text-center" id="username" placeholder="🌟 ใส่ชื่อผู้ใช้ของคุณ" v-model="username" required>
                <label for="username">Username</label>
              </div>
              <div class="form-floating mb-3 position-relative">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" class="form-control text-center" id="password" placeholder="🔒 ใส่รหัสผ่านของคุณ" v-model="password" required>
                <label for="password">Password</label>
              </div>
              <div class="checkbox mb-3">
                <label>
                  <input type="checkbox" v-model="rememberMe"> Remember me
                </label>
              </div>
              <button class="w-100 btn btn-lg btn-login" type="submit">เข้าสู่ระบบ</button>
              <p v-if="errorMessage" class="error mt-2">{{ errorMessage }}</p>
            </form>
          </div>
        </div>
      </div>
    </div>
    <p class="text-center text-body-secondary">© 1999 Company, NNTI SHOP !ใช้ในการเรียนเท่านั้น!</p>
  </body>
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
    const rememberMe = ref(false);
    const router = useRouter();

    const handleLogin = async () => {
      // จำลองการตรวจสอบข้อมูลผู้ใช้งาน
      if (username.value === 'admin' && password.value === '1234') {
        // ถ้าข้อมูลถูกต้อง, ให้เก็บข้อมูลผู้ใช้ใน sessionStorage
        sessionStorage.setItem('user', JSON.stringify({ username: username.value }));
        // หลังจากเข้าสู่ระบบสำเร็จ, เปลี่ยนเส้นทางไปที่หน้าอื่น
        router.push({ name: 'blog' });  // 'home' คือชื่อของ route ที่คุณต้องการไป
      } else {
        errorMessage.value = 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
      }
    };

    return { username, password, rememberMe, errorMessage, handleLogin };
  }
};
</script>

<style scoped>
body {
  font-family: 'Poppins', sans-serif;
  background-color: #f4f4f9;
  color: #6a0dad;
}

.login {
  max-width: 400px;
  margin: auto;
  padding: 30px;
  border-radius: 12px;
  background: rgba(255, 255, 255, 0.2);
  border: 2px solid #6a0dad;
  box-shadow: 0 4px 15px rgba(106, 13, 173, 0.5);
  text-align: center;
}

.input-icon {
  position: absolute;
  left: 15px;
  top: 50%;
  transform: translateY(-50%);
  color: #6a0dad;
}

input {
  width: 100%;
  padding: 12px 40px 12px 40px;
  border: 2px solid #6a0dad;
  border-radius: 8px;
  font-size: 16px;
  background: rgba(255, 255, 255, 0.8);
  box-shadow: 0 0 8px rgba(106, 13, 173, 0.3);
  text-align: center;
  transition: all 0.3s ease;
}

input:focus {
  border-color: #ffb400;
  outline: none;
  box-shadow: 0 0 10px rgba(255, 180, 0, 0.5);
}

.btn-login {
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

.btn-login:hover {
  background: linear-gradient(to right, #ff8800, #ff5500);
}
</style>
