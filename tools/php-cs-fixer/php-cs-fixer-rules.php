<?php

// DOC :
// https://cs.symfony.com/doc/rules/index.html
// https://cs.symfony.com/doc/ruleSets/index.html

return [
    '@PSR12' => true,
    'array_syntax' => ['syntax' => 'short'],
    'blank_line_before_statement' => [
        'statements' => ['break', 'continue', 'declare', 'exit', 'return', 'throw', 'try'],
    ],
    'class_attributes_separation' => [
        'elements' => ['const' => 'one', 'method' => 'one', 'property' => 'one'],
    ],
    'no_extra_blank_lines' => [
        'tokens' => ['curly_brace_block', 'extra', 'use'],
    ],
    'no_multiline_whitespace_around_double_arrow' => true,
    'no_spaces_around_offset' => true,
    'no_whitespace_before_comma_in_array' => true,
    'no_whitespace_in_blank_line' => true,
    'not_operator_with_successor_space' => true,
    'object_operator_without_whitespace' => true,
    'ordered_class_elements' => [
        'order' => [
            'use_trait',
            'case',
            'constant',
            'constant_public',
            'constant_protected',
            'constant_private',
            'property',
            'property_static',
            'property_public',
            'property_protected',
            'property_private',
            'property_public_readonly',
            'property_protected_readonly',
            'property_private_readonly',
            'property_public_static',
            'property_protected_static',
            'property_private_static',
            'construct',
            'destruct',
            'magic',
            'phpunit',
            'method_abstract',
            'method',
        ]
    ],
    'space_after_semicolon' => true,
    'strict_comparison' => false,
    'ternary_operator_spaces' => true,
    'trim_array_spaces' => true,
    'unary_operator_spaces' => false,
    'whitespace_after_comma_in_array' => true,
];
