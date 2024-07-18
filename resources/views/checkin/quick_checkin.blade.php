@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.business.new-header')


	<div class="">
    
        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                   <div class="col-lg-6 back-check-img check-in-page"  style="background-image:url('{{$imageUrl}}')">
                        <div class="card-check-in p-relative h-100">
                            <div class="pb-60 text-center">
                                <a href="#" class="register-check">
                                    <img src="{{$logoUrl}}" alt="logo">
                                </a>
                            </div>  
                            <div class="welcome-provider text-center">
                                <h3>Welcome to</h3>
                                <span>{{$business->company_name}}</span>
                                <p>Please enter your unique 4-digit code to log in. </p>
                            </div>  
                            <div class="self-check-arrow">
                                <a href="{{route('check-in-welcome')}}"><i class="fas fa-long-arrow-alt-left"></i></a>
                            </div>  
                        </div>
                    </div>
                    <div class="col-lg-6 nopadding check-in-page">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-white">
                            <div class="page-heading text-right">
                                <label class="mr-10">
                                <a class="btn btn-red" href="{{route('check-in-welcome')}}"  
                                    style="background-color: {{ $settings ? $settings->digit_screen_color : '' }}; 
                                           border-color: {{ $settings ? $settings->digit_screen_color : '' }};">
                                     Finish
                                 </a>
                                </label>
                                <label class="mr-10">
                                    {{-- <a class="btn btn-red" href="{{route('checkin.check_out' ,['type' => 1])}}">Exit</a> --}}
                                    <a class="btn btn-red"  data-bs-toggle="modal" data-bs-target=".exitModal"  
                                        style="background-color: {{ $settings ? $settings->digit_screen_color : '' }}; 
                                               border-color: {{ $settings ? $settings->digit_screen_color : '' }};">
                                         Exit
                                     </a>

                                     {{-- <label class="mb-15"><a type="button" class="btn btn-red" data-bs-toggle="modal" data-bs-target=".exitModal">Exit</a></label> --}}

                                </label>
                            </div>
                        </div>

                        <div class="card-check-in bg-white">
                            <div class="text-center">
                                <label class="fs-16 m-b-50 font-red" style="color: {{ $settings ? $settings->digit_screen_color : '' }};">Already have an account?</label>
                            </div>
                            <div class="text-center reg-up-img">
                                <div class="mb-3">
                                    <img src="{{url('/dashboard-design/images/u-login.png')}}" alt="logo">
                                </div>
                            </div>
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-xxl-6 col-lg-7">
                                        <div class="or-text p-relative pt-15 pb-15">
                                            <div class="mb-3">
                                                <button type="button" class="btn-red-primary btn-red mt-25 w-100" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color: {{ $settings ? $settings->digit_screen_color : '' }}; 
                                               border-color: {{ $settings ? $settings->digit_screen_color : '' }};">Enter a quick four digit code </button>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

	</div><!-- End Page-content -->
</div><!-- END layout-wrapper -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-bs-backdrop="static" >
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" onclick="window.location.reload()"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-20">
			        <h2 class="font-red">Check-In</h2>
			    </div>
			    <div class="d-flex justify-content-center mb-20">
				    <input type="text" class="form-control w-50 numberfield" id="numberInput" placeholder="Enter check-in code.." onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
				</div>
			    <div class="container">
				    <div id="pincode_check">
					    <div class="table">
						    <div class="">
							    <div class="numbers_check" id="numbers_check">
								    <div class="grid">
										<div class="grid__col grid__col--1-of-3"><button>1</button></div>
										<div class="grid__col grid__col--1-of-3"><button>2</button></div>
										<div class="grid__col grid__col--1-of-3"><button>3</button></div>

										<div class="grid__col grid__col--1-of-3"><button>4</button></div>
										<div class="grid__col grid__col--1-of-3"><button>5</button></div>
										<div class="grid__col grid__col--1-of-3"><button>6</button></div>

										<div class="grid__col grid__col--1-of-3"><button>7</button></div>
										<div class="grid__col grid__col--1-of-3"><button>8</button></div>
										<div class="grid__col grid__col--1-of-3"><button>9</button></div>

										<div class="grid__col grid__col--1-of-3"></div>
										<div class="grid__col grid__col--1-of-3"><button>0</button></div>
										<div class="grid__col grid__col--1-of-3"><button class="fs-20"><i class="fas fa-backspace"></i></button></div>
							        </div>
						        </div>
						    </div>
					    </div>
				    </div>
			    </div>	

                <div class="text-center text-danger" id="error-message"></div>				
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-red" id="checkInButton">Check In</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Exit Check-In Portal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="fs-15">To deactivate the check-in portal , a staff member must enter their password. You are currently logged in as Ankita Patel.</p>
                <input type="password" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-red" data-bs-dismiss="modal">Exit Check-In Portal </button>
            </div>
        </div>
    </div>
