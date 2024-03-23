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
user_id: {
validators: {
notEmpty: {
message: 'Please enter prodotto'
}
}
},
event_categories_id: {
validators: {
notEmpty: {
message: 'Please enter prodotto'
}
}
},
event_name: {
validators: {
notEmpty: {
message: 'Please enter prodotto'
}
}
},
event_start_datetime: {
validators: {
notEmpty: {
message: 'Please enter prodotto'
}
}
},
event_end_datetime: {
validators: {
notEmpty: {
message: 'Please enter prodotto'
}
}
},
event_description: {
validators: {
notEmpty: {
message: 'Please enter prodotto'
}
}
},
event_primary_image: {
validators: {
notEmpty: {
message: 'Please enter prodotto'
}
}
},
event_location: {
validators: {
notEmpty: {
message: 'Please enter prodotto'
}
}
},
event_contact: {
validators: {
notEmpty: {
message: 'Please enter prodotto'
}
}
},
event_available_tickets: {
validators: {
notEmpty: {
message: 'Please enter prodotto'
}
}
},
event_ticket_amount: {
validators: {
notEmpty: {
message: 'Please enter prodotto'
}
}
},
event_ticket_discount_amount: {
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