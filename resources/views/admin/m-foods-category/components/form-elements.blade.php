<div class="mb-3"
  :class="{'has-danger': errors.has('food_category_name'), 'has-success': fields.food_category_name && fields.food_category_name.valid }">
  <label for="food_category_name" class="form-label" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{
    trans('admin.m-foods-category.columns.food_category_name') }}</label>
  <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.food_category_name" class="form-control"
      :class="{'form-control-danger': errors.has('food_category_name'), 'form-control-success': fields.food_category_name && fields.food_category_name.valid}"
      id="food_category_name" name="food_category_name"
      placeholder="{{ trans('admin.m-foods-category.columns.food_category_name') }}"
      value="{{ $mFoodsCategory ? $mFoodsCategory->food_category_name : '' }}">
  </div>
</div>

<div class="form-check row"
  :class="{'has-danger': errors.has('active'), 'has-success': fields.active && fields.active.valid }">
  <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
    <input class="form-check-input" id="active" type="checkbox" v-model="form.active"
      data-vv-name="active" name="active_fake_element" {{ $mFoodsCategory&&$mFoodsCategory->active == '1'?'checked':'' }}>
    <label class="form-check-label" for="active">
      {{ trans('admin.m-foods-category.columns.active') }}
    </label>
    <input type="hidden" name="active" :value="form.active">
  </div>
</div>