</div>



{{-- my code start --}}

<div class="modal fade exitModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" onclick="window.location.reload()"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-20">
                    <h2 class="font-red">Exit Check-In Mode</h2>
                    <p>To deactivate check-in mode, please enter your staff passcode</p>
                </div>
                <div class="d-flex justify-content-center mb-20">
                    <input type="text" class="form-control w-50 numberfield" id="numberexitInput" placeholder="Enter 4 digit code.." onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                </div>
                <div class="container">
                    <div id="pincode_check">
                        <div class="table">
                            <div class="">
                                <div class="numbers_check" id="numbers_check_exit">
                                    <div class="grid">
                                        <div class="grid__col grid__col--1-of-3"><button>1</button></div>
                                        <div class="grid__col grid__col--1-of-3"><button>2</button></div>
                                        <div class="grid__col grid__col--1-of-3"><button>3</button></div>

                                        <div class="grid__col grid__col--1-of-3"><button>4</button></div>
                                        <div class="grid__col grid__col--1-of-3"><button>5</button></div>
                                        <div class="grid__col grid__col--1-of-3"><button>6</button></div>

                                        <div class="grid__col grid__col--1-of-3"><button>7</button></div>
                                        <div class="grid__col grid__col--1-of-3"><button>8</button></div>
                                        <div class="grid__col grid__col--1-of-3"><button>9</button></div>

                                        <div class="grid__col grid__col--1-of-3"></div>
                                        <div class="grid__col grid__col--1-of-3"><button>0</button></div>
                                        <div class="grid__col grid__col--1-of-3"><button class="fs-20"><i class="fas fa-backspace"></i></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>	

                <div class="text-center text-danger fs-16" id="error-message-code"></div>	
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-red" id="checkInExit">Exit</button>
            </div>
        </div>
      </div>
</div>
<audio id="success-sound" src="{{ asset('music/success.mp3') }}" preload="auto"></audio>
<audio id="failure-sound" src="{{ asset('music/failure.mp3') }}" preload="auto"></audio>

@php
$company_data = Auth::user()->current_company;
	$playSoundValues = [];
    
    if (!empty($company_data)) {
        $data = App\BusinessCheckinSettings::where('business_id', $company_data->id)->first();
        if ($data) {
            $playSoundValues = explode(',', $data->play_sound);
        }
    }
@endphp
<script>
    var playSoundValues = @json($playSoundValues);
</script>
{{-- ends --}}
@include('layouts.business.footer')

<script>
    jQuery(document).ready(function ($) {
        var pin = +!![] + [] + (!+[] + !![] + []) + (!+[] + !![] + !![] + []) + (!+[] + !![] + !![] + !![] + []);
        
        $("#numbers_check button").click(function () {
            var enterCode = $("#numberInput").val();
            enterCode.toString();
            var clickedNumber = $(this).text().toString();
           
            if(clickedNumber != ''){
                enterCode = enterCode + clickedNumber;
                // Update the input field
                $("#numberInput").val(enterCode);

                var lengthCode = parseInt(enterCode.length);
                lengthCode--;
                $("#fields .numberfield:eq(" + lengthCode + ")").addClass("active");
       
                if (lengthCode > 3) {
                    $("#numberInput").val(clickedNumber);
                }
            }else{
                var originalString = $('#numberInput').val();
                $('#numberInput').val(originalString.slice(0, -1));
            }
        });
    });
 </script>
<script>
    jQuery(document).ready(function ($) {
        var pin = +!![] + [] + (!+[] + !![] + []) + (!+[] + !![] + !![] + []) + (!+[] + !![] + !![] + !![] + []);
        
        $("#numbers_check_exit button").click(function () {
            var enterCode = $("#numberexitInput").val();
            enterCode.toString();
            var clickedNumber = $(this).text().toString();
           
            if(clickedNumber != ''){
                enterCode = enterCode + clickedNumber;
                // Update the input field
                $("#numberexitInput").val(enterCode);

                var lengthCode = parseInt(enterCode.length);
                lengthCode--;
                $("#fields .numberfield:eq(" + lengthCode + ")").addClass("active");
       
                if (lengthCode > 3) {
                    $("#numberexitInput").val(clickedNumber);
                }
            }else{
                var originalString = $('#numberexitInput').val();
                $('#numberexitInput').val(originalString.slice(0, -1));
            }
        });
    });
 </script>
