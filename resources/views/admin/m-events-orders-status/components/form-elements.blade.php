<div class="mb-3"
  :class="{'has-danger': errors.has('events_orders_status_name'), 'has-success': fields.events_orders_status_name && fields.events_orders_status_name.valid }">
  <label for="events_orders_status_name" class="form-label" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{
    trans('admin.m-events-orders-status.columns.events_orders_status_name') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.events_orders_status_name" class="form-control"
      :class="{'form-control-danger': errors.has('events_orders_status_name'), 'form-control-success': fields.events_orders_status_name && fields.events_orders_status_name.valid}"
      id="events_orders_status_name" name="events_orders_status_name"
      placeholder="{{ trans('admin.m-events-orders-status.columns.events_orders_status_name') }}"
      value="{{ $mEventsOrdersStatus ? $mEventsOrdersStatus->events_orders_status_name : '' }}">
  </div>
</div>

<div class="form-check row"
  :class="{'has-danger': errors.has('active'), 'has-success': fields.active && fields.active.valid }">
  <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
    <input class="form-check-input" id="active" type="checkbox" v-model="form.active"
      data-vv-name="active" name="active_fake_element" {{ $mEventsOrdersStatus&&$mEventsOrdersStatus->active == '1'?'checked':'' }}>
    <label class="form-check-label" for="active">
      {{ trans('admin.m-events-orders-status.columns.active') }}
    </label>
    <input type="hidden" name="active" :value="form.active">
  </div>
</div>


