<?php

namespace App\Rules;

use App\Models\M_Card;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;

class CardRule implements Rule
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
        $card = new M_Card();
        $cards = $card->checkCard($value);
       
        if($cards !== null ){
            if($cards->card_id ==  $value){
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The card is already registered!';
    }
}
