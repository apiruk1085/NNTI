<template>
  <header class="d-flex flex-wrap align-items-center justify-content-between py-3 mb-4 border-bottom shadow-sm bg-white rounded-3 custom-header-border">
    <div class="col-md-3 mb-2 mb-md-0 text-center">
      <a href="#" class="d-inline-flex link-body-emphasis text-decoration-none">
        <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
      </a>
    </div>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
      <li><a href="/Blogshop" class="nav-link px-3 text-dark hover-effect">Home</a></li>
      <li><a href="/Blog" class="nav-link px-3 text-dark hover-effect">Blog</a></li>
      <li><a href="/ShowProduct" class="nav-link px-3 text-dark hover-effect">SHOP</a></li>
      <li><a href="/Product" class="nav-link px-3 text-dark hover-effect">AddProduct</a></li>

      <!-- Dropdown for Servive -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle px-3 text-dark hover-effect" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Service
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item hover-effect" href="/Servive">Service Form</a></li>
          <li><a class="dropdown-item hover-effect" href="/ServiceList">Service List</a></li>
          <li><a class="dropdown-item hover-effect" href="/Top-UpList">Service Top-Up</a></li>
        </ul>
      </li>

      <li><a href="/about" class="nav-link px-3 text-dark hover-effect">About</a></li>
    </ul>

    <div class="col-md-3 text-end">
      <a href="/login" class="btn btn-outline-purple me-2 btn-animated btn-rounded">Login</a>
      <a href="/Register" class="btn btn-purple btn-animated btn-rounded">Sign-up</a>
    </div>
  </header>
  <router-view />
</template>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

body {
  font-family: 'Poppins', sans-serif;
  background-color: #f8f9fa;
  margin: 0;
  padding: 0;
}

.nav-link {
  font-weight: 500;
  color: #6a0dad; /* สีม่วงเข้ม */
  text-transform: uppercase; /* ตัวอักษรทั้งหมดเป็นตัวพิมพ์ใหญ่ */
  letter-spacing: 1px; /* ระยะห่างระหว่างตัวอักษร */
  transition: color 0.3s ease-in-out, text-shadow 0.3s ease-in-out;
}

.nav-link:hover, .nav-link:focus {
  color: #fff !important;
  text-shadow: 0 0 10px rgba(106, 13, 173, 0.8); /* เพิ่มออร่าม่วง */
}

.hover-effect {
  position: relative;
  text-decoration: none;
}

.hover-effect::after {
  content: '';
  display: block;
  width: 100%;
  height: 2px;
  background-color: #6a0dad; /* สีม่วงเข้ม */
  transform: scaleX(0);
  transition: transform 0.3s ease-in-out;
}

.hover-effect:hover::after {
  transform: scaleX(1);
}

.btn-animated {
  transition: transform 0.2s ease-in-out, box-shadow 0.2s, background-color 0.3s;
  font-weight: 500;
}

.btn-animated:hover {
  transform: scale(1.1);
  box-shadow: 0 5px 15px rgba(106, 13, 173, 0.4); /* ออร่าม่วง */
}

.btn-rounded {
  border-radius: 25px;
  padding: 10px 20px;
}

/* เพิ่มสีกรอบให้กับปุ่ม Login และ Sign-up */
.btn-outline-purple {
  border: 2px solid #6a0dad;
  color: #6a0dad;
}

.btn-outline-purple:hover {
  background-color: #6a0dad;
  color: #fff;
  border-color: #6a0dad; /* สีกรอบยังคงเป็นสีม่วงเข้มเมื่อ hover */
}

.btn-purple {
  background-color: #6a0dad;
  color: #fff;
  border: 2px solid #6a0dad; /* กรอบสีม่วงเข้ม */
}

.btn-purple:hover {
  background-color: #8e44ad;
}

header {
  border-radius: 15px;
  border: 3px solid #6a0dad; /* กรอบสีม่วงเข้ม */
  box-shadow: 0 0 15px rgba(106, 13, 173, 0.5); /* เพิ่มเงาออร่าม่วง */
  padding: 20px;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}

.navbar {
  display: flex;
  justify-content: space-between;
}

.custom-header-border {
  border: 3px solid #6a0dad; /* กรอบสีม่วงเข้ม */
  box-shadow: 0 0 15px rgba(106, 13, 173, 0.5); /* เงาออร่าม่วง */
}

/* Dropdown */
.nav-item.dropdown:hover .dropdown-menu {
  display: block;
}

.dropdown-toggle::after {
  content: ' ▼';
}

.dropdown-menu {
  background-color: #fff;
  border: 1px solid #6a0dad;
  border-radius: 5px;
}

.dropdown-item:hover {
  background-color: #f1f1f1; /* สีพื้นหลังเมื่อ hover */
}

@media (max-width: 767px) {
  .nav-link {
    font-size: 14px; /* ลดขนาดฟอนต์ในมือถือ */
    letter-spacing: 0;
  }

  .btn-animated {
    font-size: 14px; /* ขนาดปุ่มในมือถือ */
  }

  .header {
    padding: 15px; /* ลดพื้นที่ด้านในเมื่อแสดงบนมือถือ */
  }
}

@media (max-width: 576px) {
  .nav-link {
    font-size: 12px; /* ลดขนาดฟอนต์ในมือถือที่เล็กที่สุด */
  }
}
</style>
