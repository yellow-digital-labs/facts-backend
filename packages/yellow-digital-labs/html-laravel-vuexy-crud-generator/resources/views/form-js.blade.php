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
@foreach($columns as $column)
@if(!in_array($column['name'], ['published_at']) && $column['type'] != 'boolean')
{{ $column['name'].':' }} {
validators: {
notEmpty: {
message: 'Please enter prodotto'
}
}
},
@endif
@endforeach
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