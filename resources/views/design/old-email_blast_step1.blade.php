@inject('request', 'Illuminate\Http\Request')

@extends('layouts.business.header')

@section('content')

@include('layouts.business.business_topbar')

        <!-- ========================= Main ==================== -->
        @include('business.engage-clients.engage_clients_sidebar')
        <link href="http://dev.fitnessity.co//public/dashboard-design/drag-and-drop/assets/frameworks/foundation-emails/css/app.css" rel="stylesheet" type="text/css" />
        <link href="http://dev.fitnessity.co//public/dashboard-design/drag-and-drop/nlbuilder/newsletterbuilder.css" rel="stylesheet" type="text/css" /> 
         
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-black mb-15" id="menu-toggle"><i class="fas fa-bars"></i></a>

                <div class="card">
                    <div class="card-body">
                        <div class="mb-35">
                            <div class="row y-middle">
                                <div class="col-lg-2">
                                    <div class="text-left">
                                        <a href="#" class="btn btn-red mr-5"> Back  </a> 
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="text-center">
                                        <label>Step 1 to 4: Create blast email</label>
                                        <h3>Choose a template</h3>
                                    </div>
                                </div>
                                    
                                <div class="col-lg-2">
                                    <div class="text-right">
                                        <a href="#" class="btn btn-red mr-5"> Next Step  </a> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio w-100">
                                        <input type="radio" name="radio" checked>
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                            <img src="http://dev.fitnessity.co/public/dashboard-design/images/temp-1.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio  w-100">
                                        <input type="radio" name="radio" >
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="http://dev.fitnessity.co/public/dashboard-design/images/temp-2.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio  w-100">
                                        <input type="radio" name="radio" >
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="http://dev.fitnessity.co/public/dashboard-design/images/temp-3.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio  w-100">
                                        <input type="radio" name="radio" >
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="http://dev.fitnessity.co/public/dashboard-design/images/temp-4.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>
                          
                        </div>
                      

                    </div>
                    <!-- end card header -->
                </div>
                <!-- end card -->
            </div>

            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-black mb-15" id="menu-toggle"><i class="fas fa-bars"></i></a>

                <div class="card">
                    <div class="card-body">
                      
                        <form id="form1" style="display:none">
                            <input type="hidden" id="inpHtml" name="inpHtml" />
                            <button type="submit" id="btnPost">Preview</button>
                        </form>
                        <!-- <div class="is-tool" style="display:block;">
                            <button id="btnSave" class="classic" style="width:auto;height:50px;">Preview</button>
                        </div> -->
                        <div class="row">
                            <div class="col-lg-12">
                                <button href="#" class="btn btn-black mb-15" >Save & Continue</button>
                                <button href="#" class="btn btn-black mb-15" >Save and Exit</button>
                                <button href="#" class="btn btn-black mb-15" >Save and Exit</button>
                                <button href="#" class="btn btn-black mb-15" >Preview</button>
                                <button href="#" class="btn btn-black mb-15" >Undo</button>
                                <button href="#" class="btn btn-black mb-15" >Redo</button>
                                <button href="#" class="btn btn-black mb-15" >Restart</button>
                                <button href="#" class="btn btn-black mb-15" >Exit without saving </button>
                            </div>
                        </div>

                        <table class="body" data-made-with-foundation="" style="margin-top:50px">
                            <tr>
                                <td class="float-center" align="center" valign="top">
                                    <center data-parsed="">
                                        <table align="center" class="container float-center">
                                            <tbody>
                                                <tr>
                                                    <td id="contentarea" class="is-container">

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </center>
                                </td>
                            </tr>
                        </table>
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

<script src="http://dev.fitnessity.co//public/dashboard-design/drag-and-drop/nlbuilder/newsletterbuilder.min.js" type="text/javascript"></script>
<script src="http://dev.fitnessity.co//public/dashboard-design/drag-and-drop/assets/email-blocks/content-inlined.js" type="text/javascript"></script>


@include('layouts.business.footer')
<script type="text/javascript">
	var builder = new NewsletterBuilder({
		container: '#contentarea',
		snippetData: '/dashboard-design/drag-and-drop/assets/email-blocks/snippetlist.html',
		rowFormat: '<div><table align="center" class="container float-center"><tbody><tr><td><table class="row"><tbody><tr>' +
		  '</tr></tbody></table></td></tr></tbody></table></div>',
		cellFormat: '<th class="small-12 large-12 columns first last"><table><tbody><tr><th>' +
		  '</th></tr></tbody></table></th>',
		customTags: [["First Name", "{%first_name%}"],
		  ["Last Name", "{%last_name%}"],
		  ["Email", "{%email%}"]],
		emailMode: true,
		absolutePath: true,
		snippetOpen: true,
		buttonsMore: ['icon', 'image', '|', 'list', 'font', 'formatPara']
	});
	
	var btnSave = document.querySelector('#btnSave');
	
	btnSave.addEventListener('click', (e) => {
    builder.saveImages('saveimage.php', function(){
        
        //Get html
        var html = builder.html(); //Get content

        //Submit the html to the server for saving. For example, if you're using html form:
        document.querySelector('#inpHtml').value = html;
        document.querySelector('#btnPost').click();

    });

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