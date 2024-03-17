<?php

namespace App\Http\Requests\Admin\EventsOrder;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateEventsOrder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.events-order.edit', $this->eventsOrder);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'booking_user_id' => ['sometimes', 'string'],
            'event_user_id' => ['sometimes', 'string'],
            'event_id' => ['sometimes', 'string'],
            'no_of_booking' => ['sometimes', 'integer'],
            'booking_unit_amount' => ['sometimes', 'numeric'],
            'applicable_tax_amount' => ['sometimes', 'numeric'],
            'booking_total_amount' => ['sometimes', 'numeric'],
            'points_used' => ['sometimes', 'integer'],
            'booking_payable_amount' => ['sometimes', 'numeric'],
            'status' => ['sometimes', 'string'],
            
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
