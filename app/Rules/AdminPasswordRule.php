<?php

namespace App\Rules;

use App\Models\M_Login;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;

class AdminPasswordRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        Log::channel('adminlog')->info('AdminPasswrodRule', [
            'start passes'
        ]);
        $username = session()->get('name');

        $checkAccount = new M_Login();
        $hasAccount = $checkAccount->checkPassword($username, $value);

        if ($hasAccount !== null) {
            session()->forget('name');
            $id = $hasAccount->id;
            session([
                'adminId' => $id, 
                'role' => $hasAccount->role,
                'name' => $hasAccount->username,
                'shop' =>$hasAccount->shop_id
            ]);
            $checkAccount->updateLoginTime($id);

            Log::channel('adminlog')->info('AdminPasswrodRule', [
                'end passes'
            ]);

            return true;
        }
        Log::channel('adminlog')->info('AdminPasswrodRule', [
            'end passes'
        ]);

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Your Password is wrong';
    }
}
