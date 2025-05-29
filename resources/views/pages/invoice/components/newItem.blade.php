{{--  <tbody>
    <?php
    $t1NumRows = 1;

    for ($i = 0; $i < $t1NumRows; $i++) {

    ?> <tr id="tr<?php echo $i; ?>">
        <td>
            <select name="t1_item<?php echo $i; ?>"
                id="t1_item<?php echo $i; ?>"
                class="form-control form-control-sm"
                onchange="getItemData('1','<?php echo $i; ?>');"
                style="width: 100%;">
                <option>a</option>
            </select>
        </td>
        <td>
            <textarea name="t1_desc<?php echo $i; ?>" id="t1_desc<?php echo $i; ?>" class="form-control form-control-sm"
                rows="1" style="width:100%;height:28px;font-size: 9;padding: 0;"></textarea>
        </td>
        <td><input name="t1_weight<?php echo $i; ?>"
                id="t1_weight<?php echo $i; ?>" type="number"
                step="any" min="0"
                class="form-control form-control-sm" value=""
                style="width: 100%;height:30px;text-align: center;"
                onchange="calAmount('1','<?php echo $i; ?>');"></td>
        <td><input name="t1_unit_price<?php echo $i; ?>"
                id="t1_unit_price<?php echo $i; ?>" type="text"
                step="any"
                class="form-control form-control-sm formatNumber"
                value=""
                style="width: 100%;height:30px;text-align: right;"
                onchange="calAmount('1','<?php echo $i; ?>');"></td>
        <td><input name="t1_amount<?php echo $i; ?>"
                id="t1_amount<?php echo $i; ?>" type="text"
                class="form-control form-control-sm formatNumber"
                value=""
                style="width: 100%;height:30px;text-align: right;"
                disabled></td>
        <td class="text-blue text-center"> <button
                class="btn btn-outline-danger btn-sm"
                onclick="deleteTableRow('my_data_table_material','<?php echo $i; ?>')"><i
                    class="icon-trash"></i></button></td>
    </tr>
    <?php
    }
    ?>
</tbody>  --}}
