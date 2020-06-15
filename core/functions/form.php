<?php
/**
 * Takes a $_POST array sanitize each input value
 *
 * @param array $form
 * @return array
 */
function sanitize_form_input_values($form): ?array
{
    $params = [];

    foreach ($form['fields'] as $key_array => $array) {
        $params[$key_array] = FILTER_SANITIZE_SPECIAL_CHARS;
    }

    return filter_input_array(INPUT_POST, $params);
}

/**
 * Adds error message to form['fields']
 * if submitted form value have an errors.
 *
 * @param array $form
 * @param array $form_values
 * @return bool
 */
function validate_form(array &$form, array $form_values): bool
{
    $is_valid = true;

    //Fields validation

    foreach ($form['fields'] as $field_id => &$field) {

        $field['value'] = $form_values[$field_id];

        foreach ($field['validators'] ?? [] as $validator_key => $validator) {
            // Dinamiskai kvieciam validacijos funkcija
            // pvz.: $validator_function = validate_field_not_empty() funkcijai

            if (is_array($validator)) {
                $validator_function = $validator_key;
                $params = $validator;
            } else {
                $validator_function = $validator;
            }

            $field_is_valid = $validator_function($field['value'], $field, $params ?? null);

            if (!$field_is_valid) {
                $is_valid = false;
                break;
            }
        }
    }

    //Form validation

    foreach ($form['validators'] ?? [] as $key => $validator) {
        if (is_array($validator)) {
            $validator_function = $key;
            $params = $validator;
        } else {
            $validator_function = $validator;
        }

        $form_is_valid = $validator_function($form_values, $form, $params ?? null);

        if (!$form_is_valid) {
            $is_valid = false;
            break;
        }
    }

    if ($is_valid) {
        if (isset($form['callbacks']['success'])) {
            $form['callbacks']['success']($form, $form_values);
        }
    } else {
        if (isset($form['callbacks']['fail'])) {
            $form['callbacks']['fail']($form, $form_values);
        }
    }

    return $is_valid;
}
