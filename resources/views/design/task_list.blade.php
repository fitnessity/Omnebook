@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
@section('content')

	@include('layouts.business.business_topbar')

    <div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <div class="chat-wrapper d-lg-flex gap-1 mt-n4 p-1">
            <div class="file-manager-content w-100 p-4 pb-0">
                <div class="row mb-4">
                    <div class="col-auto order-1 d-block d-lg-none">
                        <button type="button" class="btn btn-soft-success btn-icon btn-sm fs-16 file-menu-btn">
                            <i class="ri-menu-2-fill align-bottom"></i>
                        </button>
                    </div>
                    <div class="col-sm order-3 order-sm-2 mt-3 mt-sm-0">
                        <h5 class="fw-semibold mb-0">Task List</h5>
                    </div>
                </div>
                <div class="p-3 bg-light rounded mb-4">
                    <div class="row g-2">
                        <div class="col-lg-auto">
                            <select class="form-control" data-choices data-choices-search-false name="choices-select-sortlist" id="choices-select-sortlist">
                                <option value="">Sort</option>
                                <option value="By ID">By ID</option>
                                <option value="By Name">By Name</option>
                            </select>
                        </div>
                        <div class="col-lg-auto">
                            <select class="form-control" data-choices data-choices-search-false name="choices-select-status" id="choices-select-status">
                                <option value="">All Tasks</option>
                                <option value="Completed">Completed</option>
                                <option value="Inprogress">Inprogress</option>
                                <option value="Pending">Pending</option>
                                <option value="New">New</option>
                            </select>
                        </div>
                        <div class="col-lg">
                            <div class="search-box">
                                <input type="text" id="searchTaskList" class="form-control search" placeholder="Search task name">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-lg-auto">
                            <button class="btn btn-red createTask" type="button" data-bs-toggle="modal" data-bs-target="#createTask">
                                <i class="ri-add-fill align-bottom"></i> Add Tasks
                            </button>
                        </div>
                    </div>
                </div>

                <div class="todo-content position-relative px-4 mx-n4" id="todo-content">
                    <div class="todo-task">
                        <div class="table-responsive">
                            <table class="table align-middle position-relative table-nowrap"  id="sortable"> 
                                <thead class="table-active">
                                    <tr>
                                        <th scope="col">Task Name</th>
                                        <th scope="col">Assigned</th>
                                        <th scope="col">Due Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Priority</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody id="task-list">
                                    <tr>           
                                         <td>                
                                            <div class="d-flex align-items-start">                    
                                                <div class="flex-shrink-0 me-3">                       
                                                    <div class="task-handle px-1 bg-light rounded">: :</div>  
                                                </div>                    
                                                <div class="flex-grow-1">                        
                                                    <div class="form-check">                            
                                                        <input class="form-check-input" type="checkbox" value="15" id="todo15">                            
                                                        <label class="form-check-label" for="todo15">Added Select2</label>                        
                                                    </div>                    
                                                </div>                
                                            </div>            
                                        </td>            
                                        <td>
                                            <div class="avatar-group flex-nowrap">
                                                <a href="javascript: void(0);" class="avatar-group-item" data-img="https://fitnessity-production.s3.amazonaws.com/customer/ruxB4qnxpKeKcsWtUCGnihFs5AEuMLOF5qWh16rB.jpg" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Curtis Saenz">                
                                                    <img src="https://fitnessity-production.s3.amazonaws.com/customer/ruxB4qnxpKeKcsWtUCGnihFs5AEuMLOF5qWh16rB.jpg" alt="" class="rounded-circle avatar-xxs">            
                                                </a>
                                            </div>
                                        </td>            
                                        <td>23 Apr, 2022</td>            
                                        <td><span class="badge badge-soft-warning text-uppercase">Pending</span></td>            
                                        <td><span class="badge bg-danger text-uppercase">High</span></td>            
                                        <td>            
                                            <div class="hstack gap-2">                
                                                <button class="btn btn-sm btn-soft-danger remove-list" data-bs-toggle="modal" data-bs-target="#removeTaskItemModal" data-remove-id="15"><i class="ri-delete-bin-5-fill align-bottom"></i></button>                
                                                <button class="btn btn-sm btn-soft-info edit-list" data-bs-toggle="modal" data-bs-target="#createTask" data-edit-id="15"><i class="ri-pencil-fill align-bottom"></i></button>            
                                            </div>            
                                        </td>        
                                    </tr>
                                    <tr>            
                                        <td>                
                                            <div class="d-flex align-items-start">                    
                                                <div class="flex-shrink-0 me-3">                        
                                                    <div class="task-handle px-1 bg-light rounded">: :</div>                    
                                                </div>                    
                                                <div class="flex-grow-1">                        
                                                    <div class="form-check">                            
                                                        <input class="form-check-input" type="checkbox" value="13" id="todo13">                            
                                                        <label class="form-check-label" for="todo13">Add Dynamic Contact List</label>                        
                                                    </div>                    
                                                </div>                
                                            </div>            
                                        </td>            
                                        <td>
                                            <div class="avatar-group flex-nowrap">
                                                <a href="javascript: void(0);" class="avatar-group-item" data-img="https://fitnessity-production.s3.amazonaws.com/company/pHSVR4Hvc7abvaVqPG3zk3tUJjbJNCdEMfKuCM1j.jpg" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Virgie Price">                
                                                    <img src="https://fitnessity-production.s3.amazonaws.com/company/pHSVR4Hvc7abvaVqPG3zk3tUJjbJNCdEMfKuCM1j.jpg" alt="" class="rounded-circle avatar-xxs">            
                                                </a>
                                            </div>
                                        </td>            
                                        <td>24 Apr, 2022</td>            
                                        <td><span class="badge badge-soft-secondary text-uppercase">Inprogress</span></td>            
                                        <td><span class="badge bg-success text-uppercase">Low</span></td>            
                                        <td>            
                                            <div class="hstack gap-2">                
                                                <button class="btn btn-sm btn-soft-danger remove-list" data-bs-toggle="modal" data-bs-target="#removeTaskItemModal" data-remove-id="13"><i class="ri-delete-bin-5-fill align-bottom"></i></button>                
                                                <button class="btn btn-sm btn-soft-info edit-list" data-bs-toggle="modal" data-bs-target="#createTask" data-edit-id="13"><i class="ri-pencil-fill align-bottom"></i></button>            
                                            </div>            
                                        </td>        
                                    </tr>
                                    <tr>            
                                        <td>                
                                            <div class="d-flex align-items-start">                    
                                                <div class="flex-shrink-0 me-3">                        
                                                    <div class="task-handle px-1 bg-light rounded">: :</div>                    
                                                </div>                    
                                                <div class="flex-grow-1">                        
                                                    <div class="form-check">                            
                                                        <input class="form-check-input" type="checkbox" value="13" id="todo13">                            
                                                        <label class="form-check-label" for="todo13"> Brand Logo design</label>                        
                                                    </div>                    
                                                </div>                
                                            </div>            
                                        </td>            
                                        <td>
                                            <div class="avatar-group flex-nowrap">
                                                <a href="javascript: void(0);" class="avatar-group-item" data-img="https://fitnessity-production.s3.amazonaws.com/customer/Pj5DKQgqQZvsvjBEQokyaKtuHHNHEmv0xTExXX2D.jpg" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Virgie Price">                
                                                    <img src="https://fitnessity-production.s3.amazonaws.com/customer/Pj5DKQgqQZvsvjBEQokyaKtuHHNHEmv0xTExXX2D.jpg" alt="" class="rounded-circle avatar-xxs">            
                                                </a>
                                            </div>
                                        </td>            
                                        <td>24 Apr, 2022</td>            
                                        <td><span class="badge badge-soft-info text-uppercase">New</span></td>            
                                        <td><span class="badge bg-warning text-uppercase">Medium</span></td>            
                                        <td>            
                                            <div class="hstack gap-2">                
                                                <button class="btn btn-sm btn-soft-danger remove-list" data-bs-toggle="modal" data-bs-target="#removeTaskItemModal" data-remove-id="13"><i class="ri-delete-bin-5-fill align-bottom"></i></button>                
                                                <button class="btn btn-sm btn-soft-info edit-list" data-bs-toggle="modal" data-bs-target="#createTask" data-edit-id="13"><i class="ri-pencil-fill align-bottom"></i></button>            
                                            </div>            
                                        </td>        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->

</div>
<!-- end main content-->




@include('layouts.business.footer')
<script>
    $(function() {
    $("#sortable tbody").sortable({
      cursor: "move",
      placeholder: "sortable-placeholder",
      helper: function(e, tr)
      {
        var $originals = tr.children();
        var $helper = tr.clone();
        $helper.children().each(function(index)
        {
        // Set helper cell sizes to match the original sizes
        $(this).width($originals.eq(index).width());
        });
        return $helper;
      }
    }).disableSelection();
  });
</script>
@endsection