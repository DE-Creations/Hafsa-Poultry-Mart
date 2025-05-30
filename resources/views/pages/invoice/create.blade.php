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
                                            <label class="form-label">Invoice No.</label>
                                            <input id="invoice_number" type="text" class="form-control" disabled
                                                value="{{ $invoice_number }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Customer</label>
                                            <select id="customer_id" class="form-control"
                                                onchange="getCustomerBalanceForward();">
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}">{{ $customer->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Date</label>
                                            <input id="invoice_date" type="date" class="form-control"
                                                value="{{ $invoice_date }}" />
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
                                                        <th>Weight (Kg)</th>
                                                        <th>Unit price</th>
                                                        <th>Amount</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>
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
                                                                @foreach ($newInvoiceItems as $newInvoiceItem)
                                                                    <option value="{{ $newInvoiceItem->id }}">
                                                                        {{ $newInvoiceItem->name }}
                                                                    </option>
                                                                @endforeach
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
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3" class="text-right">
                                                            <button type="button" onclick="addNewLineT1();"
                                                                class="btn btn-sm btn-primary "><i
                                                                    class="fa fa-eraser"></i> Add new item</button>
                                                        </td>
                                                        <td style="text-align: right">
                                                            <label style="text-align: right" class="">Sub Total
                                                                &nbsp;</label>
                                                        </td>
                                                        <td><input name="t1_sub_total" id="t1_sub_total"
                                                                type="text" disabled
                                                                class="form-control form-control-sm" value="0.00"
                                                                style="width: 100%;height:30px;text-align: right;background-color: #eee;border-width: 1px;">
                                                        </td>
                                                        <td colspan="1"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>

                                            <input type="hidden" id="t1NumRows" name="t1NumRows"
                                                value="<?php echo $t1NumRows; ?>">

                                        </div>
                                    </div>

                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Message</label>
                                                    <textarea class="form-control" placeholder="Enter Note" rows="12"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Discount Amount</label>
                                                    <input type="text" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Total</label>
                                                    <input type="text" class="form-control" name="t1_total"
                                                        id="t1_total" disabled />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Balance Forward</label>
                                                    <input type="text" class="form-control" name="t1_pre_bal_for"
                                                        id="t1_pre_bal_for" disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">To Pay</label>
                                                    <input type="text" class="form-control" disabled />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-12"></div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Payment</label>
                                                    <input type="text" class="form-control"
                                                        id="paid_amount"value="0.00"
                                                        onchange="calculateNewBalance();" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-12"></div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Balance</label>
                                                    <input type="text" class="form-control" id="new_balance"
                                                        disabled />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <div class="d-flex gap-2 justify-content-end">
                                            <button type="button" class="btn btn-primary col-3"
                                                onclick="createInvoice()">
                                                Create
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
            calculateSubTotalWhenDeleteRow();
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
                `" class="form-control form-control-sm selectize" onchange="getItemData('1','` + (item_row) + `');" style="width: 100%;">
                            <option></option>
                           </select>`;
            cell2.innerHTML = `<textarea name="t1_desc` + (item_row) + `" id="t1_desc` + (item_row) +
                `" class="form-control form-control-sm" rows="1" style="width:100%;height:28px;font-size: 9;padding: 0;"></textarea>`
            cell3.innerHTML = `<input name="t1_weight` + (item_row) + `" id="t1_weight` + (item_row) +
                `" type="number" step="any" min="0" class="form-control form-control-sm" style="width: 100%;height:30px;text-align: center;" onchange="calAmount('1','` +
                (item_row) + `');">`;
            cell4.innerHTML = `<input name="t1_unit_price` + (item_row) + `" id="t1_unit_price` + (item_row) +
                `" type="text" step="any" class="form-control form-control-sm formatNumber" style="width: 100%;height:30px;text-align: right;" onchange="calAmount('1','` +
                (item_row) + `');">`;
            cell5.innerHTML = `<input name="t1_amount` + (item_row) + `" id="t1_amount` + (item_row) +
                `" type="text" class="form-control form-control-sm formatNumber" style="width: 100%;height:30px;text-align: right;">`;
            cell6.innerHTML =
                `<button class="btn btn-outline-danger btn-sm" onclick="deleteTableRow('my_data_table_material','` + (
                    item_row) + `')"><i class="icon-trash"></i></button>`;
            cell6.className = "text-blue text-center";

            document.getElementById("t1NumRows").value = item_row + 1;

        };

        //Create invoice
        async function createInvoice() {
            var invoice_number = document.getElementById("invoice_number").value;
            var invoice_date = document.getElementById("invoice_date").value;
            var customer_id = document.getElementById("customer_id").value;
            var sub_total = parseFloat(document.getElementById("t1_sub_total").value) || 0;
            var total = parseFloat(document.getElementById("t1_total").value) || 0;
            var paid_amount = parseFloat(document.getElementById("paid_amount").value) || 0;
            var balance = parseFloat(document.getElementById("new_balance").value) || 0;

            var items = [];
            var t1NumRows = parseInt(document.getElementById("t1NumRows").value);
            for (var i = 0; i < t1NumRows; i++) {
                var item = {
                    item_name: document.getElementById("t1_item" + i).value,
                    description: document.getElementById("t1_desc" + i).value,
                    weight: parseFloat(document.getElementById("t1_weight" + i).value) || 0,
                    unit_price: parseFloat(document.getElementById("t1_unit_price" + i).value) || 0,
                    amount: parseFloat(document.getElementById("t1_amount" + i).value) || 0
                };
                items.push(item);
            }

            add_invoice_details = {
                invoice_number: invoice_number,
                invoice_date: invoice_date,
                customer_id: customer_id,
                subtotal: sub_total,
                total: total,
                paid_amount: paid_amount,
                balance: balance,
                items: items
            }

            try {
                const response = await axios.post("{{ url('/invoice/store') }}/",
                    add_invoice_details);
                window.location.reload();
            } catch (error) {
                viewAddErrors(error);
            }
        }

        // calculate amount
        function calAmount(tableId, index) {
            const weight = parseFloat(document.getElementById(`t${tableId}_weight${index}`).value) || 0;
            const unitPrice = parseFloat(document.getElementById(`t${tableId}_unit_price${index}`).value) || 0;
            const amount = weight * unitPrice;

            document.getElementById(`t${tableId}_amount${index}`).value = amount.toFixed(2); // or desired decimal places

            calculateSubTotal(tableId);
            calculateNewBalance();
        }

        function calculateSubTotal(tableId) {
            let subTotal = 0;
            let i = 0;

            while (true) {
                const amountField = document.getElementById(`t${tableId}_amount${i}`);
                if (!amountField) break; // Stop when no more rows

                const amount = parseFloat(amountField.value) || 0;
                subTotal += amount;
                i++;
            }

            // Update the subtotal and total fields
            const subTotalField = document.getElementById(`t${tableId}_sub_total`);

            if (subTotalField) subTotalField.value = subTotal.toFixed(2);

            calculateTotal();
        }

        //calculate total, balance+sub total
        function calculateTotal() {
            const balance = parseFloat(document.getElementById("t1_pre_bal_for").value) || 0;
            const subTotal = parseFloat(document.getElementById("t1_sub_total").value) || 0;
            const total = balance + subTotal;

            document.getElementById("t1_total").value = total.toFixed(2);
        }

        function calculateSubTotalWhenDeleteRow() {
            //calculate amount for each row with getting table amount fields
            let subTotal = 0;
            let i = 0;
            for (i = 0; true; i++) {
                const amountField = document.getElementById(`t${tableId}_amount${i}`);
                if (!amountField) break; // Stop when no more rows
                const amount = parseFloat(amountField.value) || 0;
                subTotal += amount;
            }
            // Update the subtotal and total fields
            const subTotalField = document.getElementById("t1_sub_total");

            if (subTotalField) subTotalField.value = subTotal.toFixed(2);
            calculateTotal();
        }

        function calculateNewBalance() {
            const total = parseFloat(document.getElementById("t1_total").value) || 0;
            const paidAmount = parseFloat(document.getElementById("paid_amount").value) || 0;
            const newBalance = total - paidAmount;

            document.getElementById("new_balance").value = newBalance.toFixed(2);
        }

        function getItemData() {
            //show unit price when select an item
        }

        async function getCustomerBalanceForward() {
            const customerId = document.getElementById("customer_id").value;
            try {
                const response = await axios.get("{{ url('/invoice/customer/balance') }}/" + customerId);
                console.log(response.data);
                document.getElementById("t1_pre_bal_for").value = parseFloat(response.data).toFixed(2);
                //calculateTotal();
            } catch (error) {
                console.error("Error fetching customer balance forward:", error);
            }

            calculateTotal();
            calculateNewBalance();
        }

        window.addEventListener('load', () => {
            getCustomerBalanceForward();
        });
    </script>
</x-app-layout>
