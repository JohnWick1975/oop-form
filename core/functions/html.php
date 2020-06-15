<?php
/**
 * Generating attributes from an array
 *
 * @param array $form
 * @return string
 */
function html_attr(array $form): string
{
    $line = '';
    foreach ($form as $key => $item) {
        $line .= "$key=\"$item\" ";
    }
    return $line;
}

/**
 * Generating attributes from an array for input tags
 *
 * @param string index from array $fields_id
 * @param array $field
 * @return string
 */
function input_attr($field_id, $field): string
{
    $attr = [
            'name' => $field_id,
            'type' => $field['type'],
            'value' => $field['value'] ?? '',
        ] + ($field['extra']['attr'] ?? []);

    return html_attr($attr);
}

/**
 * Generating attributes from an array for button tags
 *
 * @param string index from array $button_id
 * @param array $button
 * @return string
 */
function button_attr($button_id, $button): string
{
    $attr = [
            'value' => $button_id,
            'name' => 'action',
            'title' => $button['title']
        ] + ($button['extra']['attr'] ?? []);

    return html_attr($attr);
}

/**
 * Generating attributes from an array for select tags
 *
 * @param string index from array $select_id
 * @param array $select
 * @return string
 */
function select_attr($select_id, $select): string
{
    $attr = [
        'name' => $select_id,
        'type' => $select['type'],
    ];

    return html_attr($attr);
}

/**
 * Generating attributes from an array for option tags
 *
 * @param string $option_id index from array
 * @param array $field
 * @return string
 */
function option_attr($option_id, $field): string
{
    $attr = [
        'value' => $option_id
    ];

    if (isset($field['value']) && $field['value'] == $option_id) {
        $attr['selected'] = true;
    }

    return html_attr($attr);
}