<x-app-layout>

    <!-- App body starts -->
    <div class="app-body">

        <!-- Container starts -->
        <div class="container">

            <!-- Row start -->
            <div class="row gx-3">
                <div class="col-12">
                    <!-- Breadcrumb start -->
                    <ol class="breadcrumb mb-3">
                        <li class="breadcrumb-item">
                            <i class="icon-house_siding lh-1"></i>
                            <a href="index.html" class="text-decoration-none">Home</a>
                        </li>
                        <li class="breadcrumb-item">Invoice</li>
                        <li class="breadcrumb-item">Create New Invoice</li>
                    </ol>
                    <!-- Breadcrumb end -->
                </div>
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gx-3">
                <div class="col-xxl-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">Invoice</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <!-- Row start -->
                                <div class="row gx-3">
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Invoice No:</label>
                                            <input type="text" class="form-control" disabled
                                                value="{{ $invoice_no }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" placeholder="Enter name" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Date</label>
                                            <input type="date" class="form-control" value="{{ $date }}" />
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-3">

                                            <table id="my_data_table_material" name="my_data_table_material"
                                                class="table table-bordered table-striped table-hover table-responsive ">
                                                <colgroup>
                                                    <col style="width: 20%;">
                                                    <col style="width: 27%;">
                                                    <col style="width: 10%;">
                                                    <col style="width: 10%;">
                                                    <col style="width: 10%;">
                                                    <col style="width: 3%;">
                                                </colgroup>

                                                <thead class="form-group-sm">
                                                    <tr>
                                                        <th>Item</th>
                                                        <th>Item Description</th>
                                                        <th>Qty</th>
                                                        <th>Rate</th>
                                                        <th>Amount</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    $t1NumRows = 2;

                                                    for ($i = 0; $i < $t1NumRows; $i++) {

                                                    ?> <tr id="tr<?php echo $i; ?>">
                                                        <td>
                                                            <select name="t1_item<?php echo $i; ?>"
                                                                id="t1_item<?php echo $i; ?>" class="form-control"
                                                                onchange="getItemData('1','<?php echo $i; ?>');"
                                                                style="width: 100%;">
                                                                <option></option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <textarea name="t1_desc<?php echo $i; ?>" id="t1_desc<?php echo $i; ?>" class="form-control-sm" rows="1"
                                                                style="width:100%;height:28px;font-size: 9;padding: 0;"></textarea>
                                                        </td>
                                                        <td><input name="t1_qty<?php echo $i; ?>"
                                                                id="t1_qty<?php echo $i; ?>" type="number"
                                                                step="any" min="0" class="form-control-sm"
                                                                value=""
                                                                style="width: 100%;height:30px;text-align: center;"
                                                                onchange="calAmount('1','<?php echo $i; ?>');"></td>
                                                        <td><input name="t1_rate<?php echo $i; ?>"
                                                                id="t1_rate<?php echo $i; ?>" type="text"
                                                                step="any" class="form-control-sm formatNumber"
                                                                value=""
                                                                style="width: 100%;height:30px;text-align: right;"
                                                                onchange="calAmount('1','<?php echo $i; ?>');"></td>
                                                        <td><input name="t1_amount<?php echo $i; ?>"
                                                                id="t1_amount<?php echo $i; ?>" type="text"
                                                                class="form-control-sm formatNumber" value=""
                                                                style="width: 100%;height:30px;text-align: right;"></td>
                                                        <td class="text-blue text-center"> <button
                                                                class="btn btn-outline-danger btn-sm"
                                                                onclick="deleteTableRow('my_data_table_material','<?php echo $i; ?>')"><i
                                                                    class="icon-trash"></i></button></td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="4" style="text-align: right">
                                                            <label style="text-align: right" class="">Sub Total
                                                                &nbsp;</label>
                                                        </td>
                                                        <td><input name="t1_sub_total" id="t1_sub_total" type="text"
                                                                readonly class="form-control-sm" value=""
                                                                style="width: 100%;height:30px;text-align: right;background-color: #eee;border-width: 1px;">
                                                        </td>
                                                        <td colspan="1"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6" class="text-right">
                                                            <button type="button" onclick="addNewLineT1();"
                                                                class="btn btn-sm btn-success "><i
                                                                    class="fa fa-eraser"></i> Add Lines</button>
                                                        </td>
                                                    </tr>
                                                </tfoot>

                                            </table>

                                            <input type="hidden" id="t1NumRows" name="t1NumRows"
                                                value="<?php echo $t1NumRows; ?>">

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Weight</label>
                                            <input type="number" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Price per 1kg</label>
                                            <input type="text" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Discount Amount</label>
                                            <input type="text" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Total</label>
                                            <input type="text" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Payment Method</label>
                                            <select class="form-select">
                                                <option value="0">Cash</option>
                                                <option value="1">Card</option>
                                                <option value="2">Bank Transfer</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Message</label>
                                            <textarea class="form-control" placeholder="Enter Note" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="d-flex gap-2 justify-content-end">
                                            <button type="button" class="btn btn-success col-3">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Row end -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

        </div>
        <!-- Container ends -->

    </div>
    <!-- App body ends -->
    <script>
        // Delete rows ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        function deleteTableRow(tableID, rownum) {
            $('#' + tableID + ' tbody #tr' + rownum).closest('tr').remove();
        }
        // Add rows ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        function addNewLineT1() {
            var item_row = parseInt(document.getElementById("t1NumRows").value);

            var table = document.querySelector('#my_data_table_material tbody');
            var row = table.insertRow(table.rows.length);

            row.id = "tr" + item_row;

            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);

            cell1.innerHTML = `<select name="t1_item` + (item_row) + `" id="t1_item` + (item_row) +
                `" class="form-control selectize" onchange="getItemData('1','` + (item_row) + `');" style="width: 100%;">
                            <option></option>
                           </select>`;
            cell2.innerHTML = `<textarea name="t1_desc` + (item_row) + `" id="t1_desc` + (item_row) +
                `" class="form-control-sm" rows="1" style="width:100%;height:28px;font-size: 9;padding: 0;"></textarea>`
            cell3.innerHTML = `<input name="t1_qty` + (item_row) + `" id="t1_qty` + (item_row) +
                `" type="number" step="any" min="0" class="form-control-sm" style="width: 100%;height:30px;text-align: center;" onchange="calAmount('1','` +
                (item_row) + `');">`;
            cell4.innerHTML = `<input name="t1_rate` + (item_row) + `" id="t1_rate` + (item_row) +
                `" type="text" step="any" class="form-control-sm formatNumber" style="width: 100%;height:30px;text-align: right;" onchange="calAmount('1','` +
                (item_row) + `');">`;
            cell5.innerHTML = `<input name="t1_amount` + (item_row) + `" id="t1_amount` + (item_row) +
                `" type="text" class="form-control-sm formatNumber" style="width: 100%;height:30px;text-align: right;">`;
            cell6.innerHTML =
                `<button class="btn btn-outline-danger btn-sm" onclick="deleteTableRow('my_data_table_material','` + (
                    item_row) + `')"><i class="icon-trash"></i></button>`;
            cell6.className = "text-blue text-center";

            document.getElementById("t1NumRows").value = item_row + 1;

        };
    </script>
</x-app-layout>
