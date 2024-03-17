<?php

namespace App\Http\Requests\Admin\MEventsOrdersStatus;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateMEventsOrdersStatus extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.m-events-orders-status.edit', $this->mEventsOrdersStatus);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'events_orders_status_name' => ['sometimes', Rule::unique('m_events_orders_status', 'events_orders_status_name')->ignore($this->mEventsOrdersStatus->getKey(), $this->mEventsOrdersStatus->getKeyName()), 'string'],
            'active' => ['sometimes', 'boolean'],
            
        ];
    }

    /**
     * Modify input data
     *
     * @return array
     */
    public function getSanitized(): array
    {
        $sanitized = $this->validated();


        //Add your code for manipulation with request data here

        return $sanitized;
    }
}
