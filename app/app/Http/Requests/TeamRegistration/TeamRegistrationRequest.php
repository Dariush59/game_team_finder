<?php

namespace App\Http\Requests\TeamRegistration;

use Illuminate\Foundation\Http\FormRequest;

class TeamRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|unique:users|max:255',
            'game' => 'required|string',
            'region' => 'required|int',
            'rank' => 'required',
            'position_ids' => 'required',
            'discord' => 'required',
            'code' => 'required',
            'state' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'email is required',
            'game.required' => 'game is required',
            'region.required' => 'region is required',
            'rank.required' => 'rank is required',
            'position.required' => 'position is required',
        ];
    }
}
