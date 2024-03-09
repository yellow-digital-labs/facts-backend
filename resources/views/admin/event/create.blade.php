@extends('layouts/layoutMaster')

@section('title', trans('admin.event.actions.create'))

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
@endsection

@section('page-script')
asset('js/admin/post/Listing.js')
<script src="{{asset('js/admin/event/Form.js')}}"></script>
@endsection

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<!-- Default -->
<div class="row">

  <!-- Default Wizard -->
  <div class="col-12 mb-4">
    <form method="POST" id="AddForm" action="/events">
      @csrf
      <div class="card">
        <div class="card-header d-flex justify-content-between border-bottom">
          <div class="card-title mb-0">
            <h5 class="mb-0 text-black">Add event</h5>
          </div>
        </div>

        <div class="card-body pt-4">
          @include('admin.event.components.form-elements')
        </div>

        <div class="card-footer">
          <button type="submit" class="btn btn-primary" :disabled="submiting">
            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
            Save
          </button>
        </div>
      </div>
    </form>
  </div>
  <!-- /Default Wizard -->
</div>

@endsection