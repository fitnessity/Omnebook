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

<!-- Modal -->
<div class="modal fade" id="createTask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-40">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="task-error-msg" class="alert alert-danger py-2"></div>
                <form autocomplete="off" action="" id="creattask-form">
                    <input type="hidden" id="taskid-input" class="form-control">
                    <div class="mb-3">
                        <label for="task-title-input" class="form-label">Task Title</label>
                        <input type="text" id="task-title-input" class="form-control" placeholder="Enter task title">
                    </div>
                    <div class="mb-3">
                        <label>Task Description</label>
                        <div id="ckeditor-classic">
                            <p>Tommy Hilfiger men striped pink sweatshirt. Crafted with cotton. Material composition is 100% organic cotton. This is one of the world’s leading designer lifestyle brands and is internationally recognized for celebrating the essence of classic American cool style, featuring preppy with a twist designs.</p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="dropzone">
                            <div class="fallback">
                                <input name="file" type="file" multiple="multiple">
                            </div>
                            <div class="dz-message needsclick">
                                <div class="mb-3">
                                    <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                </div>
                                <h5>Drop files here or click to upload.</h5>
                            </div>
                        </div>
                        <ul class="list-unstyled mb-0" id="dropzone-preview">
                            <li class="mt-2" id="dropzone-preview-list">
                                <div class="border rounded">
                                    <div class="d-flex p-2">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-sm bg-light rounded">
                                                <img data-dz-thumbnail class="img-fluid rounded d-block" src="#" alt="Product-Image" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="pt-1">
                                                <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                <strong class="error text-danger" data-dz-errormessage></strong>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0 ms-3">
                                            <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <label for="exampleInputdate" class="form-label">Reminder Date</label>
                                    <input type="date" class="form-control" id="exampleInputdate">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="exampleInputtime" class="form-label">Reminder Time</label>
                                    <input type="time" class="form-control" id="exampleInputtime">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <a href="#">Add Reminder</a>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="task-assign-input" class="form-label">Assigned To</label>
                        <div class="avatar-group justify-content-center" id="assignee-member"></div>
                        <div class="select-element">
                            <button class="btn btn-light w-100 d-flex justify-content-between" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                <span>Assigned </span> <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu w-100">
                                <div data-simplebar style="max-height: 141px">
                                    <ul class="list-unstyled mb-0">
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="avatar-xxs flex-shrink-0 me-2">
                                                    <img src="https://fitnessity-production.s3.amazonaws.com/customer/Pj5DKQgqQZvsvjBEQokyaKtuHHNHEmv0xTExXX2D.jpg" alt="" class="drop-img-fluid rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">James Forbes</div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="avatar-xxs flex-shrink-0 me-2">
                                                    <img src="https://fitnessity-production.s3.amazonaws.com/customer/ruxB4qnxpKeKcsWtUCGnihFs5AEuMLOF5qWh16rB.jpg" alt="" class="drop-img-fluid rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">John Robles</div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="avatar-xxs flex-shrink-0 me-2">
                                                    <img src="https://fitnessity-production.s3.amazonaws.com/company/pHSVR4Hvc7abvaVqPG3zk3tUJjbJNCdEMfKuCM1j.jpg" alt="" class="drop-img-fluid rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">Mary Gant</div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="avatar-xxs flex-shrink-0 me-2">
                                                    <img src="https://fitnessity-production.s3.amazonaws.com/customer/Pj5DKQgqQZvsvjBEQokyaKtuHHNHEmv0xTExXX2D.jpg" alt="" class="drop-img-fluid rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">Curtis Saenz</div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="avatar-xxs flex-shrink-0 me-2">
                                                    <img src="https://fitnessity-production.s3.amazonaws.com/customer/ruxB4qnxpKeKcsWtUCGnihFs5AEuMLOF5qWh16rB.jpg" alt="" class="drop-img-fluid rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">Virgie Price</div>
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="avatar-xxs flex-shrink-0 me-2">
                                                    <img src="https://fitnessity-production.s3.amazonaws.com/company/pHSVR4Hvc7abvaVqPG3zk3tUJjbJNCdEMfKuCM1j.jpg" alt="" class="drop-img-fluid rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">Anthony Mills</div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="avatar-xxs flex-shrink-0 me-2">
                                                    <img src="https://fitnessity-production.s3.amazonaws.com/customer/Pj5DKQgqQZvsvjBEQokyaKtuHHNHEmv0xTExXX2D.jpg" alt="" class="drop-img-fluid rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">Marian Angel</div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="avatar-xxs flex-shrink-0 me-2">
                                                    <img src="https://fitnessity-production.s3.amazonaws.com/customer/ruxB4qnxpKeKcsWtUCGnihFs5AEuMLOF5qWh16rB.jpg" alt="" class="drop-img-fluid rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">Johnnie Walton</div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="avatar-xxs flex-shrink-0 me-2">
                                                    <img src="https://fitnessity-production.s3.amazonaws.com/company/pHSVR4Hvc7abvaVqPG3zk3tUJjbJNCdEMfKuCM1j.jpg" alt="" class="drop-img-fluid rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">Donna Weston</div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="avatar-xxs flex-shrink-0 me-2">
                                                    <img src="https://fitnessity-production.s3.amazonaws.com/customer/Pj5DKQgqQZvsvjBEQokyaKtuHHNHEmv0xTExXX2D.jpg" alt="" class="drop-img-fluid rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">Diego Norris</div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 mb-3">
                        <div class="col-lg-6">
                            <label for="task-status" class="form-label">Status</label>
                            <select class="form-control" data-choices data-choices-search-false id="task-status-input">
                                <option value="">Status</option>
                                <option value="New" selected>New</option>
                                <option value="Inprogress">Inprogress</option>
                                <option value="Pending">Pending</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                        <!--end col-->
                        <div class="col-lg-6">
                            <label for="priority-field" class="form-label">Priority</label>
                            <select class="form-control" data-choices data-choices-search-false id="priority-field">
                                <option value="">Priority</option>
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </select>
                        </div>
                        <!--end col-->
                    </div>
                    <div class="mb-4">
                        <label for="task-duedate-input" class="form-label">Due Date:</label>
                        <input type="text" class="form-control flatpickr" data-provider="flatpickr" id="JoiningdatInput" data-date-format="d M, Y" data-deafult-date="24 Nov, 2021" placeholder="Due date" />
                    </div>

                    <div class="hstack gap-2 justify-content-end">
                        <button type="submit" class="btn btn-red" id="addNewTodo">Add Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



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

<script>
		 flatpickr(".flatpickr", {
	        dateFormat: "m/d/Y",
	        maxDate: "01/01/2050",
			defaultDate: [new Date()],
	     });
			 
</script>
@endsection