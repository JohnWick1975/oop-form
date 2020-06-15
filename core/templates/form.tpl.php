
<form <?php print html_attr($form['attr'] ?? []); ?>>

<!--DIV with form-submit error/success generating-->
<?php if (isset($form['success_message'])) : ?>
    <div class="notification success"><?php print $form['success_message']; ?></div>
<?php elseif (isset($form['error_message'])) : ?>
    <div class="notification fail"><?php print $form['error_message']; ?></div>
<?php endif; ?>

    <!--Field generation start-->
    <?php foreach ($form['fields'] ?? [] as $field_id => $field) : ?>

        <?php if (isset($field['label'])) : ?>
            <label><?php print $field['label']; ?></label>
        <?php endif; ?>

        <?php if ($field['type'] == 'select') : ?>

            <!--Select tag generation start-->
            <select <?php print select_attr($field_id, $field) ?>>

                <!--Option tag generation -->
                <?php foreach ($field['options'] ?? [] as $option_id => $option_title) : ?>
                    <option <?php print option_attr($option_id, $field); ?>>
                        <?php print $option_title ?>
                    </option>
                <?php endforeach; ?>
                <!--Option tag generation end-->

            </select>
            <!--Select tag generation end -->

        <?php else: ?>

            <!--Input tag generation-->
            <input <?php print input_attr($field_id, $field) ?>>

        <?php endif; ?>

        <!-- Field error generation-->
        <?php if (isset($field['error'])) : ?>
            <div class="error"><?php print $field['error']; ?></div>
        <?php endif; ?>


    <?php endforeach; ?>
    <!--Field generation end-->

    <!--Button generation start-->
    <?php foreach ($form['buttons'] ?? [] as $button_id => $button) : ?>
        <button <?php print button_attr($button_id, $button); ?>><?php print $button['title'] ?></button>
    <?php endforeach; ?>
    <!--Button generation end-->

</form>
