<div class="table-responsive">
    <table id="contact_list" class="table table-bordered dt-responsive nowrap table-striped align-middle customer-list-table" width="100%">
        <thead>
            <tr>
                <th scope="col" style="width: 10px;">
                    <div class="form-check">
                        <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                    </div>
                </th>
                <th data-ordering="false">First Name</th>
                <th data-ordering="false">Last Name</th>
                <th data-ordering="false">Email</th>
                <th data-ordering="false">Age</th>
                <th data-ordering="false">Mobile Number</th>
                <th data-ordering="false">Gender</th>
                <th data-ordering="false">Status</th>
                @if(request()->type == 'membership' && request()->id == 'Month')
                    <th data-ordering="false"> Membership Details</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if(isset($customers))
                @foreach(@$customers as $c)
                    <tr>
                        <th scope="row">
                            <div class="form-check">
                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                            </div>
                        </th>
                        <td>{{$c->fname}}</td>
                        <td>{{$c->lname}}</td>
                        <td>{{$c->email ?? 'N/A'}}</td>
                        <td>{{$c->age ?? 'N/A'}}</td>
                        <td>{{$c->phone_number ?? 'N/A'}}</td>                                                
                        <td>{{$c->gender ?? 'N/A'}}</td>                                                
                        <td>{{$c->is_active() ?? 'N/A'}}</td>  
                        @if(request()->type == 'membership' && request()->id == 'Month') 
                            <td>     
                                {!! getMemberList($c->id, request()->id ,request()->business_id) !!}
                            </td>  
                         @endif                                   
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        var dataTable = new DataTable('#contact_list', {
            responsive: true,
        });
    });
</script>
