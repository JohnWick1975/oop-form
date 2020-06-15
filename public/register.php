<?php

require_once '../bootloader.php';

function form_success(&$form, $form_values)
{
    unset($form_values['password_repeat']);
    App::$db->createTable('users');

    $form_values['password'] = password_hash($form_values['password'], PASSWORD_BCRYPT);

    App::$db->insertRow('users', $form_values);

    $form['success_message'] = 'Successfully registered';
}

/*function form_fail(&$form, $form_values)
{

}*/

$form = [
    'attr' => [
        'action' => 'register.php',
        'method' => 'POST',
        'class' => 'my-form',
        'id' => 'login-form'
    ],
    'fields' => [
        'name' => [
            'validators' => [
                'validate_field_not_empty',
                'validate_field_space'
            ],
            'label' => 'Name',
            'type' => 'text',
            'options' => [
                'male' => 'Kardanas',
                'female' => 'Mova'
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'John Wick'
                ]
            ]
        ],
        'email' => [
            'validators' => [
                'validate_field_not_empty'
            ],
            'label' => 'E-Mail',
            'type' => 'email',
            'extra' => [
                'attr' => [
                    'class' => 'email-field',
                    'placeholder' => 'jonas@gmail.com'
                ]
            ]
        ],
        'password' => [
            'validators' => [
                'validate_field_not_empty',
                'validate_password_uppercase',
                'validate_field_length' =>
                    [
                        'min' => 7,
                        'max' => 14,
                    ]
            ],
            'label' => 'Password',
            'type' => 'password',
            'extra' => [
                'attr' => [
                    'class' => 'password-field',
                    'placeholder' => 'password'
                ]
            ]
        ],
        'password_repeat' => [
            'validators' => [
                'validate_field_not_empty',
                'validate_password_uppercase',
                'validate_field_length' =>
                    [
                        'min' => 7,
                        'max' => 14,
                    ]
            ],
            'label' => 'Repeat-Password',
            'type' => 'password',
            'extra' => [
                'attr' => [
                    'class' => 'password-field',
                    'placeholder' => 'repeat password'
                ]
            ]
        ],
        'age' => [
            'validators' => [
                'validate_field_not_empty',
                'validate_field_is_number',
                'validate_age_range'
            ],
            'label' => 'age',
            'type' => 'text',
            'value' => '30',
            'extra' => [
                'attr' => [
                    'class' => 'name-field',
                    'placeholder' => '...age',
                ]
            ]
        ],
        /*'number1' => [
            'validators' => [
                'validate_field_not_empty',
                'validate_field_is_number',
                'validate_field_range' =>
                    [
                        'min' => 100,
                        'max' => 200,
                    ]
            ],
            'label' => 'input First Number(100 - 200)',
            'type' => 'text',
            'value' => '100',
            'extra' => [
                'attr' => [
                    'class' => 'name-field',
                    'placeholder' => '...first number',
                ]
            ]
        ],
        'number2' => [
            'validators' => [
                'validate_field_not_empty',
                'validate_field_is_number',
                'validate_field_range' =>
                    [
                        'min' => 50,
                        'max' => 100,
                    ]
            ],
            'label' => 'input Second Number(50 - 100)',
            'type' => 'text',
            'value' => '50',
            'extra' => [
                'attr' => [
                    'class' => 'name-field',
                    'placeholder' => '...second number',
                ]
            ]
        ],
        'random_number' => [
            'value' => rand(0, 5),
            'label' => 'random number',
            'type' => 'number',
            'extra' => [
                'attr' => [
                    'readonly' => true,
                ]
            ]
        ],
        'guess_number' => [
            'label' => 'guess the number',
            'type' => 'number',
            'extra' => [
                'attr' => [
                    'placeholder' => '...number from 0 - 5',
                ]
            ]
        ],*/
    ],
    'buttons' => [
        'save' => [
            'title' => 'Join',
            'extra' => [
                'attr' => [
                    'class' => 'big-button'
                ]
            ]
        ]
    ],
    'validators' => [
        'validate_fields_match' => [
            'password',
            'password_repeat'
        ],
        'validate_unique_email'
    ],
    'callbacks' => [
        'success' => 'form_success',
        /*'fail' => 'form_fail'*/
    ]
];


$form_values = sanitize_form_input_values($form);


$result = '';
$message = '';

if ($form_values) {
    $success = validate_form($form, $form_values);
    if ($success) {
        $result = 'Isvada: Skiri ';
    } else {
        $result = 'Isvada: Kvieciam Daktara';
    }
}

/*if ($form_values['random_number'] && $form_values['guess_number']) {
    $num_a = $form_values['random_number'];
    $num_b = $form_values['guess_number'];
    if ($num_a == $num_b) {
        $message = 'you guessed the number!';
    } elseif ($num_b > $num_a) {
        $difference = $num_b - $num_a;
        $message = "the number $difference more than random number";
    } else {
        $difference = $num_a - $num_b;
        $message = "the number $difference less than random number";
    }
}*/


?>
<html lang="en">
    <head>
        <title>PHP</title>
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    </head>
    <body>
        <?php require 'header.php'; ?>
        <main>
            <?php require '../core/templates/form.tpl.php'; ?>
            <p><?php print $message; ?></p>
        </main>
    </body>
</html>
