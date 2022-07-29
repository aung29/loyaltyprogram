<?php

namespace App\Http\Requests;

use App\Rules\AdminPasswordRule;
use App\Rules\AdminUsernameRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class AdminLoginValidation extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        Log::channel('adminlog')->info('AdminLoginValidation', [
            'start rules'
        ]);

        Log::channel('adminlog')->info('AdminLoginValidation', [
            'end rules'
        ]);

        return [
            'name' => ['required', new AdminUsernameRule()],
            'password' => ['required', new AdminPasswordRule()]
        ];
    }
}
