@inject('request', 'Illuminate\Http\Request')

@extends('layouts.business.header')

@section('content')

@include('layouts.business.business_topbar')

        <!-- ========================= Main ==================== -->
        @include('business.engage-clients.engage_clients_sidebar')
        
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-black mb-15" id="menu-toggle"><i class="fas fa-bars"></i></a>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="custom-list-sidebar">
                                    <div class="card-header">
                                        <div class="row mb-3">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <button type="button" class="btn btn-red mb-15" data-bs-toggle="modal" data-bs-target="#custom_list"> Create Custom List</button>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="search-box">
                                                    <input type="text" id="searchInput" name="fname" class="form-control search" placeholder="Search.." autocomplete="off" value="" data-id="0">
                                                    <i class="ri-search-line search-icon"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class=" mt-15  static-list">
                                        <div class="main-title">
                                            <label class="mb-0 fs-14 font-black">Custom List</label>
                                            <div class="mb-1 d-grid ">
                                                @foreach($customList as $cl) 
                                                    <a onclick="getClients('custom', '{{$cl->id}}', '{{$cl->name}}')" id="custom{{$cl->id}}" class="removeActive font-black">{{$cl->name}}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                        
                                        <div class="main-title">
                                            <label class="mb-0 fs-14 font-black">Generated Smart List </label>
                                            <div class="mb-1 d-grid">
                                                <a class="removeActive font-black" onclick="getClients('all', '' ,'All Contacts')" id="all"> All Contacts </a>
                                            </div>
                                        </div>

                                        <div class="main-title">
                                            <label class="mb-0 fs-14 font-black">Gender</label>
                                            <div class="mb-1 d-grid">
                                                <a class="removeActive font-black" onclick="getClients('gender', 'male' ,'Male')" id="gendermale"> Male</a>
                                                <a class="removeActive font-black" onclick="getClients('gender', 'female' ,'All Contacts')" id="genderfemale"> Female</a>
                                            </div>
                                        </div>

                                        <div class="main-title">
                                            <label class="mb-0 fs-14 font-black">Age</label>
                                            <div class="mb-1 d-grid">
                                                <a class="removeActive font-black" onclick="getClients('age', '18-29' ,'Adult 18-29')" id="age18-29"> Adult 18-29</a>
                                                <a class="removeActive font-black" onclick="getClients('age', '30-39' ,'Adult 30 - 39')" id="age30-39"> Adult 30 - 39</a>
                                                <a class="removeActive font-black" onclick="getClients('age', '40-49' ,'Adult 40 - 49')" id="age40-49"> Adult 40 - 49</a>
                                                <a class="removeActive font-black" onclick="getClients('age', '50' ,'Adult 50+')" id="age50"> Adult 50+</a>
                                                <a class="removeActive font-black" onclick="getClients('age', 'kids' ,' Kids under 18')" id="agekids">  Kids under 18</a>
                                            </div>
                                        </div>

                                        <div class="main-title">
                                            <label class="mb-0 fs-14 font-black">Status </label>
                                            <div class="mb-1 d-grid ">
                                                <a onclick="getClients('customer', 'Active','Active')" id="customerActive" class="removeActive font-black">Active</a>
                                                <a onclick="getClients('customer', 'InActive','Inactive')" id="customerInActive" class="removeActive font-black">Inactive</a>
                                                <a onclick="getClients('customer', 'Prospect','Prospects')" id="customerProspect" class="removeActive font-black">Prospects</a>
                                                <a onclick="getClients('customer', 'at-risk','At-Risk')" id="customerat-risk" class="removeActive font-black">At-Risk</a>
                                                <a onclick="getClients('customer', 'big-spenders','Big-Spenders')" id="customerbig-spenders" class="removeActive font-black">Big-Spenders</a>
                                            </div>
                                        </div>

                                        <div class="main-title">
                                            <label class="mb-0 fs-14 font-black">Membership Status </label>
                                            <div class="mb-1 d-grid ">
                                                <a onclick="getClients('membership', 'Month','Expire This Month')" id="membershipMonth" class="removeActive font-black">Expire This Month</a>
                                                <a onclick="getClients('membership', 'Expired','Expired')" id="membershipExpired" class="removeActive font-black">Expired</a>
                                            </div>
                                        </div>

                                        <div class="main-title">
                                            <label class="mb-0 fs-14 font-black">Programs</label>
                                            <div class="mb-1 d-grid ">
                                                @foreach($programList as $p) 
                                                    <a onclick="getClients('program', '{{$p->id}}','{{$p->program_name}}')" id="program{{$p->id}}" class="removeActive font-black">{{$p->program_name}}</a>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="main-title">
                                            <label class="mb-0 fs-14 font-black">Categories </label>
                                            <div class="mb-1 d-grid">
                                                @foreach($categoryList as $c) 
                                                    <a onclick="getClients('category', '{{$c->id}}','{{$c->category_title}}')" id="category{{$c->id}}" class="removeActive font-black">{{$c->category_title}}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row y-middle">
                                            <div class="col-lg-6" id>
                                                <h5 class="card-title mb-0" id="list_name">All Contacts</h5>
                                            </div>
                                            <input type="hidden" name="clientListId" id="clientListId" value="">
                                            <input type="hidden" name="clientListName" id="clientListName" value="">
                                            <div class="col-lg-6 d-none" id="sideButtons">
                                                <div class="text-right">
                                                    <!-- <button type="button" class="btn btn-red mr-5" data-bs-toggle="modal" data-bs-target="#Add_Clients"> Add Clients </button> -->
                                                    <button type="button" class="btn btn-red mr-5" onclick="openAddClientModel();"> Add Clients </button>
                                                    <div class="display-inline-block">
                                                        <div class="btn btn-black client-btn-padding">
															<div class="client-setting-icon">
																<i class="ri-more-fill"></i>
																<ul>
																	<li>
																		<a onclick="updateList();" data-bs-toggle="modal" data-bs-target="#custom_list_edit"><i class="fas fa-plus text-muted"></i>Rename List</a>
																	</li>
																	<li class="dropdown-divider"></li>
																	<li><a onclick="deleteList();"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete List</a></li>
																</ul>
															</div>
														</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body clientDataTable">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card header -->
                </div>
                <!-- end card -->
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
</div>
<!-- /#wrapper -->

