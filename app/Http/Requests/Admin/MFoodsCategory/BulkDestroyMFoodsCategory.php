<?php

namespace App\Http\Requests\Admin\MFoodsCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class BulkDestroyMFoodsCategory extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.m-foods-category.bulk-delete');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'ids.*' => 'integer'
        ];
    }
}
