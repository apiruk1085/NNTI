<template>
    <div class="container">
      <div class="team-section">
        <h2>Team Staff</h2>
        <div class="team">
          <div class="member" v-for="(member, index) in team" :key="index">
            <div class="member-card">
              <div class="member-img-wrapper">
                <img :src="member.image" :alt="member.name" class="member-img" />
              </div>
              <div class="member-info">
                <h3>{{ member.name }}</h3>
                <p>{{ member.role }}</p>
                <p><a class="btn btn-view-details" href="#">View details »</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        team: [
          { name: "Nawapon", role: " Network Administrator", image: "https://img5.pic.in.th/file/secure-sv1/431631424_1126053848545140_1322600437912274875_n.jpg" },
          { name: "Apiruk", role: " Database Administrator", image: "https://img5.pic.in.th/file/secure-sv1/470235430_1785373362240610_8265619134788088947_n.jpg" },
          { name: "Nutthinicha", role: " Support Admin", image: "https://img5.pic.in.th/file/secure-sv1/480809608_1866100073926501_591007088946664611_n.jpg" },
          { name: "Kanokwan", role: " Product Admin", image: "https://img2.pic.in.th/pic/S__2015269.jpg" },
        ]
      };
    }
  };
  </script>
  
  <style scoped>
  /* Container for the entire team section */
  .container {
    max-width: 1200px;
    margin: 60px auto;
    padding: 60px;
    background: #f9f9f9;
    border-radius: 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    text-align: center;
  }
  
  /* Styling for the team section title */
  .team-section h2 {
    font-size: 36px;
    font-weight: 700;
    color: #6a0dad;
    margin-bottom: 40px;
    letter-spacing: 2px;
    text-transform: uppercase;
  }
  
  /* Styling for each team member card */
  .team {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 40px;
    margin-top: 30px;
  }
  
  .member-card {
    background: #fff;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  
  .member-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(106, 13, 173, 0.3);
  }
  
  /* Styling for the circular image wrapper */
  .member-img-wrapper {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto 20px;
    border: 4px solid #6a0dad; /* Border with purple color */
    position: relative;
    box-shadow: 0 0 20px rgba(106, 13, 173, 0.3); /* Purple glow effect */
    transition: box-shadow 0.3s ease, transform 0.3s ease;
  }
  
  .member-img-wrapper:hover {
    transform: scale(1.05);
    box-shadow: 0 0 25px rgba(106, 13, 173, 0.6); /* Enhanced purple glow on hover */
  }
  
  /* Styling for the member image */
  .member-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  
  /* Styling for the member's name */
  h3 {
    font-size: 24px;
    font-weight: 600;
    color: #333;
    margin: 15px 0;
    text-transform: uppercase;
  }
  
  /* Styling for the member's role */
  p {
    font-size: 16px;
    color: #777;
    margin-bottom: 10px;
  }
  
  /* Styling for the 'View details' button */
  .btn-view-details {
    background-color: #6a0dad;
    color: #fff;
    padding: 12px 28px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 600;
    transition: background-color 0.3s ease, transform 0.3s ease;
  }
  
  .btn-view-details:hover {
    background-color: #8e44ad;
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(106, 13, 173, 0.3);
  }
  
  /* Responsive design adjustments */
  @media (max-width: 1024px) {
    .team {
      grid-template-columns: repeat(2, 1fr); /* 2 members per row on tablet */
    }
  }
  
  @media (max-width: 767px) {
    .team {
      grid-template-columns: 1fr; /* 1 member per row on mobile */
    }
    .container {
      padding: 20px;
    }
  }
  </style>
  