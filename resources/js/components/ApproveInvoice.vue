<template>
    <div 
      class="modal fade" 
      id="approve-invoice" 
      tabindex="-1" 
      aria-hidden="true"
    >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button 
          type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <h5 class="text-center">Do you want to approve this invoice?</h5>
      </div>
      <div class="modal-footer">
        <div class="col-md-12 text-center">
            <button type="button" class="btn btn-primary me-1" @click="approveInvoice()">Yes</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>
</div>
</template>
<script>
export default {
  props: ['invoiceDetails'],
  data() {
    return {
      invoiceDetails: this.invoiceDetails,
      action: 'approve'
    }
  },
  created() {
  },
  methods: {
    approveInvoice() {
      axios({
        method: 'put',
        url: 'http://localhost/api/invoices/' + this.invoiceDetails.id,
        data: {
          action: this.action
        }
      }).then(response => {
        this.$emit('invoiceUpdated', 'updated');
        this.closeModal();
        window.location.reload();
      });
    },
    closeModal() {
      $('.fade').removeClass('show');
    }
  }
}
</script>