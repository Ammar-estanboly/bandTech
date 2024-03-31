<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PriceFormat implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!is_array($value)) {
            return false;
        }

        $allowedKeys = ['normal', 'gold', 'silver'];

        foreach ($value as $key => $price) {
            if (!in_array($key, $allowedKeys) || !is_numeric($price)) {
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
        return 'price format ["normal" => 100, "gold" => 100, "silver" => 100].';
    }
}
