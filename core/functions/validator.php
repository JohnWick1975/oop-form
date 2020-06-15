<?php
/**
 * Checked user input information, empty or not.
 *
 * @param $field_value
 * @param array $field
 * @return bool
 */
function validate_field_not_empty($field_value, array &$field): bool
{
    if (!$field_value) {
        $field['error'] = 'Input is empty, please, enter some info!';
        return false;
    } else {
        return true;
    }
}

/**
 * Checked user input information, empty or not.
 *
 * @param $field_value
 * @param array $field
 * @return bool
 */
function validate_field_is_number($field_value, array &$field): bool
{
    if (!is_numeric($field_value)) {
        $field['error'] = 'Input is not a number, please, enter number!';
        return false;
    } else {
        return true;
    }
}

/**
 * Checks the range of a value that must be more than 18 and less than 100.
 *
 * @param $field_value
 * @param array $field
 * @return bool
 */
function validate_age_range($field_value, array &$field): bool
{
    if ($field_value > 18 && $field_value < 100) {
        return true;
    } else {
        $field['error'] = 'your age does not meet the requirements';
        return false;
    }
}

/**
 * Checks the value for a space, there must be a space between the name and the surname
 *
 * @param $field_value
 * @param array $field
 * @return bool
 */
function validate_field_space($field_value, array &$field): bool
{
    if (count(explode(' ', trim($field_value))) <= 1) {
        $field['error'] = 'input cant have an empty space between name and surname';
        return false;
    } else {
        return true;
    }
}


/**
 * Checks the range of a value from from array, where $params['min'] is min. number,
 * $params['max'] is max. number
 *
 * @param $field_value
 * @param array $field
 * @param array $params
 * @return bool
 */
function validate_field_range($field_value, array &$field, array $params): bool
{

    if ($field_value >= $params['min'] && $field_value <= $params['max']) {
        return true;
    } else {
        $field['error'] = "the number did not fit into the range from {$params['min']} to {$params['max']}";
        return false;
    }
}

/**
 * Checked password first letter by uppercase
 *
 * @param string $field_value
 * @param array $field
 * @return bool
 */
function validate_password_uppercase(string $field_value, array &$field): bool
{
    if (preg_match('/[A-Z]/', $field_value[0])) {
        return true;
    } else {
        $field['error'] = 'first letter must be uppercase';
        return false;
    }
}

/**
 * Checked field value by characters length, where $params['min'] - minimum length, $params['ax'] - maximum length.
 *
 * @param string $field_value
 * @param array $field
 * @param array $params
 * @return bool
 */
function validate_field_length(string $field_value, array &$field, array $params): bool
{
    if (strlen($field_value) >= $params['min'] && strlen($field_value) <= $params['max']) {
        return true;
    } else {
        $field['error'] = "field must be not shorter than {$params['min']} characters, not longer than {$params['max']}";
        return false;
    }
}

function validate_fields_match($form_values, &$form, $params)
{
    $array_values = [];
    foreach ($params as $key) {
        $array_values[] = $form_values[$key];
    }
    if (count(array_unique($array_values)) <= 1) {
        return true;
    } else {
        foreach ($params as $field_key) {
            $form['fields'][$field_key]['error'] = 'fields do not match';
        }
        return false;
    }
}


/**
 * Checks the user exists in the database
 *
 * @param array $form_values
 * @param array $form
 * @return boolean
 */
function validate_login($form_values, &$form): bool
{
    $user = App::$db->getRowWhere('users', ['name' => $form_values['name']]);

    if ($user && password_verify($form_values['password'], $user['password'])) {
        return true;
    }

    return false;
}

/**
 * Check for exists users by email.
 *
 * @param $form_values
 * @param $form
 * @return bool
 */
function validate_unique_email($form_values, &$form): bool
{
    $email = App::$db->getRowWhere('users', ['email' => $form_values['email']]);
    if ($email) {
        $form['error_message'] = 'User already exists';
        return false;
    }

    return true;
}