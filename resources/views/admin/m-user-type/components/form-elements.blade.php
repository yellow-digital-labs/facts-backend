<div class="mb-3"
  :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
  <label for="name" class="form-label" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{
    trans('admin.m-user-type.columns.name') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.name" class="form-control"
      :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}"
      id="name" name="name"
      placeholder="{{ trans('admin.m-user-type.columns.name') }}"
      value="{{ $mUserType ? $mUserType->name : '' }}">
  </div>
</div>

<div class="form-check row"
  :class="{'has-danger': errors.has('active'), 'has-success': fields.active && fields.active.valid }">
  <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
    <input class="form-check-input" id="active" type="checkbox" v-model="form.active"
      data-vv-name="active" name="active_fake_element" {{ $mUserType&&$mUserType->active == '1'?'checked':'' }}>
    <label class="form-check-label" for="active">
      {{ trans('admin.m-user-type.columns.active') }}
    </label>
    <input type="hidden" name="active" :value="form.active">
  </div>
</div>


