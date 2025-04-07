<template> 
    <div class="container">
      <h2 class="title">📋 Service Requests</h2>
      <table v-if="services.length" class="service-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Description</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="service in services" :key="service.id">
            <td>{{ service.id }}</td>
            <td>{{ service.customer_name }}</td>
            <td>{{ service.email }}</td>
            <td>{{ service.phone }}</td>
            <td>{{ service.description }}</td>
            <td>{{ new Date(service.created_at).toLocaleString() }}</td>
          </tr>
        </tbody>
      </table>
      <p v-else class="no-data">🚫 No service requests found.</p>
    </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      services: [],
    };
  },
  mounted() {
    this.fetchServices();
  },
  methods: {
    async fetchServices() {
      try {
        const response = await axios.get("http://localhost:226/app-show/Backen/get_services.php");
        this.services = response.data;
      } catch (error) {
        console.error("Error fetching services:", error);
      }
    },
  },
};
</script>

<style scoped>
.container {
  width: 90%;
  max-width: 1000px;
  margin: auto;
  padding: 20px;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.title {
  text-align: center;
  color: #6a0dad;
  margin-bottom: 20px;
}

.service-table {
  width: 100%;
  border-collapse: collapse;
  background: white;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

th, td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background: #6a0dad;
  color: white;
  text-transform: uppercase;
}

tbody tr:hover {
  background: #f4f4f9;
}

.no-data {
  text-align: center;
  color: #888;
  font-style: italic;
  margin-top: 20px;
}
</style>