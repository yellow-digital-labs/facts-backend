<div class="mb-3"
  :class="{'has-danger': errors.has('event_category_name'), 'has-success': fields.event_category_name && fields.event_category_name.valid }">
  <label for="event_category_name" class="form-label" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{
    trans('admin.m-event-category.columns.event_category_name') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.event_category_name" class="form-control"
      :class="{'form-control-danger': errors.has('event_category_name'), 'form-control-success': fields.event_category_name && fields.event_category_name.valid}"
      id="event_category_name" name="event_category_name"
      placeholder="{{ trans('admin.m-event-category.columns.event_category_name') }}"
      value="{{ $m-event-category ? $m-event-category->event_category_name : '' }}">
  </div>
</div>

<div class="form-check row"
  :class="{'has-danger': errors.has('active'), 'has-success': fields.active && fields.active.valid }">
  <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
    <input class="form-check-input" id="active" type="checkbox" v-model="form.active"
      data-vv-name="active" name="active_fake_element" {{ $m-event-category&&$m-event-category->active == '1'?'checked':'' }}>
    <label class="form-check-label" for="active">
      {{ trans('admin.m-event-category.columns.active') }}
    </label>
    <input type="hidden" name="active" :value="form.active">
  </div>
</div>


