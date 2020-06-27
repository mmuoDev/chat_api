<?php

namespace App\Http\Requests;

use App\Rules\ValidateUsername;
use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'receiver_username' => ['required', 'string', 'exists:users,username'],
            'message' => 'required|string'
        ];
    }

    public function getData()
    {
        $validated = $this->validated();
        $validated['sender_username'] = $this->user()->username;
        
        return $validated;
    }
}
