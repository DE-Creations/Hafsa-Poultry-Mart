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
                            <a href="{{ route('dashboard') }}" class="text-decoration-none">Home</a>
                        </li>
                        <li class="breadcrumb-item">GRN</li>
                        <li class="breadcrumb-item">View GRN ({{ $grn->grn_number }})</li>
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
                            <h5 class="card-title">GRN Edit</h5>
                        </div>
                        <div class="card-body">

                            <!-- Row start -->
                            <div class="row gx-3">
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">GRN No.</label>
                                        <input id="grn_number" type="text" class="form-control" disabled
                                            value="{{ $grn->grn_number }}" />
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Date</label>
                                        <input id="grn_date" type="date" class="form-control"
                                            value="{{ $grn->date }}" disabled />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Suppliers</label>
                                        <select id="customer_id" class="form-control" disabled>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}" <?php if ($supplier->id == $grn->supplier_id) {
                                                    echo 'selected';
                                                } ?>>
                                                    {{ $supplier->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-3">

                                        <table id="invoice_item_table" name="invoice_item_table"
                                            class="table table-bordered table-striped table-hover table-responsive">
                                            <colgroup>
                                                <col style="width: 20%;">
                                                <col style="width: 10%;">
                                                <col style="width: 10%;">
                                                <col style="width: 10%;">
                                            </colgroup>

                                            <thead class="form-group-sm">
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Weight (kg)</th>
                                                    <th>Unit price</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $grnItems = $newGrnItems;

                                                $t1NumRows = count($grnItems);

                                                for ($i = 0; $i < $t1NumRows; $i++) {
                                                    $grnItem = $grnItems[$i];

                                                ?>
                                                <tr id="tr<?php echo $i; ?>">
                                                    <td>
                                                        <select disabled name="t1_item<?php echo $i; ?>"
                                                            id="t1_item<?php echo $i; ?>"
                                                            class="form-control form-control-sm"
                                                            style="width: 100%; height:30px">
                                                            <option>
                                                                {{ $grnItem['name'] }}
                                                            </option>
                                                        </select>

                                                    </td>
                                                    <td><input name="t1_weight<?php echo $i; ?>"
                                                            id="t1_weight<?php echo $i; ?>" type="number"
                                                            step="any" min="0"
                                                            class="form-control form-control-sm"
                                                            value="{{ $grnItem['weight'] }}"
                                                            style="width: 100%;height:30px;text-align: center;"
                                                            onchange="calAmount('<?php echo $i; ?>');" max=""
                                                            disabled>
                                                    </td>
                                                    <td><input name="t1_unit_price<?php echo $i; ?>"
                                                            id="t1_unit_price<?php echo $i; ?>" type="text"
                                                            step="any"
                                                            class="form-control form-control-sm formatNumber"
                                                            value="{{ $grnItem['unit_price'] }}"
                                                            style="width: 100%;height:30px;text-align: right;"
                                                            onchange="calAmount('<?php echo $i; ?>');" disabled></td>
                                                    <td><input name="t1_amount<?php echo $i; ?>"
                                                            id="t1_amount<?php echo $i; ?>" type="text"
                                                            class="form-control form-control-sm formatNumber"
                                                            value="{{ $grnItem['amount'] }}"
                                                            style="width: 100%;height:30px;text-align: right;" disabled>
                                                    </td>
                                                </tr>

                                                <?php
                                                }

                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" style="text-align: right">
                                                        <label style="text-align: right" class="">Sub Total
                                                            &nbsp;</label>
                                                    </td>
                                                    <td><input name="t1_sub_total" id="t1_sub_total" type="text"
                                                            disabled class="form-control form-control-sm formatNumber"
                                                            value="{{ $grn->sub_total }}"
                                                            style="width: 100%;height:30px;text-align: right;background-color: #eee;border-width: 1px;">
                                                    </td>
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
                                                <textarea class="form-control" placeholder="Enter Note" rows="5" id="memo" disabled>{{ $grn->grnPay->memo }}</textarea>
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
                                                    id="discount" value="{{ $grn->grnPay->discount_amount }}"
                                                    disabled onchange="calculateTotal();" style="text-align: right" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Total</label>
                                                <input type="text" class="form-control formatNumber"
                                                    name="t1_total" id="t1_total" disabled
                                                    value="{{ $grn->sub_total - $grn->grnPay->discount_amount }}"
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
                                                    value="{{ $grn->grnPay->previous_balance_forward }}"
                                                    style="text-align: right" onchange="calculateToPay();" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">To Pay</label>
                                                <input type="text" class="form-control formatNumber"
                                                    id="t1_to_pay" disabled value="{{ $grn->grnPay->to_pay }}"
                                                    style="text-align: right" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12"></div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Payment</label>
                                                <input type="text" class="form-control formatNumber"
                                                    id="paid_amount" value="{{ $grn->grnPay->paid_amount }}"
                                                    onchange="calculateBalance();" style="text-align: right"
                                                    disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12"></div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Balance</label>
                                                <input type="text" class="form-control formatNumber"
                                                    id="new_balance" disabled value="{{ $grn->grnPay->new_balance }}"
                                                    style="text-align: right" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="button" class="btn btn-success col-3"
                                            onclick="printGRN('{{ $grn->id }}')">
                                            Print
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
        function showAlert(alertType, alertSpan, alertText) {
            document.getElementById(alertSpan).textContent = alertText;
            const alert = document.getElementById(alertType);
            alert.classList.add("show");
            alert.classList.remove("d-none");
            setTimeout(() => {
                alert.classList.remove("show");
                alert.classList.add("d-none");
            }, 1500);
        }

        var grnId = <?php echo $grn->id; ?>;

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

        async function printGRN(grn_id) {
            try {
                const response = await axios.post("{{ url('/grn/print') }}/" + grn_id, {}, {
                    responseType: 'blob'
                });

                const blob = new Blob([response.data], {
                    type: 'application/pdf'
                });
                const url = window.URL.createObjectURL(blob);
                window.open(url, '_blank');
            } catch (error) {
                console.error(error);
                showAlert("danger-modal", "danger-text", "Something went wrong while generating the GRN.");
            }
        }

        window.addEventListener('load', () => {
            formatNumbers();
        });
    </script>
</x-app-layout>
