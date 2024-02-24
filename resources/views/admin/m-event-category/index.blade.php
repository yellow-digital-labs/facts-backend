@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', trans('admin.m-event-category.actions.index'))

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@endsection

@section('page-script')
<script>
  var m-event-categoriesView = '/m_event_categories/list';
  var urlCreateView = 'm-event-categories/create';
</script>
<script src="{{asset('js/admin/m-event-category/Listing.js')}}"></script>
@endsection

@section('content')
<div class="card">
  <div class="card-header">
    <h5 class="card-title mb-0">{{trans('admin.post.actions.index')}}</h5>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables table dt-column-search">
      <thead class="border-top">
        <tr>
          <th></th>
                    <th>{{ trans('admin.m-event-category.columns.id') }}</th>
                    <th>{{ trans('admin.m-event-category.columns.event_category_name') }}</th>
                    <th>{{ trans('admin.m-event-category.columns.active') }}</th>
                  </tr>
      </thead>
    </table>
  </div>
</div>


<!-- Modal to add new record -->
<div class="offcanvas offcanvas-end" id="add-new-record">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="exampleModalLabel">Add {{trans('admin.post.actions.index')}}</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body flex-grow-1">
    <form method="POST" class="add-new-record pt-0 row g-4" id="form-add-new-record">
      @csrf
      <input type="hidden" name="id" id="edit-id">

      @include('admin.m-event-category.components.form-elements')

      <div class="col-sm-12 mt-5">
        <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
      </div>
    </form>
  </div>
</div>
@endsection