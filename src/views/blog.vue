<template>
  <main>
    <!-- Hero Section -->
    <section class="hero bg-gradient-primary text-white py-5">
      <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3 gradient-text">เติมเงิน NNTI</h1>
        <p class="lead mb-4 custom-font-body">ระบบเติมเงินที่ดีที่สุดและสะดวกที่สุดสำหรับคุณ</p>
        <div class="d-flex justify-content-center gap-4">
          <a href="#learn-more" :class="['btn', 'btn-light', 'btn-lg', hoverEffect ? 'hover-scale' : '']">เรียนรู้เพิ่มเติม</a>
          <a href="/Top-Up" :class="['btn', 'btn-success', 'btn-lg', hoverEffect ? 'hover-scale' : '']">เติมเงินตอนนี้</a>
        </div>
      </div>
    </section>

    <!-- Features Section -->
    <section class="features py-5 bg-light">
      <div class="container">
        <h2 class="text-center display-4 mb-5 gradient-text">ทำไมต้องเลือก NNTI?</h2>
        <transition-group name="fade" tag="div" class="row text-center">
          <div v-for="(feature, index) in features" :key="index" class="col-md-4 mb-4">
            <div class="feature-card shadow-lg p-4 rounded">
              <i :class="['bi', feature.icon, 'fs-1', 'mb-3']"></i>
              <h3 class="custom-font-heading">{{ feature.title }}</h3>
              <p class="custom-font-body">{{ feature.description }}</p>
            </div>
          </div>
        </transition-group>
      </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works py-5">
      <div class="container text-center position-relative">
        <h2 class="display-4 mb-4 gradient-text">วิธีการเติมเงิน</h2>
        <p class="lead mb-4 custom-font-body">ดูวิธีการเติมเงินที่สะดวกและรวดเร็วที่นี่</p>
        <div class="row">
          <div v-for="(step, index) in steps" :key="index" class="col-md-4">
            <div class="step-card shadow-lg p-4 rounded">
              <i :class="['bi', step.icon, 'fs-1', 'mb-3']"></i>
              <h4 class="custom-font-heading">ขั้นตอนที่ {{ index + 1 }}</h4>
              <p class="custom-font-body">{{ step.description }}</p>
            </div>
          </div>
        </div>
        <div class="line-connector"></div>
      </div>
    </section>

    <!-- Learn More Section -->
    <section id="learn-more" class="learn-more py-5">
      <div class="container">
        <h2 class="text-center display-4 mb-5 gradient-text">เรียนรู้เพิ่มเติม</h2>
        <div class="accordion mb-5" id="faqAccordion">
          <div v-for="(item, index) in faqItems" :key="index" class="accordion-item">
            <h2 class="accordion-header" :id="'heading' + index">
              <button class="accordion-button custom-font-heading" type="button" data-bs-toggle="collapse" :data-bs-target="'#collapse' + index" aria-expanded="true" :aria-controls="'collapse' + index">
                {{ item.question }}
              </button>
            </h2>
            <div :id="'collapse' + index" class="accordion-collapse collapse" :class="{ show: index === 0 }" :aria-labelledby="'heading' + index" data-bs-parent="#faqAccordion">
              <div class="accordion-body custom-font-body">{{ item.answer }}</div>
            </div>
          </div>
        </div>
        <h3 class="text-center mb-4 gradient-text">บริการยอดนิยม</h3>
        <div class="row text-center services-grid mb-5">
          <div v-for="(service, index) in services" :key="index" class="col-6 col-md-3 mb-4">
            <div class="service-card p-3 rounded" @mouseover="highlightService(index)" @mouseleave="resetHighlight">
              <i :class="['bi', service.icon, 'fs-1', 'mb-2']"></i>
              <h5 class="custom-font-heading">{{ service.title }}</h5>
            </div>
          </div>
        </div>
        <div class="contact-info bg-light p-4 rounded shadow">
          <h3 class="text-center mb-4 gradient-text">ติดต่อเรา</h3>
          <div class="row">
            <div class="col-md-6 mb-3">
              <div class="d-flex align-items-center mb-3">
                <i class="bi bi-envelope-fill me-2 contact-icon"></i>
                <span class="custom-font-body">NNTI@nnti.com</span>
              </div>
              <div class="d-flex align-items-center mb-3">
                <i class="bi bi-telephone-fill me-2 contact-icon"></i>
                <span class="custom-font-body">02-123-4567</span>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="d-flex align-items-center mb-3">
                <i class="bi bi-line me-2 contact-icon"></i>
                <span class="custom-font-body">@nnti_official</span>
              </div>
              <div class="d-flex align-items-center mb-3">
                <i class="bi bi-facebook me-2 contact-icon"></i>
                <span class="custom-font-body">NNTI Official</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script>
