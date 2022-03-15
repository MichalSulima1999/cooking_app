<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'description' => 'required|min:25',
            'ingredients' => 'required',
            'hours' => 'required|numeric|min:0',
            'minutes' => 'required|numeric|min:0|max:60',
            'image' => 'mimes:jpg,png,jpeg,webp|max:5048',
            'meal_id' => 'required|integer|in:1,11,21,31'
        ];
    }
}
