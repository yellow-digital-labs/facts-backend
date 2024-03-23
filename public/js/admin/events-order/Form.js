'use strict';
$(document).ready(function () {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
});

document.addEventListener('DOMContentLoaded', function (e) {
(function () {
const AddForm = document.querySelector('#AddForm');
// Form validation for Add new record
if (AddForm) {
FormValidation.formValidation(AddForm, {
fields: {
booking_user_id: {
validators: {
notEmpty: {
message: 'Please enter prodotto'
}
}
},
event_user_id: {
validators: {
notEmpty: {
message: 'Please enter prodotto'
}
}
},
event_id: {
validators: {
notEmpty: {
message: 'Please enter prodotto'
}
}
},
no_of_booking: {
validators: {
notEmpty: {
message: 'Please enter prodotto'
}
}
},
booking_unit_amount: {
validators: {
notEmpty: {
message: 'Please enter prodotto'
}
}
},
applicable_tax_amount: {
validators: {
notEmpty: {
message: 'Please enter prodotto'
}
}
},
booking_total_amount: {
validators: {
notEmpty: {
message: 'Please enter prodotto'
}
}
},
points_used: {
validators: {
notEmpty: {
message: 'Please enter prodotto'
}
}
},
booking_payable_amount: {
validators: {
notEmpty: {
message: 'Please enter prodotto'
}
}
},
status: {
validators: {
notEmpty: {
message: 'Please enter prodotto'
}
}
},
},
plugins: {
trigger: new FormValidation.plugins.Trigger(),
bootstrap5: new FormValidation.plugins.Bootstrap5({
// Use this for enabling/changing valid/invalid class
// eleInvalidClass: '',
eleValidClass: '',
rowSelector: '.col-12'
}),
submitButton: new FormValidation.plugins.SubmitButton(),
// Submit the form when all fields are valid
// defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
autoFocus: new FormValidation.plugins.AutoFocus()
}
}).on('core.form.valid', function() {
AddForm.submit();
});
}
})();
});