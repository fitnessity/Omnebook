@inject('request', 'Illuminate\Http\Request')

@extends('layouts.business.header')

@section('content')

@include('layouts.business.business_topbar')

        <!-- ========================= Main ==================== -->
        @include('design.engage_clients_sidebar')

         
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
                                                    <button type="button" class="btn btn-red mb-15" data-bs-toggle="modal" data-bs-target="#custom_list"> Create Custom List </button>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="search-box">
                                                    <input type="text" id="serchclient" name="fname" class="form-control search" placeholder="Search.." autocomplete="off" value="" data-id="0">
                                                    <i class="ri-search-line search-icon"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-15">
                                        <label class="mb-15 fs-14 font-red">Custom List</label>
                                    </div>
                                            
                                    <div class="mt-15">
                                        <label class="mb-5 fs-14 font-red">Generated Smart List</label>

                                        <div class="mb-10 d-grid">
                                            <span> All Contacts </span>
                                            <span>Gender - Female</span>
                                            <span>Gender - Male</span>
                                            <span>Age - Adult</span>
                                            <span>Age - Kids</span>
                                            <span>Status - Active</span>
                                            <span>Status - Inactive</span>
                                            <span>Status - Prospects</span>
                                            <span>Status - At-Risk</span>
                                            <span>Status - Big-Spenders</span>
                                        </div>
                                    </div>
                                    <div class="mt-15">
                                        <label class="mb-15 fs-14 font-red">Programs</label>
                                        <div class="mb-3 d-grid ">
                                            <span>Adult Kickboxing </span>
                                            <span>Kids martial Arts </span>
                                        </div>
                                    </div>
                                    <div class="mt-15">
                                        <label class="mb-15 fs-14 font-red">Categories </label>
                                        <div class="mb-3 d-grid smart-generate-list">
                                            <span> </span>
                                            <span> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row y-middle">
                                            <div class="col-lg-6">
                                                <h5 class="card-title mb-0">Client List</h5>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="text-right">
                                                    <button type="button" class="btn btn-red mr-5" data-bs-toggle="modal" data-bs-target="#Add_Clients"> Add Clients </button>
                                                    <div class="display-inline-block">
                                                        <div class="btn btn-black client-btn-padding">
															<div class="client-setting-icon">
																<i class="ri-more-fill"></i>
																<ul>
																	<li>
																		<a href="" data-bs-toggle="modal" data-bs-target=".tax"><i class="fas fa-plus text-muted"></i>Rename List</a>
																	</li>
																	<li><a href=""><i class="fas fa-plus text-muted"></i>Export List</a></li>
																	<li class="dropdown-divider"></li>
																	<li><a href=""><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete List</a></li>
																</ul>
															</div>
														</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
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
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Joseph </td>
                                                        <td>Parker</td>
                                                        <td>Joseph@gmail.com</td>
                                                        <td>35</td>
                                                        <td>9365872536</td>                                                
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Diana </td>
                                                        <td>Kohler</td>
                                                        <td>Kohler@gmail.com</td>
                                                        <td>25</td>
                                                        <td>26673235125</td>                                                
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Tonya</td>
                                                        <td> Noble</td>
                                                        <td>Admin@gmail.com</td>
                                                        <td>41</td>
                                                        <td>9365872536</td>   
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Joseph </td>
                                                        <td>Parker</td>
                                                        <td>Parker@gmail.com</td>
                                                        <td>30</td>
                                                        <td>25784253</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Donald</td>
                                                        <td>Palmer</td>
                                                        <td>Palmer@gmail.com</td>
                                                        <td>25</td>
                                                        <td>2458726395</td>                                               
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Mary </td>
                                                        <td>Rucker</td>
                                                        <td>Rucker@gmail.com</td>
                                                        <td>22</td>
                                                        <td>758426941</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>James </td>
                                                        <td>Morris</td>
                                                        <td>Morris@gmail.com</td>
                                                        <td>32</td>
                                                        <td>2753863458</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Nathan </td>
                                                        <td>Cole</td>
                                                        <td>Nancy@gmail.como</td>
                                                        <td>33</td>
                                                        <td>45869752354</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Coles</td>
                                                        <td>Grace</td>
                                                        <td>Grace@gmail.com</td>
                                                        <td>21</td>
                                                        <td>3657248963</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Freda</td>
                                                        <td>Clarke</td>
                                                        <td>Alexis@gmail.com </td>
                                                        <td>25</td>
                                                        <td>45863257453</td>                                               
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Williams</td>
                                                        <td>Grace</td>
                                                        <td>Williams@gmail.com</td>
                                                        <td>56</td>
                                                        <td>257426853</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Richard </td>
                                                        <td>Max</td>
                                                        <td>Richard@gmail.com </td>
                                                        <td>45</td>
                                                        <td>5475985625</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Olive </td>
                                                        <td>Gunther</td>
                                                        <td>Schaefer@gmail.com</td>
                                                        <td>26</td>
                                                        <td>42675329824</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
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
			<div class="modal-body">
				<div class="">
					<input type="text" class="form-control" id="" value="" placeholder="List Name...">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-red" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-black">Save</button>
			</div>
		</div>
 	 </div>
