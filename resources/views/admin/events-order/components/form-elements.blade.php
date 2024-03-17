<div class="mb-3"
  :class="{'has-danger': errors.has('booking_user_id'), 'has-success': fields.booking_user_id && fields.booking_user_id.valid }">
  <label for="booking_user_id" class="form-label" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{
    trans('admin.events-order.columns.booking_user_id') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.booking_user_id" class="form-control"
      :class="{'form-control-danger': errors.has('booking_user_id'), 'form-control-success': fields.booking_user_id && fields.booking_user_id.valid}"
      id="booking_user_id" name="booking_user_id"
      placeholder="{{ trans('admin.events-order.columns.booking_user_id') }}"
      value="{{ $eventsOrder ? $eventsOrder->booking_user_id : '' }}">
  </div>
</div>

<div class="mb-3"
  :class="{'has-danger': errors.has('event_user_id'), 'has-success': fields.event_user_id && fields.event_user_id.valid }">
  <label for="event_user_id" class="form-label" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{
    trans('admin.events-order.columns.event_user_id') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.event_user_id" class="form-control"
      :class="{'form-control-danger': errors.has('event_user_id'), 'form-control-success': fields.event_user_id && fields.event_user_id.valid}"
      id="event_user_id" name="event_user_id"
      placeholder="{{ trans('admin.events-order.columns.event_user_id') }}"
      value="{{ $eventsOrder ? $eventsOrder->event_user_id : '' }}">
  </div>
</div>

<div class="mb-3"
  :class="{'has-danger': errors.has('event_id'), 'has-success': fields.event_id && fields.event_id.valid }">
  <label for="event_id" class="form-label" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{
    trans('admin.events-order.columns.event_id') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.event_id" class="form-control"
      :class="{'form-control-danger': errors.has('event_id'), 'form-control-success': fields.event_id && fields.event_id.valid}"
      id="event_id" name="event_id"
      placeholder="{{ trans('admin.events-order.columns.event_id') }}"
      value="{{ $eventsOrder ? $eventsOrder->event_id : '' }}">
  </div>
</div>

<div class="mb-3"
  :class="{'has-danger': errors.has('no_of_booking'), 'has-success': fields.no_of_booking && fields.no_of_booking.valid }">
  <label for="no_of_booking" class="form-label" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{
    trans('admin.events-order.columns.no_of_booking') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.no_of_booking" class="form-control"
      :class="{'form-control-danger': errors.has('no_of_booking'), 'form-control-success': fields.no_of_booking && fields.no_of_booking.valid}"
      id="no_of_booking" name="no_of_booking"
      placeholder="{{ trans('admin.events-order.columns.no_of_booking') }}"
      value="{{ $eventsOrder ? $eventsOrder->no_of_booking : '' }}">
  </div>
</div>

<div class="mb-3"
  :class="{'has-danger': errors.has('booking_unit_amount'), 'has-success': fields.booking_unit_amount && fields.booking_unit_amount.valid }">
  <label for="booking_unit_amount" class="form-label" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{
    trans('admin.events-order.columns.booking_unit_amount') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.booking_unit_amount" class="form-control"
      :class="{'form-control-danger': errors.has('booking_unit_amount'), 'form-control-success': fields.booking_unit_amount && fields.booking_unit_amount.valid}"
      id="booking_unit_amount" name="booking_unit_amount"
      placeholder="{{ trans('admin.events-order.columns.booking_unit_amount') }}"
      value="{{ $eventsOrder ? $eventsOrder->booking_unit_amount : '' }}">
  </div>
</div>

<div class="mb-3"
  :class="{'has-danger': errors.has('applicable_tax_amount'), 'has-success': fields.applicable_tax_amount && fields.applicable_tax_amount.valid }">
  <label for="applicable_tax_amount" class="form-label" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{
    trans('admin.events-order.columns.applicable_tax_amount') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.applicable_tax_amount" class="form-control"
      :class="{'form-control-danger': errors.has('applicable_tax_amount'), 'form-control-success': fields.applicable_tax_amount && fields.applicable_tax_amount.valid}"
      id="applicable_tax_amount" name="applicable_tax_amount"
      placeholder="{{ trans('admin.events-order.columns.applicable_tax_amount') }}"
      value="{{ $eventsOrder ? $eventsOrder->applicable_tax_amount : '' }}">
  </div>
</div>

<div class="mb-3"
  :class="{'has-danger': errors.has('booking_total_amount'), 'has-success': fields.booking_total_amount && fields.booking_total_amount.valid }">
  <label for="booking_total_amount" class="form-label" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{
    trans('admin.events-order.columns.booking_total_amount') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.booking_total_amount" class="form-control"
      :class="{'form-control-danger': errors.has('booking_total_amount'), 'form-control-success': fields.booking_total_amount && fields.booking_total_amount.valid}"
      id="booking_total_amount" name="booking_total_amount"
      placeholder="{{ trans('admin.events-order.columns.booking_total_amount') }}"
      value="{{ $eventsOrder ? $eventsOrder->booking_total_amount : '' }}">
  </div>
</div>

<div class="mb-3"
  :class="{'has-danger': errors.has('points_used'), 'has-success': fields.points_used && fields.points_used.valid }">
  <label for="points_used" class="form-label" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{
    trans('admin.events-order.columns.points_used') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.points_used" class="form-control"
      :class="{'form-control-danger': errors.has('points_used'), 'form-control-success': fields.points_used && fields.points_used.valid}"
      id="points_used" name="points_used"
      placeholder="{{ trans('admin.events-order.columns.points_used') }}"
      value="{{ $eventsOrder ? $eventsOrder->points_used : '' }}">
  </div>
</div>

<div class="mb-3"
  :class="{'has-danger': errors.has('booking_payable_amount'), 'has-success': fields.booking_payable_amount && fields.booking_payable_amount.valid }">
  <label for="booking_payable_amount" class="form-label" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{
    trans('admin.events-order.columns.booking_payable_amount') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.booking_payable_amount" class="form-control"
      :class="{'form-control-danger': errors.has('booking_payable_amount'), 'form-control-success': fields.booking_payable_amount && fields.booking_payable_amount.valid}"
      id="booking_payable_amount" name="booking_payable_amount"
      placeholder="{{ trans('admin.events-order.columns.booking_payable_amount') }}"
      value="{{ $eventsOrder ? $eventsOrder->booking_payable_amount : '' }}">
  </div>
</div>

<div class="mb-3"
  :class="{'has-danger': errors.has('status'), 'has-success': fields.status && fields.status.valid }">
  <label for="status" class="form-label" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{
    trans('admin.events-order.columns.status') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.status" class="form-control"
      :class="{'form-control-danger': errors.has('status'), 'form-control-success': fields.status && fields.status.valid}"
      id="status" name="status"
      placeholder="{{ trans('admin.events-order.columns.status') }}"
      value="{{ $eventsOrder ? $eventsOrder->status : '' }}">
  </div>
</div>


