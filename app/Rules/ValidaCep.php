<?php

namespace App\Rules;

use App\Services\ViaCEP;
use Illuminate\Contracts\Validation\Rule;

class ValidaCep implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected  ViaCEP $viaCEP;
    public function __construct(
        ViaCEP $viaCEP
    )  {
         $this->viaCEP = $viaCEP;
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
        $cep =  str_replace('-', '', $value);
      return !!  $this->viaCEP->buscar($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'CEP invalido';
    }
}
