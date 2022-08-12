<?php

/**
 * Validation - English
 */

return [

    /**
     * Validation success message
     */
    'success_message' => 'The form has been validated.',

    /**
     * Validation error messages
     */
    'alpha' => 'The "{field}" field must contain only alphabetical characters without accents and without special characters.',
    'alpha_numeric' => 'The "{field}" field must contain only alphanumeric characters.',
    'confirm' => 'Field "{field}" and "Confirmation of {field}" should be identical.',
    'between' => 'The "{field}" field must have a value between {value_0} and {value_1}.',
    'date_time_not_after_now' => 'The "{field}" field cannot be after current date.',
    'empty' => 'The "{field}" field must remain empty.',
    'format_date' => 'The "{field}" field must have the value the format of a date (jj/mm/aaaa).',
    'format_date_time' => 'The "{field}" field must have the value the format of a date/hour (example: 05/09/2016 18:56).',
    'format_email' => 'The "{field}" field must have the value the format of a email address.',
    'format_ip' => 'The "{field}" field must have the value the format of a IP address.',
    'format_name_file' => 'A file name can not contain space, special character, or the following characters: \ / : * ? " < > |',
    'format_postal_code' => 'The "{field}" field must have value as the format of a postal code.',
    'format_slug' => 'The "{field}" field is not the right format.',
    'format_tel' => 'The "{field}" field must have the value the format of a Phone number.',
    'format_url' => 'The "{field}" field must have the format of a URL.',
    'integer' => 'The "{field}" field must be an integer.',
    'in_array' => 'The selected option is not valid in the "{field}" field.',
    'max' => 'The "{field}" field must not exceed {value} characteres.',
    'min' => 'The "{field}" field must not be less than {value} characteres.',
    'name_directory_unique_in_directory' => 'Name of "{field}" is already taken by another directory in this directory.',
    'name_file_unique_in_directory' => 'Name of "{field}" is already taken by another file in this directory.',
    'no_regex' => 'The "{field}" field must not have value in a format with the regex "{value}"',
    'not_in_array' => 'The "{field}" field is invalid',
    'password_current_ok' => 'Password entered incorrect!',
    'regex' => 'The "{field}" field must have value as a format with the regex "{value}"',
    'required' => 'The "{field}" field is required.',
    'unique' => 'Le "{field}" field is already taken, and it must be unique.',
    'unique_not_in_array' => 'Le "{field}" field is already taken, and it must be unique.',

    /**
     * Messages d'erreurs des validations pour les uploads
     */
    'file' => [
        'error' => 'Error(s) with the upload of "{field}":',
        'extension_audio' => 'The extension of "{field}" should be an extension of an audio.',
        'extension_doc' => 'The extension of "{field}" should be an extension of an document.',
        'extension_file' => 'The extension of "{field}" not allowed !',
        'extension_image' => 'The extension of "{field}" must be a extension of picture.',
        'extension_video' => 'The extension of "{field}" should be an extension of an video.',
        'format_name' => 'A file name can not contain space, special character, or the following characters: \ / : * ? " < > |',
        'max_length_name' => 'The name of "{field}" must not exceed {value__max_length_name} characteres.',
        'max_size' => 'The weight of "{field}" must not be supperior {value__max_size} to bytes.',
        'name_not_taken' => 'This name is already taken by another file in this directory.',  
        'required' => 'You must select an file.',
        'specific_name' => 'The file must be named "{value__specific_name}".',
        'upload_canceled' => 'The upload has been donated entirely canceled.',
        'upload_err_nofile' => 'No file was uploaded.',
        'upload_err_size' => 'The file size exceeded limit.',
    ],

    /**
     * Custom validation attributes
     */
    'labels' => [
        "first_name" => "First Name",
        "last_name" => "Last Name",
    ],
    
];
