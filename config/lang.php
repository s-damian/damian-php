<?php

/*
|--------------------------------------------------------------------------
| Language configuration: Localization and internationalization.
|
| # If you want to enable internationalization:
| - You have to configure 'languages_allowed'
| - You have to pass 'internationalization' to true
| - You have to uncomment 'address_structure' and configure it
|
| ## If you specify 'domain' at 'address_structure':
| - You have to uncomment 'extension_languages' and configure it
|
| ## If you specify 'domain_and_subdomain' to 'address_structure':
| - You have to uncomment 'extension_international' and configure it
|--------------------------------------------------------------------------
*/

return [

    /**
     * Lang (localization) by default.
     * (its value must imperatively be in 'languages_allowed')
     * Supported: 'fr', 'en'.
     *
     * string
     */
    'default' => 'fr',

    /**
     * Authorized languages.
     * The key: the whole word. The value: the Lang.
     *
     * associative array
     */
    'languages_allowed' => ['Français'=>'fr'],
    //'languages_allowed' => ['Français'=>'fr', 'English'=>'en'],

    /**
     * [Optional]
     *
     * To optionally specify the country code to a Lang (useful for attr "lang", "hreflang", etc.).
     * The key: the country. The value: the Lang.
     * PS: We are not obliged to meter 'key'=>'value' (that the value is enough).
     * If the country is not specified for all Langs, by default it will be the locale that will be specified in the "lang" and "hreflang" attributes.
     *
     * array|associative array
     */
    'countries_languages' => ['fr'=>'FR'],

    /**
     * To optionally enable internationalization
     * (set it to false for phpunit)
     *
     * bool
     */
    'internationalization' => env('APP_ENV') === 'testing' ? false : false,

    /**
     * Choose the form of address structure (URL) to make internationalization work.
     * (only useful if 'internationalization' is true)
     * (you must also modify also in your JS part)
     *
     * - 'domain' - Works with a domain address (URL) structure.
     *    Example: France: domain-name.fr - Spain: domain-name.es
     *
     * - 'subdomain' - Works with a subdomain address (URL) structure.
     *    Example: France: fr.domain-name.com - Spain: es.domain-name.com
     *
     * - 'subdirectories' - Works with a directory address (URL) structure.
     *    Example: France: domain-name.com/fr/ - Spain: domain-name.com/es/
     *
     * - 'domain_and_subdomain' - Works with an address structure (URL) in domain and subdomain for certain versions (which must be specified in 'subdomain_languages').
     *    Example: France: domain-name.fr - USA: domain-name.com - Spain: es.domain-name.com
     *
     * string
     */
    //'address_structure' => 'domain',
    //'address_structure' => 'subdomain',
    //'address_structure' => 'subdirectories',
    //'address_structure' => 'domain_and_subdomain',

    /**
     * To possibly specify the language with which the internationalization is done with the subdomains.
     * (this conf is mandatory and is useful only if 'internationalization' is true, and only if 'address_structure' is equal to 'domain_and_subdomain',
     *  and the language is in 'languages_allowed')
     *
     * string
     */
    //'extension_international' => '.com',

    /**
     * To possibly specify the language in relation to a domain extension. Example: so that ".com" is the "en" version.
     * (is mandatory and is useful only 'internationalization is true, and only 'address_structure' is equal to 'domain' or 'domain_and_subdomain,
     *  and the language is in 'languages_allowed')
     * The key: the extension. The value: the Lang.
     *
     * associative array
     */
    //'extension_languages' => ['.com' => 'en'],

    /**
     * To possibly specify the language in relation to a subdomain. Example: for "es." or the "es" version.
     * (is mandatory and is useful only 'internationalization is true, and only 'address_structure' is equal to 'domain_and_subdomain',
     *  and the language is in 'languages_allowed')
     * The key: the subdomain. The value: the Lang.
     *
     * associative array
     */
    //'subdomain_languages' => ['aus.' => 'en'],
    
];
