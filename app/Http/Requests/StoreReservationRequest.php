<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'content' => ['max:200'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required', 'after_or_equal:10:00'],
            'end_time' => ['required', 'after:start_time', 'before_or_equal:20:00'],
        ];
    }
}
