<table class="<?php print $table['attr']['class'] ?? '' ?>">
    <thead>
        <tr>
            <?php foreach ($table['headings'] ?? [] as $name) : ?>
            <th><?php print $name; ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($table['rows'] ?? [] as $data_array) : ?>
        <tr>
            <?php foreach ($data_array as $data) : ?>
            <td><?php print $data; ?></td>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