export default {
  data() {
    return {
      hoverEffect: true,
      features: [
        { icon: "bi-check-circle", title: "สะดวกและรวดเร็ว", description: "เติมเงินง่ายๆ ผ่านมือถือหรือคอมพิวเตอร์ของคุณ" },
        { icon: "bi-lock", title: "ปลอดภัย 100%", description: "ระบบรักษาความปลอดภัยระดับสูงเพื่อปกป้องข้อมูลของคุณ" },
        { icon: "bi-alarm", title: "บริการตลอด 24/7", description: "ไม่มีวันหยุด บริการตลอด 24 ชั่วโมง ทุกวัน" },
      ],
      steps: [
        { icon: "bi-phone", description: "เลือกช่องทางการเติมเงินที่สะดวกกับคุณ" },
        { icon: "bi-credit-card", description: "กรอกข้อมูลการชำระเงินและยืนยันการทำรายการ" },
        { icon: "bi-check-circle", description: "รับเครดิตเติมเงินทันทีผ่านระบบของเรา" },
      ],
      faqItems: [
        { question: "NNTI คืออะไร?", answer: "NNTI เป็นระบบเติมเงินออนไลน์..." },
        { question: "วิธีการเติมเงินทำอย่างไร?", answer: "ขั้นตอนการเติมเงินมีดังนี้..." },
        { question: "มีช่องทางการชำระเงินอะไรบ้าง?", answer: "NNTI รองรับช่องทางการชำระเงินหลากหลายรูปแบบ..." },
        { question: "ใช้เวลานานแค่ไหนในการรับเครดิต?", answer: "ระบบของเราทำงานอัตโนมัติ..." },
      ],
      services: [
        { icon: "bi-controller", title: "เติมเงินเกมออนไลน์" },
        { icon: "bi-phone", title: "เติมเงินมือถือ" },
        { icon: "bi-gift", title: "บัตรของขวัญ" },
        { icon: "bi-television", title: "บริการสตรีมมิ่ง" },
      ],
      highlightedService: null,
    };
  },
  methods: {
    highlightService(index) {
      this.highlightedService = index;
    },
    resetHighlight() {
      this.highlightedService = null;
    },
  },
};
</script>

<style scoped>
/* Global Styles */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Roboto+Condensed:wght@700&display=swap');
body {
  font-family: 'Poppins', sans-serif;
  background-color: #f4f4f9;
  color: #333;
}
.custom-font-heading {
  font-family: 'Roboto Condensed', sans-serif;
  font-weight: bold;
  letter-spacing: 1px;
  color: #6a0dad;
}
.custom-font-body {
  font-family: 'Poppins', sans-serif;
  font-size: 1rem;
  color: #444;
}

/* Gradient Text */
.gradient-text {
  background: linear-gradient(90deg, #ff6f61, #6a0dad);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  font-size: 2rem;
  font-weight: bold;
}

/* Hero Section */
.hero {
  background: linear-gradient(120deg, #6a0dad, #ff6f61, #3498db);
  background-size: 300% 300%;
  animation: gradientBG 5s ease infinite;
}
@keyframes gradientBG {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}
.hover-scale:hover {
  transform: scale(1.1);
  transition: transform 0.3s ease;
}

/* Features Section */
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s ease, transform 0.5s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
  transform: translateY(20px);
}
.feature-card {
  background-color: white;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border-radius: 15px;
  height: 100%;
  border: 1px solid transparent;
}
.feature-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 8px 20px rgba(106, 13, 173, 0.3);
  border-color: #6a0dad;
}
.feature-card i {
  color: #6a0dad;
  transition: color 0.3s ease;
}
.feature-card:hover i {
  color: #ff6f61;
}

/* How It Works Section */
.line-connector {
  position: absolute;
  top: 50%;
  left: 0;
  width: 100%;
  height: 2px;
  background: linear-gradient(90deg, #6a0dad, #ff6f61);
  z-index: -1;
}
.step-card {
  position: relative;
  z-index: 1;
  transition: transform 0.3s ease;
}
.step-card::before {
  content: '';
  position: absolute;
  top: -30px;
  left: 50%;
  transform: translateX(-50%);
  width: 20px;
  height: 20px;
  background-color: #6a0dad;
  border-radius: 50%;
  box-shadow: 0 0 10px rgba(106, 13, 173, 0.5);
}
.step-card:hover {
  transform: scale(1.1);
}

/* Learn More Section */
.accordion-button:not(.collapsed) {
  background-color: rgba(106, 13, 173, 0.1);
  color: #6a0dad;
  animation: fadeIn 0.5s ease;
}
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}
.payment-methods i {
  animation: bounce 2s infinite;
}
@keyframes bounce {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
}

/* Services Grid */
.service-card {
  background-color: #f8f9fa;
  transition: all 0.3s ease;
  cursor: pointer;
  height: 100%;
}
.service-card:hover {
  background-color: #6a0dad;
  color: white;
}
.service-card:hover i, .service-card:hover h5 {
  color: white;
}
.service-card i {
  color: #6a0dad;
}

/* Contact Info */
.contact-icon {
  color: #6a0dad;
  font-size: 1.5rem;
}
.contact-info {
  border-left: 4px solid #6a0dad;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
  .hero h1 {
    font-size: 2rem;
  }
  .feature-card, .step-card {
    margin-bottom: 20px;
  }
  .accordion-button {
    padding: 0.75rem;
    font-size: 0.9rem;
  }
}
</style>