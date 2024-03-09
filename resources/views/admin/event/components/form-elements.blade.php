<div class="mb-3"
  :class="{'has-danger': errors.has('user_id'), 'has-success': fields.user_id && fields.user_id.valid }">
  <label for="user_id" class="form-label" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{
    trans('admin.event.columns.user_id') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.user_id" class="form-control"
      :class="{'form-control-danger': errors.has('user_id'), 'form-control-success': fields.user_id && fields.user_id.valid}"
      id="user_id" name="user_id"
      placeholder="{{ trans('admin.event.columns.user_id') }}"
      value="{{ $event ? $event->user_id : '' }}">
  </div>
</div>

<div class="mb-3"
  :class="{'has-danger': errors.has('event_categories_id'), 'has-success': fields.event_categories_id && fields.event_categories_id.valid }">
  <label for="event_categories_id" class="form-label" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{
    trans('admin.event.columns.event_categories_id') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.event_categories_id" class="form-control"
      :class="{'form-control-danger': errors.has('event_categories_id'), 'form-control-success': fields.event_categories_id && fields.event_categories_id.valid}"
      id="event_categories_id" name="event_categories_id"
      placeholder="{{ trans('admin.event.columns.event_categories_id') }}"
      value="{{ $event ? $event->event_categories_id : '' }}">
  </div>
</div>

<div class="mb-3"
  :class="{'has-danger': errors.has('event_name'), 'has-success': fields.event_name && fields.event_name.valid }">
  <label for="event_name" class="form-label" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{
    trans('admin.event.columns.event_name') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.event_name" class="form-control"
      :class="{'form-control-danger': errors.has('event_name'), 'form-control-success': fields.event_name && fields.event_name.valid}"
      id="event_name" name="event_name"
      placeholder="{{ trans('admin.event.columns.event_name') }}"
      value="{{ $event ? $event->event_name : '' }}">
  </div>
</div>

<div
  class="form-group row align-items-center"
  :class="{'has-danger': errors.has('event_start_datetime'), 'has-success': fields.event_start_datetime && fields.event_start_datetime.valid }">
  <label for="event_start_datetime" class="col-form-label text-md-right"
    :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.event.columns.event_start_datetime') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <div class="input-group input-group--custom">
      <input class="form-control" type="datetime-local" id="event_start_datetime" name="event_start_datetime" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_time') }}"
            value="{{ $event ? $event->event_start_datetime : '' }}" />
    </div>
  </div>
</div>

<div
  class="form-group row align-items-center"
  :class="{'has-danger': errors.has('event_end_datetime'), 'has-success': fields.event_end_datetime && fields.event_end_datetime.valid }">
  <label for="event_end_datetime" class="col-form-label text-md-right"
    :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.event.columns.event_end_datetime') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <div class="input-group input-group--custom">
      <input class="form-control" type="datetime-local" id="event_end_datetime" name="event_end_datetime" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_time') }}"
            value="{{ $event ? $event->event_end_datetime : '' }}" />
    </div>
  </div>
</div>

<div class="form-group row align-items-center"
  :class="{'has-danger': errors.has('event_description'), 'has-success': fields.event_description && fields.event_description.valid }">
  <label for="event_description" class="col-form-label text-md-right"
    :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.event.columns.event_description') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <div>
      <textarea class="form-control" v-model="form.event_description" id="event_description"
        name="event_description">{{ $event ? $event->event_description : '' }}</textarea>
    </div>
  </div>
</div>

<div class="mb-3"
  :class="{'has-danger': errors.has('event_primary_image'), 'has-success': fields.event_primary_image && fields.event_primary_image.valid }">
  <label for="event_primary_image" class="form-label" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{
    trans('admin.event.columns.event_primary_image') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.event_primary_image" class="form-control"
      :class="{'form-control-danger': errors.has('event_primary_image'), 'form-control-success': fields.event_primary_image && fields.event_primary_image.valid}"
      id="event_primary_image" name="event_primary_image"
      placeholder="{{ trans('admin.event.columns.event_primary_image') }}"
      value="{{ $event ? $event->event_primary_image : '' }}">
  </div>
</div>

<div class="mb-3"
  :class="{'has-danger': errors.has('event_location'), 'has-success': fields.event_location && fields.event_location.valid }">
  <label for="event_location" class="form-label" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{
    trans('admin.event.columns.event_location') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.event_location" class="form-control"
      :class="{'form-control-danger': errors.has('event_location'), 'form-control-success': fields.event_location && fields.event_location.valid}"
      id="event_location" name="event_location"
      placeholder="{{ trans('admin.event.columns.event_location') }}"
      value="{{ $event ? $event->event_location : '' }}">
  </div>
</div>

<div class="mb-3"
  :class="{'has-danger': errors.has('event_contact'), 'has-success': fields.event_contact && fields.event_contact.valid }">
  <label for="event_contact" class="form-label" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{
    trans('admin.event.columns.event_contact') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.event_contact" class="form-control"
      :class="{'form-control-danger': errors.has('event_contact'), 'form-control-success': fields.event_contact && fields.event_contact.valid}"
      id="event_contact" name="event_contact"
      placeholder="{{ trans('admin.event.columns.event_contact') }}"
      value="{{ $event ? $event->event_contact : '' }}">
  </div>
</div>

<div class="mb-3"
  :class="{'has-danger': errors.has('event_available_tickets'), 'has-success': fields.event_available_tickets && fields.event_available_tickets.valid }">
  <label for="event_available_tickets" class="form-label" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{
    trans('admin.event.columns.event_available_tickets') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.event_available_tickets" class="form-control"
      :class="{'form-control-danger': errors.has('event_available_tickets'), 'form-control-success': fields.event_available_tickets && fields.event_available_tickets.valid}"
      id="event_available_tickets" name="event_available_tickets"
      placeholder="{{ trans('admin.event.columns.event_available_tickets') }}"
      value="{{ $event ? $event->event_available_tickets : '' }}">
  </div>
</div>

<div class="mb-3"
  :class="{'has-danger': errors.has('event_ticket_amount'), 'has-success': fields.event_ticket_amount && fields.event_ticket_amount.valid }">
  <label for="event_ticket_amount" class="form-label" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{
    trans('admin.event.columns.event_ticket_amount') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.event_ticket_amount" class="form-control"
      :class="{'form-control-danger': errors.has('event_ticket_amount'), 'form-control-success': fields.event_ticket_amount && fields.event_ticket_amount.valid}"
      id="event_ticket_amount" name="event_ticket_amount"
      placeholder="{{ trans('admin.event.columns.event_ticket_amount') }}"
      value="{{ $event ? $event->event_ticket_amount : '' }}">
  </div>
</div>

<div class="mb-3"
  :class="{'has-danger': errors.has('event_ticket_discount_amount'), 'has-success': fields.event_ticket_discount_amount && fields.event_ticket_discount_amount.valid }">
  <label for="event_ticket_discount_amount" class="form-label" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{
    trans('admin.event.columns.event_ticket_discount_amount') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.event_ticket_discount_amount" class="form-control"
      :class="{'form-control-danger': errors.has('event_ticket_discount_amount'), 'form-control-success': fields.event_ticket_discount_amount && fields.event_ticket_discount_amount.valid}"
      id="event_ticket_discount_amount" name="event_ticket_discount_amount"
      placeholder="{{ trans('admin.event.columns.event_ticket_discount_amount') }}"
      value="{{ $event ? $event->event_ticket_discount_amount : '' }}">
  </div>
</div>

<div class="form-check row"
  :class="{'has-danger': errors.has('active'), 'has-success': fields.active && fields.active.valid }">
  <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
    <input class="form-check-input" id="active" type="checkbox" v-model="form.active"
      data-vv-name="active" name="active_fake_element" {{ $event&&$event->active == '1'?'checked':'' }}>
    <label class="form-check-label" for="active">
      {{ trans('admin.event.columns.active') }}
    </label>
    <input type="hidden" name="active" :value="form.active">
  </div>
</div>


