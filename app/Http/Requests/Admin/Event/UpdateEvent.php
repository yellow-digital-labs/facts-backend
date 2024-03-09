<?php

namespace App\Http\Requests\Admin\Event;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateEvent extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.event.edit', $this->event);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_id' => ['sometimes', 'string'],
            'event_categories_id' => ['sometimes', 'string'],
            'event_name' => ['sometimes', 'string'],
            'event_start_datetime' => ['sometimes', 'date'],
            'event_end_datetime' => ['sometimes', 'date'],
            'event_description' => ['sometimes', 'string'],
            'event_primary_image' => ['sometimes', 'string'],
            'event_location' => ['sometimes', 'string'],
            'event_contact' => ['sometimes', 'string'],
            'event_available_tickets' => ['sometimes', 'integer'],
            'event_ticket_amount' => ['sometimes', 'integer'],
            'event_ticket_discount_amount' => ['sometimes', 'integer'],
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
