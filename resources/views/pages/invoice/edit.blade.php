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
                            <h5 class="card-title">Invoice Edit</h5>
                        </div>
                        <div class="card-body">

                            <!-- Row start -->
                            <div class="row gx-3">
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Invoice No.</label>
                                        {{--  <input id="invoice_number" type="text" class="form-control" disabled
                                            value="{{ $invoice_number }}" />  --}}
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Date</label>
                                        {{--  <input id="invoice_date" type="date" class="form-control"
                                            value="{{ $invoice_date }}" />  --}}
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

                                <div class="col-12">
                                    <div class="mb-3">

                                        <table id="invoice_item_table" name="invoice_item_table"
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
                                                            onchange="getItemData(this ,'<?php echo $i; ?>');"
                                                            style="width: 100%;">
                                                            <option value="0">Select</option>
                                                            @foreach ($newInvoiceItems as $newInvoiceItem)
                                                                <option value="{{ $newInvoiceItem->id }}"
                                                                    data-description="{{ e($newInvoiceItem->description) }}"
                                                                    data-unit_price="{{ $newInvoiceItem->unit_price }}">
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
                                                            onchange="calAmount('<?php echo $i; ?>');"></td>
                                                    <td><input name="t1_unit_price<?php echo $i; ?>"
                                                            id="t1_unit_price<?php echo $i; ?>" type="text"
                                                            step="any"
                                                            class="form-control form-control-sm formatNumber"
                                                            value=""
                                                            style="width: 100%;height:30px;text-align: right;"
                                                            onchange="calAmount('<?php echo $i; ?>');"></td>
                                                    <td><input name="t1_amount<?php echo $i; ?>"
                                                            id="t1_amount<?php echo $i; ?>" type="text"
                                                            class="form-control form-control-sm formatNumber"
                                                            value=""
                                                            style="width: 100%;height:30px;text-align: right;" disabled>
                                                    </td>
                                                    <td class="text-center"> <button type="button"
                                                            class="btn btn-outline-danger btn-sm"
                                                            onclick="deleteTableRow('invoice_item_table','<?php echo $i; ?>')"><i
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
                                                            class="btn btn-sm btn-primary "><i class="fa fa-eraser"></i>
                                                            Add new item</button>
                                                    </td>
                                                    <td style="text-align: right">
                                                        <label style="text-align: right" class="">Sub Total
                                                            &nbsp;</label>
                                                    </td>
                                                    <td><input name="t1_sub_total" id="t1_sub_total" type="text"
                                                            disabled class="form-control form-control-sm formatNumber"
                                                            value="0.00"
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
                                                <textarea class="form-control" placeholder="Enter Note" rows="5" id="memo"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <table
                                                    class="table table-bordered table-striped table-hover table-responsive ">
                                                    <colgroup>
                                                        <col style="width: 70%;">
                                                        <col style="width: 30%;">
                                                    </colgroup>

                                                    <thead class="form-group-sm">
                                                        <tr>
                                                            <th>Bag Type</th>
                                                            <th>Count</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        $t2NumRows = 0;
                                                        ?>
                                                        @foreach ($bags as $bag)
                                                            <tr>
                                                                <td>{{ $bag->name }}</td>
                                                                <td><input name="t2_count<?php echo $t2NumRows; ?>"
                                                                        id="t2_count<?php echo $t2NumRows; ?>"
                                                                        type="number" step="1" min="0"
                                                                        class="form-control form-control-sm"
                                                                        value="0"
                                                                        style="width: 100%;height:30px;text-align: center;"
                                                                        onchange="bags_caltotal();">

                                                                    <input name="t2_id<?php echo $t2NumRows; ?>"
                                                                        id="t2_id<?php echo $t2NumRows; ?>" type="hidden"
                                                                        value="{{ $bag->id }}">

                                                                </td>
                                                            </tr>
                                                            <?php $t2NumRows += 1; ?>
                                                        @endforeach

                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="1">Total</td>
                                                            <td colspan="1"> <input type="text"
                                                                    class="form-control" name="t2_bags_total"
                                                                    id="t2_bags_total" disabled
                                                                    style="text-align: right" /></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>

                                                <input type="hidden" id="t2NumRows" name="t2NumRows"
                                                    value="<?php echo $t2NumRows; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Discount Amount</label>
                                                <input type="text" class="form-control formatNumber"
                                                    id="discount" onchange="calculateTotal();"
                                                    style="text-align: right" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Total</label>
                                                <input type="text" class="form-control formatNumber"
                                                    name="t1_total" id="t1_total" disabled
                                                    style="text-align: right" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Balance Forward</label>
                                                <input type="text" class="form-control formatNumber"
                                                    name="t1_pre_bal_for" id="t1_pre_bal_for" disabled
                                                    style="text-align: right" onchange="calculateToPay();" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">To Pay</label>
                                                <input type="text" class="form-control formatNumber"
                                                    id="t1_to_pay" disabled style="text-align: right" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12"></div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Payment</label>
                                                <input type="text" class="form-control formatNumber"
                                                    id="paid_amount" value="0.00" onchange="calculateBalance();"
                                                    style="text-align: right" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12"></div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Balance</label>
                                                <input type="text" class="form-control formatNumber"
                                                    id="new_balance" disabled style="text-align: right" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="button" class="btn btn-primary col-3" onclick="editInvoice()">
                                            Create
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Row end -->

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

            calculateSubTotal();
            // calculateSubTotalWhenDeleteRow();
        }
        // Add rows ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        function addNewLineT1() {
            var item_row = parseInt(document.getElementById("t1NumRows").value);

            var table = document.querySelector('#invoice_item_table tbody');
            var row = table.insertRow(table.rows.length);

            row.id = "tr" + item_row;

            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);

            cell1.innerHTML = `<select name="t1_item` + (item_row) + `"
                                                                    id="t1_item` + (item_row) + `"
                                                                    class="form-control form-control-sm"
                                                                    onchange="getItemData(this ,` + (item_row) + `);"
                                                                    style="width: 100%;">
                                                                    <option value="0">Select</option>
                                                                    @foreach ($newInvoiceItems as $newInvoiceItem)
                                                                    <option value="{{ $newInvoiceItem->id }}" data-description="{{ e($newInvoiceItem->description) }}" data-unit_price="{{ $newInvoiceItem->unit_price }}">
                                                                        {{ $newInvoiceItem->name }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>`;
            cell2.innerHTML = `<textarea name="t1_desc` + (item_row) + `" id="t1_desc` + (item_row) +
                `" class="form-control form-control-sm"
                                                                    rows="1" style="width:100%;height:28px;font-size: 9;padding: 0;"></textarea>`
            cell3.innerHTML = `<input name="t1_weight` + (item_row) + `"
                                                                    id="t1_weight` + (item_row) + `" type="number"
                                                                    step="any" min="0"
                                                                    class="form-control form-control-sm" value=""
                                                                    style="width: 100%;height:30px;text-align: center;"
                                                                    onchange="calAmount('` + (item_row) + `');">`;
            cell4.innerHTML = `<input name="t1_unit_price` + (item_row) + `"
                                                                    id="t1_unit_price` + (item_row) + `" type="text"
                                                                    step="any"
                                                                    class="form-control form-control-sm formatNumber"
                                                                    value=""
                                                                    style="width: 100%;height:30px;text-align: right;"
                                                                    onchange="calAmount('` + (item_row) + `');">`;
            cell5.innerHTML = `<input name="t1_amount` + (item_row) + `"
                                                                    id="t1_amount` + (item_row) + `" type="text"
                                                                    class="form-control form-control-sm formatNumber"
                                                                    value=""
                                                                    style="width: 100%;height:30px;text-align: right;"
                                                                    disabled>`;
            cell6.innerHTML = `<button type="button" class="btn btn-outline-danger btn-sm"
                                                                    onclick="deleteTableRow('invoice_item_table','` + (
                item_row) + `')"><i
                                                                        class="icon-trash"></i></button>`;
            cell6.className = "text-center";

            document.getElementById("t1NumRows").value = item_row + 1;

        };

        //Create invoice
        async function editInvoice() {
            var invoice_number = document.getElementById("invoice_number").value;
            var invoice_date = document.getElementById("invoice_date").value;
            var customer_id = document.getElementById("customer_id").value;
            var sub_total = getNumber("t1_sub_total");
            var discount_amount = getNumber("discount");
            var previous_balance_forward = getNumber("t1_pre_bal_for");
            var to_pay = getNumber("t1_to_pay");
            var paid_amount = getNumber("paid_amount");
            var new_balance = getNumber("new_balance");;
            var memo = document.getElementById("memo").value;

            var items = [];
            var t1NumRows = parseInt(document.getElementById("t1NumRows").value);
            for (var i = 0; i < t1NumRows; i++) {
                if ($('#t1_item' + i).length > 0 && $('#t1_item' + i).val() !=
                    '0') { //check if have element and select item
                    var item = {
                        item_name: document.getElementById("t1_item" + i).value,
                        description: document.getElementById("t1_desc" + i).value,
                        weight: getNumber("t1_weight" + i),
                        unit_price: getNumber("t1_unit_price" + i),
                        amount: getNumber("t1_amount" + i),
                    };

                    if (item.item_name != 0) {
                        if (item.weight > 0) {
                            items.push(item);
                        } else {
                            const select = document.getElementById("t1_item" + i);
                            const options = select.options;
                            var selectedItem;

                            for (let i = 0; i < options.length; i++) {
                                if (item.item_name == options[i].value) {
                                    selectedItem = options[i].text;
                                }
                            }

                            alert("Please Add weight for " + selectedItem);
                            return;
                        }
                    }
                } else continue;
            }

            if (items.length === 0) {
                alert("Please Enter At least 1 Item to proceed");
                return;
            }


            var bags = [];
            var t1NumRows = parseInt(document.getElementById("t2NumRows").value);
            for (var i = 0; i < t1NumRows; i++) {
                var bag = {
                    id: parseInt(document.getElementById("t2_id" + i).value),
                    count: parseInt(document.getElementById("t2_count" + i).value),
                };

                if (bag.count != 0) {
                    bags.push(bag);
                }
            }

            add_invoice_details = {
                invoice_number: invoice_number,
                invoice_date: invoice_date,
                customer_id: customer_id,
                sub_total: sub_total,
                discount_amount: discount_amount,
                previous_balance_forward: previous_balance_forward,
                to_pay: to_pay,
                paid_amount: paid_amount,
                new_balance: new_balance,
                memo: memo,

                items: items,
                bags: bags
            }

            try {
                const response = await axios.post("{{ url('/invoice/store') }}/",
                    add_invoice_details);
                window.location.reload();
            } catch (error) {
                viewAddErrors(error);
            }
        }


        //  set description & unit price
        function getItemData(selectElement, number) {

            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const itemId = selectedOption.value;

            var tableSize = parseInt($('#t1NumRows').val());

            // check if select existing item
            for ($i = 0; $i < tableSize; $i++) {
                if (number == $i) continue;
                if ($('#t1_item' + $i).length > 0 && $('#t1_item' + $i).val() !=
                    '0') { //check if have element and select item
                    if (itemId == $('#t1_item' + $i).val()) {
                        $('#t1_item' + number).val(0);
                        $('#t1_desc' + number).html("");
                        $('#t1_unit_price' + number).val(0);
                        calAmount(number);
                        alert("This item is already selected.");
                        return;
                    }
                } else continue;
            }

            // when select final row add new line
            if (tableSize == (number + 1)) {
                addNewLineT1();
            }

            // set description & ubit price
            document.getElementById("t1_desc" + number).innerHTML = selectedOption.getAttribute('data-description');
            document.getElementById("t1_unit_price" + number).value = selectedOption.getAttribute('data-unit_price');

            calAmount(number);
        }


        // calculate amount
        function calAmount(index) {

            const weight = getNumber(`t1_weight${index}`);
            const unitPrice = getNumber(`t1_unit_price${index}`);

            const amount = weight * unitPrice;

            document.getElementById(`t1_amount${index}`).value = amount.toFixed(2); // or desired decimal places

            calculateSubTotal();
        }

        function calculateSubTotal() {
            let subTotal = 0;
            let i = 0;

            var tableSize = $('#t1NumRows').val();
            for ($i = 0; $i < tableSize; $i++) {

                if ($('#t1_item' + $i).length > 0 && $('#t1_item' + $i).val() !=
                    '0') { //check if have element and select item

                    subTotal += getNumber('t1_amount' + $i);

                } else {
                    continue;
                }
            }

            // Update the subtotal and total fields
            const subTotalField = document.getElementById(`t1_sub_total`);

            if (subTotalField) subTotalField.value = subTotal.toFixed(2);

            calculateTotal();
        }

        //calculate discount
        function calculateTotal() {
            const subTotal = getNumber('t1_sub_total');
            const discount = getNumber('discount');
            const total = subTotal - discount;

            document.getElementById("t1_total").value = total.toFixed(2);

            calculateToPay();
        }

        //calculate total, balance+sub total
        function calculateToPay() {
            const balance = getNumber('t1_pre_bal_for');
            const total = getNumber('t1_total');
            const toPay = balance + total;

            document.getElementById("t1_to_pay").value = toPay.toFixed(2);

            calculateBalance();
        }

        function calculateBalance() {
            const total = getNumber('t1_to_pay');
            const paidAmount = getNumber('paid_amount');
            const newBalance = total - paidAmount;

            document.getElementById("new_balance").value = newBalance.toFixed(2);

            formatNumbers
                (); // ------------------------------------------------------------------------------------------------------------------------------
        }

        function bags_caltotal() {
            let bagTotal = 0;

            var tableSize = $('#t2NumRows').val();
            for ($i = 0; $i < tableSize; $i++) {
                bagTotal += (getNumber('t2_count' + $i));
            }

            document.getElementById("t2_bags_total").value = bagTotal.toFixed(0);
        }



        window.addEventListener('load', () => {
            // getCustomerBalanceForward();
        });

        async function getCustomerBalanceForward() {
            const customerId = document.getElementById("customer_id").value;
            try {
                const response = await axios.get("{{ url('/invoice/customer/balance') }}/" + customerId);
                // console.log(response.data);

                if (response.data == "none") {
                    document.getElementById("t1_pre_bal_for").disabled = false;
                    document.getElementById("t1_pre_bal_for").value = parseFloat(0).toFixed(2);
                } else {
                    document.getElementById("t1_pre_bal_for").disabled = true;
                    document.getElementById("t1_pre_bal_for").value = parseFloat(response.data).toFixed(2);
                }
                //calculateTotal();
            } catch (error) {
                console.error("Error fetching customer balance forward:", error);
            }

            calculateTotal();
            calculateBalance();
        }
    </script>
</x-app-layout>
