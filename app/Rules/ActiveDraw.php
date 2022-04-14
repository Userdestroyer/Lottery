<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Draw;

class ActiveDraw implements Rule
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
        return Draw::where([
            ['type_id', $value],
            ['is_played', '0']
        ])->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'There is no active draws of this type';
    }
}
