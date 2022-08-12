<?php

namespace App\Http\Controllers\Front;

use DamianPhp\Validation\Validator;
use App\Http\Controllers\Controller;

/**
 * Example of a Controller for a pages.
 */
class PageController extends Controller
{
    public function home()
    {
        return $this->view('front/home', [
            'title' => 'Home title',
        ]);
    }

    public function contact()
    {
        return $this->view('front/contact', [
            'title' => 'Contact title',
        ]);
    }

    public function postContact(Validator $validator)
    {
        $validator->rules([]); // Add your valisation rules in the array.

        if ($validator->isValid()) {
            // If the form is valid, process the success here.
        } else {
            // $validator->getErrorsHtml() // Return validation errors in HTML format.
            // $validator->getErrorsJson() // Return validation errors in JSON format.
        }
    }
}
