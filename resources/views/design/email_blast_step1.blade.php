@inject('request', 'Illuminate\Http\Request')

@extends('layouts.business.header')

@section('content')

@include('layouts.business.business_topbar')

        <!-- ========================= Main ==================== -->
        @include('business.engage-clients.engage_clients_sidebar')
        <!-- <link href="http://dev.fitnessity.co//public/dashboard-design/drag-and-drop/assets/css/app.css" rel="stylesheet" type="text/css" /> -->
        <link href="http://dev.fitnessity.co//public/dashboard-design/drag-and-drop/assets/css/newsletterbuilder.css" rel="stylesheet" type="text/css" /> 
        <style>
            #btnSave{
                font-family: Helvetica, Arial, sans-serif;
                font-size: 16px;
                font-weight: bold;
                color: #ffffff;
                text-decoration: none;
                display: inline-block;
                padding: 8px 16px 8px 16px;
                border: 0 solid #2199e8;
                margin: 10px 0 0 10px;
                background-color: #2199e8;
            }
            .is-selectbox{background: #2199e8;color: #ffffff;}
            .is-selectbox:hover {background: #2199e8;}
            .is-selectbox .is-icon-flex{fill: rgba(255, 255, 255, 0.9);}
        </style>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-black mb-15" id="menu-toggle"><i class="fas fa-bars"></i></a>

                <div class="card">
                    <div class="card-body">
                      
                        <form id="form1" method="post" style="display:none">
                            <input type="hidden" id="inpHtml" name="inpHtml" />
                            <button type="submit" id="btnPost">Preview</button>
                        </form>
                        <div class="is-tool" style="position:fixed;display:block;">
                            <button id="btnSave" class="classic" style="width:auto;height:50px;">Preview</button>
                        </div>

                        <table class="body" data-made-with-foundation="" style="margin-top:105px">
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

<link href="http://dev.fitnessity.co//public/dashboard-design/drag-and-drop/assets/js/newsletterbuilder.min.js" rel="stylesheet" type="text/css" />
<link href="http://dev.fitnessity.co//public/dashboard-design/drag-and-drop/assets/js/content-inlined.js" rel="stylesheet" type="text/css" />


@include('layouts.business.footer')


<script type="text/javascript">
	var builder = new NewsletterBuilder({
		container: '#contentarea',
		snippetData: 'assets/email-blocks/snippetlist.html',
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