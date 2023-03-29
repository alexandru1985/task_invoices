<template>
  <div class="row mt-4 mb-3">
    <span class="text-center fs-1">Invoices List</span>
  </div>
  <div class="row">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Number</th>
          <th>Date</th>
          <th>Due Date</th>
          <th>Company</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="invoice in invoices" :key="invoice.id">
          <td>{{ invoice.number }}</td>
          <td>{{ invoice.date }}</td>
          <td>{{ invoice.due_date }}</td>
          <td>{{ JSON.parse(invoice.company).name }}</td>
          <td>
            <h5>
              <span class='badge' :class="addBadgeClass(invoice.status)">{{ invoice.status }}</span>
            </h5>
          </td>
          <td>
            <router-link 
              class="btn btn-primary" 
              :to="{ path: '/invoice-details/'+ invoice.id +'/show'} "
            >
              Show Invoice
            </router-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
import shared from './../shared'

export default {
  data() {
    return {
      invoices: []
    }
  },
  created() {
    this.addBadgeClass = shared.addBadgeClass;
    this.getInvoices();
  },
  methods: {
    getInvoices() {
      axios
        .get('http://localhost/api/invoices')
        .then(response => {
          this.invoices = response.data;
        });
    }
  }
}
</script>