<?php

namespace App\Providers;

use DamianPhp\Validation\Validator;
use DamianPhp\Support\Facades\Request;

/**
 * Validator Service Provider.
 */
class ValidatorServiceProvider
{
    /**
     * Function called when the application starts.
     */
    public function boot(): void
    {
        if (env('APP_ENV') === 'testing' || Request::isInMethods(['POST', 'PUT', 'PATCH', 'AJAX'])) {
            // - To optionally add a validation rule for a specific treatment.
            // - It is necessary to add the 'rule_name' in "/resources/lang/valodation.php".
            // - $input will be the name of the input.
            // - $value will be the submitted value of the input.
            // - $parameters will be its value specified to the validation rule at 'rule_name'.
            // - Syntax:
            // Validator::extend('rule_name', function ($input, $value, $parameters) {
            //     return (int) $value > (int) $parameters; // Must return a bool.
            // });

            // Strictly equal
            Validator::extend('strictly_equal', function ($input, $value, $parameters) {
                return ((string) $value === (string) $parameters);
            });
        }
    }
}
