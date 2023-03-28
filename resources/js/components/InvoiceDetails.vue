<template>
  <div class="row row d-flex align-items-center justify-content-center">
    <div class="col-11">
      <div class="row mt-5">
        <div class="card">
          <div class="card-body">
            <div class="container mb-5 mt-3">
              <div class="container">
                <div class="row d-flex align-items-baseline">
                  <div class="col-xl-9">
                    <h3>
                      <b>Invoice</b>
                    </h3>
                  </div>
                  <div class="col-xl-3 float-end">
                    <div class="text-end">
                      <button @click="$router.back()" class="btn btn-primary">Back</button>
                      <button v-if="invoiceDetails.status === 'draft'" class="btn btn-success ms-1 me-1" data-bs-toggle="modal" data-bs-target="#approve-invoice" @click="reloadComponent()"> Approve </button>
                      <button v-if="invoiceDetails.status === 'draft'" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#reject-invoice" @click="reloadComponent()"> Reject </button>
                    </div>
                  </div>
                  <div class="col-xl-12">
                    <hr>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xl-9">
                    <ul class="list-unstyled">
                      <li>
                        <b class="me-1">Invoice Number</b>
                        <span>{{invoiceDetails.number}}</span>
                      </li>
                      <li>
                        <b class="me-1">Invoice Date</b>
                        <span>{{invoiceDetails.date}}</span>
                      </li>
                      <li>
                        <b class="me-1">Due Date</b>
                        <span>{{invoiceDetails.due_date}}</span>
                      </li>
                      <li>
                        <b class="me-1">Status</b>
                        <span class="badge fw-bold" :class="addBadgeClass(invoiceDetails.status)">
                          {{invoiceDetails.status}}
                        </span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-xl-3">
                    <ul class="list-unstyled">
                      <li>
                        <b class="me-1">To</b>
                        <span>{{company.name}}</span>
                      </li>
                      <li>
                        <b class="me-1">Street</b>
                        <span>{{company.street}}</span>
                      </li>
                      <li>
                        <b class="me-1">City</b>
                        <span>{{company.city}}</span>
                      </li>
                      <li>
                        <b class="me-1">Zip Code</b>
                        <span>{{company.zip}}</span>
                      </li>
                      <li>
                        <b class="me-1">Phone</b>
                        <span>{{company.phone}}</span>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="row my-2 mx-1 justify-content-center">
                  <table class="table table-striped table-borderless">
                    <thead class="bg-primary text-white">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Description</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(product, index) in products" :key="product.id">
                        <td scope="row" class="w-10">{{index + 1}}</td>
                        <td class="w-25">{{product.name}}</td>
                        <td class="w-20">{{product.pivot.quantity}}</td>
                        <td class="w-25">{{product.price + ' ' + product.currency }}</td>
                        <td>{{product.amountProducts + ' ' + product.currency }}</td>
                      </tr>
                      <tr>
                        <td scope="row"></td>
                        <td></td>
                        <td></td>
                        <td class="text-end">
                          <span class="h5">
                            <b>Total</b>
                          </span>
                        </td>
                        <td>
                          <span class="h5">
                            <b>{{this.invoiceDetails.totalAmountProducts + ' '}}</b>
                          </span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <ApproveInvoice :key="reload" :invoice-details="invoiceDetails" :status="approved" @invoice-updated="reloadInvoiceData($event)"/>
  <RejectInvoice :key="reload" :invoice-details="invoiceDetails" :status="rejected" />
</template>
<script>
import shared from './../shared';
import ApproveInvoice from './ApproveInvoice.vue';
import RejectInvoice from './RejectInvoice.vue';

export default {
  components: {
    ApproveInvoice,
    RejectInvoice
  },
  data() {
    return {
      invoiceDetails: [],
      products: [],
      company: [],
      approved: 'approved',
      rejected: 'rejected',
      reload: 0
    }
  },
  created() {
    this.addBadgeClass = shared.addBadgeClass;
    this.getInvoiceDetails();
  },
  methods: {
    getInvoiceDetails() {
      axios
        .get('http://localhost/api/invoices/' + this.$route.params.invoiceId)
        .then(response => {
          this.invoiceDetails = response.data[0];
          this.company = JSON.parse(this.invoiceDetails.company);
          this.products = JSON.parse(this.invoiceDetails.products);
        });
    },
    reloadComponent() {
      this.reload++;
    },
    reloadInvoiceData(invoiceUpdated) {
      if (invoiceUpdated == 'updated') {
        this.getInvoiceDetails(); 
      }
    },
  }
}
</script>