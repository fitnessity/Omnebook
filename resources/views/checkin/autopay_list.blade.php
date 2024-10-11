 <div class="row">
     <div class="col-lg-12">
         <div class="">
             <label class="fs-15 mb-15">Money Owed</label>
             @if ($missedPayments->isNotEmpty())
                 <div class="row y-middle">
                     <div class="col-lg-8 col-md-8 col-8">
                         <div class="mb-15">
                             <input type="checkbox" id="selectAll" /> <label for="selectAll">All</label>
                         </div>
                     </div>
                 </div>
             @endif
             @forelse($missedPayments as $i => $p)
                 <div class="row y-middle">
                     <div class="col-lg-1 col-md-1 col-1">
                         <div class="mb-15">
                             <input type="checkbox" class="payment-checkbox" id="payment{{ $i }}"
                                 data-amount="{{ $p->total_amount }}" data-rid="{{ $p->id }}" />
                         </div>
                     </div>
                     <div class="col-lg-7 col-md-7 col-7">
                         <div class="mb-15">
                             <span>{{ $i + 1 }}. Missed Payment for ${{ $p->total_amount }}</span>
                         </div>
                     </div>
                     <div class="col-lg-4 col-md-4 col-4">
                         <div class="mb-15 float-right">
                             <a href="#" data-reload="1" data-modal-width="" data-behavior="ajax_html_modal"
                                 data-url="{{ route('checkin.card_editing_form', ['customer_id' => $customer->id, 'return_url' => url()->full(), 'price' => $p->total_amount, 'rid' => $p->id]) }}"
                                 class="btn btn-red" onclick="closeModal()">Paynow</a>
                         </div>
                     </div>
                 </div>
             @empty
                 <div class="row y-middle">
                     <div class="col-lg-12 col-md-12 col-12">
                         <p class="text-center">No Missed Payment Available</p>
                     </div>
                 </div>
             @endforelse
             @if ($missedPayments->isNotEmpty())
                 <div class="row y-middle mt-3 border-top-grey">
                     <div class="col-lg-8 col-md-8 col-8">
                         <div class="m-total-amount mt-15">
                             <span>Total Selected: $<span id="totalAmount">0.00</span></span>
                         </div>
                     </div>
                     <div class="col-lg-4 col-md-4 col-4">
                         <div class="mt-15 float-right">
                                <a href="#" id="paySelectedButton" data-customer-id="{{ $customer->id }}" data-return-url="{{ url()->full()}}" data-reload="1" data-modal-width="" data-behavior="ajax_html_modal"
                                data-url="" class="btn btn-red" onclick="closeModal()">Pay Selected</a>

                            </div>
                     </div>
                 </div>
             @endif
         </div>
     </div>
 </div>
<script>
    document.getElementById('selectAll').addEventListener('click', function(event) {
        const isChecked = event.target.checked;
        const checkboxes = document.querySelectorAll('.payment-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = isChecked;
        });
        calculateTotal();
    });

    const checkboxes = document.querySelectorAll('.payment-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            calculateTotal();
        });
    });

    function calculateTotal() {
        let total = 0;
        const selectedRids = [];
        const checkboxes = document.querySelectorAll('.payment-checkbox:checked');
        checkboxes.forEach(checkbox => {
            total += parseFloat(checkbox.getAttribute('data-amount'));
            selectedRids.push(checkbox.getAttribute('data-rid'));
        });
        document.getElementById('totalAmount').textContent = total.toFixed(2);
        const totalAmountInput = total.toFixed(2);
        const ridsInput = selectedRids.join(',');
        const paySelectedButton = document.getElementById('paySelectedButton');
        const customerId = paySelectedButton.getAttribute('data-customer-id');
        const returnUrl = encodeURIComponent(paySelectedButton.getAttribute('data-return-url'));
        const routeUrl = `/checkin/card_editing_form_all?customer_id=${customerId}&total_amount=${totalAmountInput}&rids=${ridsInput}&return_url=${returnUrl}`;
        paySelectedButton.setAttribute('data-url', routeUrl);
    }
</script>