</div>

<!-- Modal -->
<div class="modal fade" id="Add_Clients" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-70">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Clients</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-15">
                            <label>Search Contacts</label>
                            <div class="search-box">
                                <input type="text" id="serchclient" name="fname" class="form-control search" placeholder="Search.." autocomplete="off" value="" data-id="0">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="border-bottom-grey mb-15 mt-15"></div>
                        <div class="mb-15">
                            <label>Add From List</label>
                            <div class="table-responsive">
                                            <table id="add_clients" class="table table-bordered dt-responsive nowrap table-striped align-middle" width="100%">
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
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Joseph </td>
                                                        <td>Parker</td>
                                                        <td>Joseph@gmail.com</td>
                                                        <td>35</td>
                                                        <td>9365872536</td>                                                
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Diana </td>
                                                        <td>Kohler</td>
                                                        <td>Kohler@gmail.com</td>
                                                        <td>25</td>
                                                        <td>26673235125</td>                                                
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Tonya</td>
                                                        <td> Noble</td>
                                                        <td>Admin@gmail.com</td>
                                                        <td>41</td>
                                                        <td>9365872536</td>   
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Joseph </td>
                                                        <td>Parker</td>
                                                        <td>Parker@gmail.com</td>
                                                        <td>30</td>
                                                        <td>25784253</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Donald</td>
                                                        <td>Palmer</td>
                                                        <td>Palmer@gmail.com</td>
                                                        <td>25</td>
                                                        <td>2458726395</td>                                               
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Mary </td>
                                                        <td>Rucker</td>
                                                        <td>Rucker@gmail.com</td>
                                                        <td>22</td>
                                                        <td>758426941</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>James </td>
                                                        <td>Morris</td>
                                                        <td>Morris@gmail.com</td>
                                                        <td>32</td>
                                                        <td>2753863458</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Nathan </td>
                                                        <td>Cole</td>
                                                        <td>Nancy@gmail.como</td>
                                                        <td>33</td>
                                                        <td>45869752354</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Coles</td>
                                                        <td>Grace</td>
                                                        <td>Grace@gmail.com</td>
                                                        <td>21</td>
                                                        <td>3657248963</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Freda</td>
                                                        <td>Clarke</td>
                                                        <td>Alexis@gmail.com </td>
                                                        <td>25</td>
                                                        <td>45863257453</td>                                               
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Williams</td>
                                                        <td>Grace</td>
                                                        <td>Williams@gmail.com</td>
                                                        <td>56</td>
                                                        <td>257426853</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Richard </td>
                                                        <td>Max</td>
                                                        <td>Richard@gmail.com </td>
                                                        <td>45</td>
                                                        <td>5475985625</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>Olive </td>
                                                        <td>Gunther</td>
                                                        <td>Schaefer@gmail.com</td>
                                                        <td>26</td>
                                                        <td>42675329824</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-red">Save </button>
            </div>
        </div>
    </div>
</div>


@include('layouts.business.footer')

    <script>
        new DataTable('#contact_list', {
            responsive: true
        });
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
    <script>
        new DataTable('#add_clients', {
            responsive: true
        });
	</script>


@endsection