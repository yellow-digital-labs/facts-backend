<?php

namespace App\Http\Requests\Admin\Event;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreEvent extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.event.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'string'],
            'event_categories_id' => ['required', 'string'],
            'event_name' => ['required', 'string'],
            'event_start_datetime' => ['required', 'date'],
            'event_end_datetime' => ['required', 'date'],
            'event_description' => ['required', 'string'],
            'event_primary_image' => ['required', 'string'],
            'event_location' => ['required', 'string'],
            'event_contact' => ['required', 'string'],
            'event_available_tickets' => ['required', 'integer'],
            'event_ticket_amount' => ['required', 'integer'],
            'event_ticket_discount_amount' => ['required', 'integer'],
            'active' => ['required', 'boolean'],
            
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
