<div class="row">
    <div class="col-md-12">
        <form class="app-search d-none d-md-block mb-10 float-right">
            <div class="position-relative">
                <input type="text" class="form-control ui-autocomplete-input" placeholder="Search for family member" autocomplete="off" id="serchFamilyMember" name="fname" value="">
            </div>
        </form>
    </div>						
</div>

<div class="purchase-history">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Relationship</th>
                    <th>Age</th>
                    <th>PassCode</th>
                    <th class="action-width">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customerdata->get_families() as $index=>$family_member)
                <tr>
                    <td> {{$family_member->full_name}} </td>
                    <td>{{$family_member->relationship ?? "N/A"}}</td>
                    <td>{{$family_member->age ?? "N/A"}}</td>
                    <td>{{$family_member->user->unique_code ?? "N/A"}}</td>
                    <td class="text-center">
                        <a onclick="deleteMember('{{$family_member->id}}')" class="btn btn-red mmb-10">Delete</a>

                        <a href="#" trget="_blank" onclick="redirctAddfamily({{$customerdata->id}});" class="btn btn-black mmb-10">Edit</a>

                        <a href="{{route('business_customer_show',['business_id' => request()->business_id, 'id'=>$family_member->id])}}" class="btn btn-red mmb-10">View</a></td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

