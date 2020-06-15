<?php

require '../bootloader.php';

if (!is_logged_in()){
    header('Location: login.php');
}


function form_success(&$form, $form_values)
{
    App::$db->createTable('menu');
    App::$db->insertRow('menu', $form_values);
    $form['success_message'] = 'Successfully registered';
}

function form_fail(&$form, $form_values)
{
    $form['error_message'] = 'Something went wrong';
}

$form = [
    'attr' => [
        'action' => 'menu.php',
        'method' => 'POST',
        'class' => 'my-form',
        'id' => 'menu-form'
    ],
    'fields' => [
        'name' => [
            'validators' => [
                'validate_field_not_empty',
            ],
            'label' => 'Dish Name',
            'type' => 'text',
            'extra' => [
                'attr' => [
                    'placeholder' => 'amar in shrimp sauce'
                ]
            ]
        ],
        'price' => [
            'validators' => [
                'validate_field_not_empty',
                'validate_field_is_number',
                'validate_field_range' =>
                    [
                        'min' => 0,
                        'max' => 1000,
                    ]
            ],
            'label' => 'Dish price',
            'type' => 'number',
            'value' => '',
            'extra' => [
                'attr' => [
                    'class' => 'name-field',
                    'placeholder' => '...price',
                ]
            ]
        ],
    ],
    'buttons' => [
        'save' => [
            'title' => 'Submit',
            'extra' => [
                'attr' => [
                    'class' => 'big-button'
                ]
            ]
        ]
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