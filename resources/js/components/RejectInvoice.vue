<template>
    <div 
      class="modal fade" 
      id="reject-invoice" 
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
        <h5 class="text-center">Do you want to reject this invoice?</h5>
      </div>
      <div class="modal-footer ">
        <div class="col-md-12 text-center">
            <button type="button" class="btn btn-primary me-1">Yes</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>
</div>
</template>
<script>
export default {
  props: ['invoiceDetails', 'status'],
  data() {
    return {
      invoiceDetails: this.invoiceDetails,
      status: this.status
    }
  },
  created() {

  },
  methods: {

  }
}
</script>