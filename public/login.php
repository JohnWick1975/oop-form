<?php

require '../bootloader.php';

function form_success(&$form, $form_values)
{
    $user = App::$db->getRowWhere('users', ['name' => $form_values['name']]);
    $_SESSION['name'] = $form_values['name'];
    $_SESSION['password'] = $user['password'];

    record_session($form_values['name']);

    header('Location: index.php');
}

function record_session($user)
{
    App::$db->createTable('session');
    App::$db->insertRow('session', [
        'user' => $user,
        'timestamp' => strtotime('now'),
        'sess_id' => session_id()
    ]);

}

function form_fail(&$form, $form_values)
{
    $form['error_message'] = 'User does not exist';
}

$form = [
    'attr' => [
        'action' => 'login.php',
        'method' => 'POST',
        'class' => 'login-form',
        'id' => 'login-form'
    ],
    'fields' => [
        'name' => [
            'validators' => [
                'validate_field_not_empty',
                'validate_field_space'
            ],
            'label' => 'Username',
            'type' => 'text',
            'extra' => [
                'attr' => [
                    'placeholder' => 'Enter Username'
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
            'value' => '',
            'extra' => [
                'attr' => [
                    'class' => 'password-field',
                    'placeholder' => 'Enter password',
                ]
            ]
        ],
    ],
    'buttons' => [
        'save' => [
            'title' => 'LOGIN',
            'extra' => [
                'attr' => [
                    'class' => 'big-button'
                ]
            ]
        ]
    ],
    'validators' => [
        'validate_login'
    ],
    'callbacks' => [
        'success' => 'form_success',
        'fail' => 'form_fail'
    ]
];

$form_values = sanitize_form_input_values($form);

if ($form_values) {
    validate_form($form, $form_values);
}

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
        <?php require 'header.php'; ?>
        <main>
            <?php require '../core/templates/form.tpl.php' ?>
        </main>
    </body>
</html>