export default {
  addBadgeClass: function(invoiceStatus) {
    let badgeClass;
    switch (invoiceStatus) {
      case 'rejected':
        badgeClass = "bg-danger";
        break;
      case 'approved':
        badgeClass = "bg-success";
        break;
      case 'draft':
        badgeClass = "bg-primary";
        break;
    }

    return badgeClass;
  }
}