<html>

<?php   $url = env('APP_URL');
        $urlfeedback = $url.'feedback';
        $urlprofile = $url.'createNewBusinessProfile';
        $back_bg_img =$url.'public/img/bg_email.png';
        $img1 = $url.'public/img/img-1_email.png';
        $img2 = $url.'public/img/img-2_email.png';
        $img3 = $url.'public/img/img-3_email.png';
        $viewprofile = $url.'businessprofile/'.strtolower(str_replace(' ', '', @$AllDetail["company_data"]["dba_business_name"])).'/'.@$AllDetail["company_data"]["id"];
?>
<body width="100%" style="margin: 0; padding: 0 !important; background-color:#ede9e6; margin:0 auto!important; padding:0!important; height:100%!important; width:100%!important; font-family:Poppins,Arial,sans-serif">

    <center role="article" aria-roledescription="email" lang="en" style="width: 100%;">
        <div style="background-color:#ede9e6;">
            <table height="100%" width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td valign="top" align="left"  style="padding:35px 10px">
                        <div style="max-width: 680px; margin: 0 auto;">

                             <table height="100%" width="100%" cellpadding="0" cellspacing="0" border="0">
                               
                                <tr>
                                    <td  style="padding:25px 0px 0px;  background: #fff;;">
                                        <!-- Email Body : BEGIN -->
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
											<!-- Email Header : BEGIN -->
                                            <tr>
                                               <td style="padding: 0  0 18px 15px; text-align: left;">
													<span style="color: black;">Welcome to Fitnessity for Business</span>
                                                </td>
                                            </tr>
                                            <!-- Email Header : END -->
                                            <!-- BEGIN -->
                                            <tr>
                                                <td style="padding:0px 0px 0px">
                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td style="text-align: center; background-color: #000;">
                                                                <div>
                                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                        <tr>
                                                                            <td style="text-align: left; padding: 25px; font-size: 13px; ">
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <!-- END -->
											
											<!-- BEGIN -->
                                            <tr>
												<td style="text-align: center; background-image: url({{$back_bg_img}}); background-repeat: no-repeat; background-position: center; padding: 35px 15px 35px;">
                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td>
                                                                <div>
                                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
																		<tr>
																			<td style="text-align: center; padding: 45px 0px 30px 0px;">
																				<img src="{{$url}}/public/img/fintessity-logo.png" width="525"  alt="logo" border="0" style="height: auto;">
                                                                            </td>
																		</tr>
																		<tr><td><a href="{{$viewprofile}}" style="background: #ef1313; border: none; font-family: 'Poppins' ,sans-serif; font-size: 16px; line-height: 25px; text-decoration: none; padding: 10px 0px; color: #ffffff; display: block; border-radius: 0; font-weight: 500; margin: auto; width:30%; height: 25px; margin-bottom: 30px; margin-top: 30px; border-radius: 10px; text-align: center;">View Business Profile</a></td></tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <!-- END -->
											
											<!-- BEGIN -->
                                            <tr>
                                                <td style="padding:0px 0px 0px">
                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td style="background-color: #ef1313;">
                                                                <div>
                                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                        <tr>
                                                                            <td style="padding: 10px 15px 14px 15px;" align="center">
																				<p style="font-weight: 500; font-size: 20px; color: #fff; margin: 10px 0px 10px 0px">Are you in the business of keeping people active?     </p>
																				<p style="font-weight: 400; font-size: 11px; color: #fff; margin-bottom: 0px; margin-top: 0px; text-align: center;">If you operate a business that offeres a type of service that keeps people active, then Fitnessity is for you! Fitnessity was design to make the process of searching, comparing, reveiwing, and booking activities seemeless. Finally, one one platform that allows users to book from trainers to coaches, classes to therapist, adventures and tours. </p>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <!-- END -->
											
                                            <!-- BEGIN -->
                                            <tr>
                                                <td style=" padding:23px 10px 23px; text-align: center" align="center">
                                                    <h6 style="font-size: 18px; font-weight: 500; color: #000;margin-bottom: 0px; text-decoration: underline #ef1313 2px;">HERES ARE SOME POINTERS TO GETTING STARTED </h6>
                                                </td>
                                            </tr>
                                            <!-- END -->
											
											  <!-- Thumbnail Left, Text Right : BEGIN -->
                                                <tr>
                                                   
                                                    <td dir="ltr" height="100%" valign="top" width="100%" style="font-size:0; padding: 0px 0;  text-align: center; " align="center" valign="center">
                                                       
                                                        <div style="display:inline-block; margin: 0 -1px; max-width: 298px; min-width:160px; vertical-align:top; width:100%;">
                                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                <tr>
                                                                    <td dir="ltr" style="padding: 70px 10px 10px 10px;">
                                                                        <a href="#" style="text-decoration:none;border:0;line-height:0; display: block"><img src="{{$img1}}" width="276" height="" border="0" alt="alt_text" style="width: 100%; max-width: 260px; height: auto; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;"></a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                       
                                                        <div style="display:inline-block; margin: 0 -1px; max-width: 340px; min-width:160px; vertical-align:top;">
                                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="border-spacing:0!important;  border-collapse:collapse!important; table-layout:fixed!important;   margin:0 auto!important">
                                                                <tr>
                                                                    <td dir="ltr" style="font-family: sans-serif; font-size: 15px; line-height: 45px; color: #555555; padding: 15px 15px; text-align: left; height: 90px;" align="center" valign="center">
                                                                        <h2 style="margin: 0 0 5px 0; font-family: 'Poppins',sans-serif; font-size: 15px; line-height: 25px; color: black; font-weight: 500;">Step 1: Tell Us Customers About Yourself  </h2>
                                                                        <h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 18px; color: black; font-weight: 300; padding: 0px 15px 5px 0px;">From your manage business section, upload all the information about your business and fully complete and populate your profile. List the different types of services and prices you offer your clients for free. Customers will be able to find and book you from your business profile and from additional search options. Share your experiences on the only dedicated social network for the fitness industry.</h2>
                                                                        <!-- Button : BEGIN -->
                                                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="border-spacing:0!important;  border-collapse:collapse!important;  table-layout:fixed!important;  ">
                                                                            <tr>
                                                                                <td style="border-radius: 0; background: #ffffff;">
                                                                                    <a href="{{$urlprofile}}" style="background: #ef1313; font-weight:bold; font-family: sans-serif; font-size: 15px; line-height: 14px; text-decoration: none; padding: 10px 14px; color: #fff; display: block; border-radius: 8px;">Go to Profile</a>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                        <!-- Button : END -->
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                      
                                                    </td>
                                                </tr>
                                                <!-- Thumbnail Left, Text Right : END -->
												
												<!-- Thumbnail Right, Text Left : BEGIN -->
                                                <tr>
                                                   
                                                    <td dir="rtl" height="100%" valign="top" width="100%" style="font-size:0; padding: 10px 0; text-align: center; " align="center" valign="center">
                                                       
                                                        <div style="display:inline-block; margin: 0 -1px; max-width: 285px; min-width:200px; vertical-align:top; width:100%;">
                                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                <tr>
                                                                    <td dir="ltr" style="padding: 68px 25px 72px 25px;;">
                                                                        <a href="#" style="text-decoration:none;border:0;line-height:0; display: block"><img src="{{$img2}}" width="376" height="" border="0" alt="alt_text" style="width: 100%; height: auto; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;"></a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                      
                                                        <div style="display:inline-block; margin: 0 -1px; max-width: 360px; min-width:200px; vertical-align:top;">
                                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="border-spacing:0!important; border-collapse:collapse!important;  table-layout:fixed!important;   margin:0 auto!important">
                                                                <tr>
                                                                    <td dir="ltr" style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 15px 15px; text-align: left; height: 243px;">
																	<h2 style="margin: 0 0 5px 0; font-family: 'Poppins',sans-serif; font-size: 15px; line-height: 25px; color: black; font-weight: 500;">Step 2: Tell Us How You Want To Get Paid</h2>
                                                                       <h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 18px; color: black; font-weight: 300;">From your manage business sections, you can access your financial dashboard. To start receiving your payments, you need to complete the steps to tell the platform how you want to get paid. We use Stripe as the 3rd party payment gateway. If you don’t complete this step, we can’t send you the money you have earned.</h2>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- Thumbnail Right, Text Left : END -->
												
											<!-- Thumbnail Left, Text Right : BEGIN -->
                                                <tr>
                                                   
                                                    <td dir="ltr" height="100%" valign="top" width="100%" style="font-size:0; padding: 0px 0px 30px 0;  text-align: center; " align="center" valign="center">
                                                       
                                                        <div style="display:inline-block; margin: 0 -1px; max-width: 298px; min-width:160px; vertical-align:top; width:100%;">
                                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                <tr>
                                                                    <td dir="ltr" style="padding: 20px 10px 10px 10px;">
                                                                        <a href="#" style="text-decoration:none;border:0;line-height:0; display: block"><img src="{{$img3}}" width="276" height="" border="0" alt="alt_text" style="width: 100%; max-width: 260px; height: auto; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;"></a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                       
                                                        <div style="display:inline-block; margin: 0 -1px; max-width: 340px; min-width:160px; vertical-align:top;">
                                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="border-spacing:0!important;  border-collapse:collapse!important; table-layout:fixed!important;   margin:0 auto!important">
                                                                <tr>
                                                                    <td dir="ltr" style="font-family: sans-serif; font-size: 15px; line-height: 45px; color: #555555; padding: 15px 15px; text-align: left; height: 90px;" align="center" valign="center">
                                                                        <h2 style="margin: 0 0 5px 0; font-family: 'Poppins',sans-serif; font-size: 15px; line-height: 25px; color: #ef1313; font-weight: 500;">Whats Coming Next?</h2>
                                                                        <h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 18px; color: black; font-weight: 300; padding: 0px 15px 5px 0px;">Sell or Rent Equipment, Apparel, Gear, Live & On Demand Workouts, Controld your business better with a CRM customer management software (similar to mindbody) Direct messaging system, a better social media platform, apps and more. (All features coming soon.) </h2>
																		<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 18px; color: black; font-weight: 300; padding: 0px 15px 5px 0px;">We appreaciate your feedback. To help us improve or you have an idea or a recomendations, please don’t hesitate to let us know. </h2>
                                                                        <!-- Button : BEGIN -->
                                                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="border-spacing:0!important;  border-collapse:collapse!important;  table-layout:fixed!important;  ">
                                                                            <tr>
                                                                                <td style="border-radius: 0; background: #ffffff;">
                                                                                    <a href="{{$urlfeedback}}" style="background: #ef1313; font-weight:bold; font-family: sans-serif; font-size: 15px; line-height: 14px; text-decoration: none; padding: 10px 14px; color: #fff; display: block; border-radius: 8px;">Send Feedback</a>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                        <!-- Button : END -->
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                      
                                                    </td>
                                                </tr>
                                                <!-- Thumbnail Left, Text Right : END -->

											<!-- Follow us: START -->
                                                <tr>
                                                    <td style=" padding: 15px 10px; background: black;">
                                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" class="follow-us">
                                                            
                                                            <tr>
                                                                <td>
                                                                    <table role="presentation" align="center" cellspacing="0" cellpadding="0" border="0">
                                                                        <tr>
                                                                            <td width="42" style="padding: 10px 20px;" align="center" valign="middle">
                                                                                <a href="{{$url}}"  ><img src="{{$url}}/public/img/fit_email.png" alt="fitnessity" width="40" height="40" ></a>
                                                                            </td>
                                                                            <td width="42" style="padding: 10px 20px;" align="center" valign="middle">
                                                                                <a href="https://www.instagram.com/fitnessityofficial/?hl=en"  ><img src="{{$url}}/public/img/insta_email.png" alt="instagram" width="40" height="40" ></a>
                                                                            </td>
                                                                            <td width="42" style="padding: 10px 20px;" align="center" valign="middle">
                                                                                <a href="https://twitter.com/Fitnessitynyc"  ><img src="{{$url}}/public/img/twitter_email.png" alt="twitter" width="40" height="40" ></a>
                                                                            </td>
                                                                            <td width="42" style="padding: 10px 20px;" align="center" valign="middle">
                                                                                <a href="https://www.facebook.com/fitnessityofficial"  ><img src="{{$url}}/public/img/fb_email.png" alt="facebook" width="40" height="40" ></a>
                                                                            </td>
                                                                            
                                                                        </tr>
                                                                    </table>
																	<h5 style="color: white; text-align: center; font-weight: 400; margin-top: 0px; margin-bottom: 7px;">{{$url}}  contact@fitnessity.co | HQ New York, NY</h5>
                                                                </td>

                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <!-- Follow us: END -->

                                        </table>
                                        <!-- Email Body : END -->
                                    </td>
                                </tr>
                               
                            </table>
                        
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </center>
</body>
</html>