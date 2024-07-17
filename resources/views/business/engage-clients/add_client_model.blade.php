 <form action="{{route('business.store_client_custom_list')}}" method="post" id="myForm">
    <input type="hidden" name="lId" value="{{request()->id}}" id="">
    <input type="hidden"  name="cid" value="{{$oldClients}}">  
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="mb-15">
                    <label>Search Contacts</label>
                    <div class="search-box">
                        <input type="text" id="customSearchInput" name="fname" class="form-control search" placeholder="Search Cleints" autocomplete="off" value="" data-id="0">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
                <div class="border-bottom-grey mb-15 mt-15"></div>
                    @csrf
                    <div class="mb-15">
                        <label>Add From List</label>
                        <div class="table-responsive">
                            <table id="add_clients_custom" class="table table-bordered dt-responsive nowrap table-striped align-middle" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 10px;">
                                            <div class="form-check">
                                                <input class="form-check-input fs-15 checkAllDataTable" type="checkbox" id="checkAll" value="option">
                                            </div>
                                        </th>
                                        <th data-ordering="false">First Name</th>
                                        <th data-ordering="false">Last Name</th>
                                        <th data-ordering="false">Email</th>
                                        <th data-ordering="false">Age</th>
                                        <th data-ordering="false">Mobile Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $customListIds  = $customList->customCientList()->pluck('customer_id')->toArray();
                                    @endphp

                                    @foreach(@$customers as $key => $c)
                                        @php
                                            $isChecked = in_array($c->id, $customListIds);
                                        @endphp
                                        <tr>
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input fs-15 checkbox-item" type="checkbox" name="checkAll[]" value="1" data-cid="{{$c->id}}" data-lid="{{$key}}" @if($isChecked) checked @endif>
                                                    <input type="hidden" id="cid{{$key}}" value="">
                                                </div>
                                            </th>
                                            <td>{{$c->fname}}</td>
                                            <td>{{$c->lname}}</td>
                                            <td>{{$c->email ?? 'N/A'}}</td>
                                            <td>{{$c->age ?? 'N/A'}}</td>
                                            <td>{{$c->phone_number ?? 'N/A'}}</td>                                                
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-red">Save </button>
    </div>

</form>

<script>
    $(document).ready(function() {
        let checkAllChecked = false;
        var dataTable = new DataTable('#add_clients_custom', {
            paging: true, // Enable pagination
            ordering: true, // Enable sorting
            //searching: false,
            columnDefs: [
                { orderable: false, targets: 0 } // Disable ordering on the first column (checkbox column)
            ]
        });

        $('.dataTables_filter').addClass('d-none');
        $('#customSearchInput').on('keyup', function() {
            $('.dataTables_filter').addClass('d-none');
            var searchText = $(this).val().toLowerCase();
            dataTable.search(searchText).draw();
        });

        $(document).on('change', 'input[type="checkbox"].checkAllDataTable', function() {
            let checkAllChecked = $(this).prop('checked'); 
            $('.checkbox-item').prop('checked', checkAllChecked).each(function() {
                updateCidValue($(this), checkAllChecked);
            });
            //$('.checkbox-item').prop('checked', checkAllChecked);
        });

        $('#add_clients_custom').on('page.dt', function () {
            // Update the state of "Check All" checkbox
            $('.checkAllDataTable').prop('checked', checkAllChecked);
        });

        $(document).on('change', 'input[type="checkbox"].checkbox-item', function() {
            var cidInput = $('input[name="cid"]');
            var currentCidValues = cidInput.val() ? cidInput.val().split(',') : [];
            if ($(this).is(':checked')) {
                currentCidValues.push($(this).data('cid'));
            }else{
                 var cidValueToRemove = String($(this).data('cid'));
                currentCidValues = currentCidValues.filter(function(value) {
                    return value !== cidValueToRemove;
                });
            }

            cidInput.val(currentCidValues.join(','));
        });
    });

    function updateCidValue(checkbox, isChecked) {
        var cidInput = $('input[name="cid"]');
       var currentCidValues = new Set(cidInput.val() ? cidInput.val().split(',') : []);
        var cidValue = checkbox.data('cid');

        if (isChecked ) {
            currentCidValues.add(cidValue);
        } else {
            currentCidValues.delete(String(cidValue));
        }

         cidInput.val(Array.from(currentCidValues).join(','));
    }

</script>