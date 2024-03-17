<?php

namespace App\Http\Requests\Admin\EventsOrder;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreEventsOrder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.events-order.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'booking_user_id' => ['required', 'string'],
            'event_user_id' => ['required', 'string'],
            'event_id' => ['required', 'string'],
            'no_of_booking' => ['required', 'integer'],
            'booking_unit_amount' => ['required', 'numeric'],
            'applicable_tax_amount' => ['required', 'numeric'],
            'booking_total_amount' => ['required', 'numeric'],
            'points_used' => ['required', 'integer'],
            'booking_payable_amount' => ['required', 'numeric'],
            'status' => ['required', 'string'],
            
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
