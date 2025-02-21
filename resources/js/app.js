import './bootstrap';

import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

// Configure Toastr options (optional)
toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: "toast-top-right",
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "5000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut"
};

// Export Toastr for global usage
window.toastr = toastr;