<script type="text/javascript">
    
    $(document).ready(function() {
        $('#checkInButton').click(function(e) {
            e.preventDefault();
            $('#error-message').removeClass('text-success text-danger').html('');
            var checkInCode = $('#numberInput').val();
            if (checkInCode === '') {
                $('#error-message').text('Please enter a check-in code.');
                return;
            }

            $.ajax({
                url: "{{route('quick-login-for-check-in')}}", 
                type: 'POST',
                data: {
                    code: checkInCode,
                    _token: '{{ csrf_token() }}'  
                },
                success: function(response) {
                    if (response.success) {
                        //$('#error-message').addClass('text-success').text('Login successful!');
                        $('#checkInButton').text('Loading...');
                        $('#numberInput').val('');
                        $('#exampleModal').modal('hide');  // Hide the modal
                        if (playSoundValues.includes('success') && !playSoundValues.includes('none')) {
                                var successSound = document.getElementById('success-sound');
                                successSound.play();
                         }
                        window.location.href = response.url
                    } else {
                        if (playSoundValues.includes('fail') && !playSoundValues.includes('none')) {
                            var failuresound = document.getElementById('failure-sound');
                            failuresound.play();
                        }
                        $('#error-message').addClass('text-danger').text(response.message || 'An error occurred. Please try again.');
                    }
                },
                error: function(xhr, status, error) {
                    if (playSoundValues.includes('fail') && !playSoundValues.includes('none')) {
                        var failuresound = document.getElementById('failure-sound');
                        failuresound.play();
                    }
                    $('#error-message').addClass('text-danger').text('An error occurred. Please try again.');
                }
            });
        });
    });
</script>


{{-- added by me start--}}

<script type="text/javascript">
    
    $(document).ready(function() {
        $('#checkInExit').click(function(e) {
            e.preventDefault();
            $('#error-message-code').removeClass('text-success text-danger').html('');
            var checkInCode = $('#numberInput').val();
            if (checkInCode === '') {
                $('#error-message-code').addClass('text-danger').text('Please enter a 4 digit code.');
                return;
            }

            $.ajax({
                url: "{{route('checkin.chk-chckin-code')}}", 
                type: 'POST',
                data: {
                    code: checkInCode,
                    _token: '{{ csrf_token() }}'  
                },
                success: function(response) {
                    if (response.success) {
                    	$('#error-message-code').addClass('text-success').text(response.message || 'An error occurred. Please try again.');
                        window.location.href = response.url
                    } else {
                    	$('#numberInput').val('');
                        $('#error-message-code').addClass('text-danger').text(response.message || 'An error occurred. Please try again.');
                    }
                },
                error: function(xhr, status, error) {
                	$('#numberInput').val('');
                    $('#error-message-code').addClass('text-danger').text('An error occurred. Please try again.');
                }
            });
        });
    });

</script>



<script type="text/javascript">
    
    $(document).ready(function() {
        $('#checkInExit').click(function(e) {
            e.preventDefault();
            $('#error-message-code').removeClass('text-success text-danger').html('');
            var checkInCode = $('#numberexitInput').val();
            if (checkInCode === '') {
                $('#error-message-code').addClass('text-danger').text('Please enter a 4 digit code.');
                return;
            }

            $.ajax({
                url: "{{route('checkin.chk-chckin-code_exit')}}", 
                type: 'POST',
                data: {
                    code: checkInCode,
                    _token: '{{ csrf_token() }}'  
                },
                success: function(response) {
                    if (response.success) {
                    	$('#error-message-code').addClass('text-success').text(response.message || 'An error occurred. Please try again.');
                     
                    
                        window.location.href = response.url
                    } else {
                    	$('#numberexitInput').val('');
                        $('#error-message-code').addClass('text-danger').text(response.message || 'An error occurred. Please try again.');
                       
                    }
                },
                error: function(xhr, status, error) {
                	$('#numberexitInput').val('');
                    $('#error-message-code').addClass('text-danger').text('An error occurred. Please try again.');
                   
                }
            });
        });
    });

</script>


{{-- ends --}}
@endsection