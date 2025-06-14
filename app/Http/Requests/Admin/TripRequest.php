<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TripRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'trip_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'start_lat' => 'required|numeric',
            'start_lng' => 'required|numeric',
            'end_lat' => 'required|numeric',
            'end_lng' => 'required|numeric',
            'total_distance_km' => 'nullable|numeric',
            'purpose' => 'nullable|string|max:255',
            'travel_mode' => 'nullable|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'trip_date.required' => 'The trip date is required.',
            'trip_date.date' => 'The trip date must be a valid date.',

            'start_time.required' => 'The start time is required.',
            'start_time.date_format' => 'The start time must be in HH:MM format.',

            'end_time.required' => 'The end time is required.',
            'end_time.date_format' => 'The end time must be in HH:MM format.',
            'end_time.after_or_equal' => 'The end time must be at or after the start time.',

            'start_lat.required' => 'The starting latitude is required.',
            'start_lat.numeric' => 'The starting latitude must be a number.',

            'start_lng.required' => 'The starting longitude is required.',
            'start_lng.numeric' => 'The starting longitude must be a number.',

            'end_lat.required' => 'The ending latitude is required.',
            'end_lat.numeric' => 'The ending latitude must be a number.',

            'end_lng.required' => 'The ending longitude is required.',
            'end_lng.numeric' => 'The ending longitude must be a number.',

            'total_distance_km.numeric' => 'The distance must be a number.',

            'purpose.string' => 'The purpose must be a string.',
            'purpose.max' => 'The purpose may not be greater than 255 characters.',

            'travel_mode.string' => 'The mode of travel must be a string.',
            'travel_mode.max' => 'The mode of travel may not be greater than 100 characters.',
        ];
    }
}