<div class="modal fade" id="custom_list" tabindex="-1" aria-labelledby="secondModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Create list</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
            <form action="{{route('business.store_list' ,['business_id' => $business_id])}}" method="post">
                @csrf
    			<div class="modal-body">
    				<div class="">
    					<input type="text" class="form-control" id="name" name="name" value="" required placeholder="List Name...">
    				</div>
    			</div>
    			<div class="modal-footer">
    				<button type="button" class="btn btn-red" data-bs-dismiss="modal">Close</button>
    				<button type="submit" class="btn btn-black">Save</button>
    			</div>
            </form>
		</div>
 	 </div>
</div>

<div class="modal fade" id="custom_list_edit" tabindex="-1" aria-labelledby="secondModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rename list</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('business.update_list')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="">
                        <input type="hidden" name="id" id="id" value="">
                        <input type="text" class="form-control" id="editName" name="name" value="" required placeholder="List Name...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-red" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-black">Save</button>
                </div>
            </form>
        </div>
     </div>
</div>

<!-- Modal -->
<div class="modal fade" id="Add_Clients" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-70">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 header-name" id="exampleModalLabel">Add Clients For</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="add-client-model">
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
                        </div>
                    </div>
                    <div class="border-bottom-grey mb-15 mt-15"></div>
                        <div class="mb-15">
                            <label>Add From List</label>
                            <div id="loadcustomer" class="text-center"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('layouts.business.footer')
    
    <script type="text/javascript">

        $(document).ready(function() {
            var tp = '{{$type}}';
            var tpid = '{{$typeId}}';
            var tpname = '{{$typeName}}';
            getClients(tp,tpid ,tpname)

            $('#searchInput').on('keyup', function() {
                var searchText = $(this).val().toLowerCase();
                
                $('.static-list').each(function() {
                    var container = $(this);

                    container.find('.removeActive').each(function() {
                        var text = $(this).text().toLowerCase();
                        if (text.includes(searchText)) {
                            $(this).removeClass('d-none');
                        } else {
                            $(this).addClass('d-none');
                        }
                    });
                });

                $('.main-title').each(function() {
                    var mainTitle = $(this);
                    var isVisible = false;

                    mainTitle.find('.removeActive').each(function() {
                        if (!$(this).hasClass('d-none')) {
                            isVisible = true;
                            return false; 
                        }
                    });

                    if (isVisible) {
                        mainTitle.removeClass('d-none'); 
                    } else {
                        mainTitle.addClass('d-none'); 
                    }
                });

            });
        });

        function updateList(){
            $('#editName').val($('#clientListName').val());
            $('#id').val($('#clientListId').val());
        }

        function deleteList(){

            if (window.confirm("Are you sure you want to delete this list?")) {
                $.ajax({
                    url: '{{route("business.delete_list")}}',
                    type: 'get',
                    data: {
                        'id': $('#clientListId').val(),
                    },
                    success:function(response){

                        window.location.href = "{{route('business.engage_client.contact-list')}}";
                    },
                });
            }
        }

        function openAddClientModel(){
            var name = $('#clientListName').val();
            var id = $('#clientListId').val();
            $.ajax({
                url: '{{route("business.get_add_clients_model")}}',
                type: 'get',
                data: {
                    'id': id,
                },
                beforeSend: function() {
                    $('.header-name').html('Add Clients For ' + name);
                    $('#Add_Clients').modal('show');
                    $('#loadcustomer').html('We are getting your list..');
                },
                success:function(response){
                    $('.add-client-model').html(response);
                },
            });
        }

        function getClients(type,id,name){

            $('.removeActive').removeClass('active');
            $('#'+type+id).addClass('active');

            $('#list_name').html(name);
            if(type == 'custom'){
                $('#clientListId').val(id);
                $('#clientListName').val(name);
                $('#sideButtons').removeClass('d-none');
            }else{
                $('#clientListId, #clientListName').val('');
                $('#sideButtons').addClass('d-none');
            }

            $.ajax({
                url: '{{route("business.load_client_datatable")}}',
                type: 'get',
                data: {
                    'id': id,
                    'type': type,
                },
                beforeSend: function() {
                    $('.clientDataTable').html('We are getting your list..');
                },
                success:function(response){
                    $('.clientDataTable').html(response);
                },
            });
        }
    </script>  

    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#client_wrapper").toggleClass("toggled");
        });
    </script>

    <script>
        function removeClassIfNecessary() {
            var div = document.getElementById('client_wrapper');
            if (window.innerWidth <= 768) { // Example breakpoint
                div.classList.remove('toggled');
            } else {
            div.classList.add('toggled');
            }
        }
        window.addEventListener('resize', removeClassIfNecessary);
        window.addEventListener('DOMContentLoaded', removeClassIfNecessary); // To handle initial load
    </script>

@endsection

