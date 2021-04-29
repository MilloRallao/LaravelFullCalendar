<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DNI implements Rule
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
        $letra = substr($value, -1);
	    $numeros = (int) substr($value, 0, -1);
	    if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8 ){
		    return true;
	    }else{
		    return false;
	    }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "El campo :attribute no es un dni válido";
    }
}
