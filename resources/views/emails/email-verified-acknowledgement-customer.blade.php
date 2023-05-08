<!DOCTYPE html>
<html>

<?php  
    
        $businessname=$businessdata->dba_business_name;
        $custmername = @$user->fname.' '.@$user->lname;
        $company_name = $businessdata->dba_business_name;
        $provider_name =$businessdata->first_name.' '.$businessdata->last_name;
        $businessimg = $businessdata->logo;
        $url = env('APP_URL');
        $urlfeedback = $url.'feedback';
       // $urlprofile = $url.'profile/viewProfile';
         $urlprofile = '#';
        $img1 = $url.'public/img/img-1_email.png';
        $img2 = $url.'public/img/book_email.png';
        $img3 = $url.'public/img/img-3_email.png';
        $bookactivity = $url.'activities';
        $COM_NAME = strtolower(str_replace(' ', '-', $businessdata->dba_business_name)).'/'.$businessdata->id;
        $providerurl = $url.'/businessprofile/'.$COM_NAME;
       
?>
    <body width="100%" style="margin: 0; padding: 0 !important; background-color:#ede9e6; margin:0 auto!important; padding:0!important; height:100%!important; width:100%!important; font-family:Poppins,Arial,sans-serif">

        <center role="article" aria-roledescription="email" lang="en" style="width: 100%;">
            <div style="background-color:#ede9e6;">
                    <table height="100%" width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td valign="top" align="left"  style="padding:35px 10px">
                            <div style="max-width: 730px; margin: 0 auto;">

                                 <table height="100%" width="100%" cellpadding="0" cellspacing="0" border="0">
                                   
                                    <tr>
                                        <td  style="padding:21px 0px 0px;  background: #fff;">
                                            <!-- Email Body : BEGIN -->
                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                                                <!-- Email Header : BEGIN -->
                                                <tr>
                                                    <td style="padding: 0  0 18px 10px; text-align: left;">
                                                     <span style="color: black;">Welcome to {{$businessname}}</span>
                                                    </td>
                                                </tr>
                                                <!-- Email Header : END -->

                                               
                                                <!-- Background Image with Text : BEGIN -->
                                                <tr>
                                                    <td style="padding:0px 0px 0px">
                                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                            <tr>
                                                                <td style="text-align: center; background-color: black;">
                                                                    <div>
                                                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                            <tr>
                                                                                <td style="text-align: center; padding: 8px 20px 0px;" align="center">
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <!-- Background Image with Text : END -->
                                                
                                                <!-- Banner Image with Text : BEGIN -->
                                                <tr>
                                                    <td style="padding:0px 0px 0px">
                                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                            <tr>
                                                                <td style="text-align: center; background-color: #fff;">
                                                                    <div>
                                                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                            <tr>
                                                                                <td dir="ltr" style="padding: 20px 10px 0px 10px;">
                                                                                    <a href="#" style="text-decoration:none;border:0;line-height:0; display: block">
                                                                            <?php if( $businessimg == ''){
                                                                                $char = substr($businessname, 0, 1);
                                                                            ?>
                                                                                <div class="company-list-text" style="width: 70px; height: 70px; display: inline-block;border-radius: 100%;overflow: hidden;border: 3px solid #ddd; vertical-align: middle; background-color: #ea1515;">
                                                                                    <p style="
                                                                                        font-size: 20px;
                                                                                        text-align: center;
                                                                                        padding: 20% 0px;
                                                                                        color: #fff;
                                                                                        font-weight: bold;
                                                                                        text-transform: uppercase;">{{@$char}}
                                                                                    </p>
                                                                                </div>

                                                                            <?php }else{
                                                                                $businessimg = $url.'/uploads/profile_pic/thumb/'.$businessimg;
                                                                            ?>
                                                                                <img src="{{$businessimg}}" width="276" height="" border="0" alt="alt_text" style="width: 100%; max-width: 70px; max-height: 70px; height: auto; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555; border-radius: 100%;" >
                                                                            <?php } ?>
                                                                            </a>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="text-align: center; padding: 0px 28px 30px;" align="center">
                                                                                    <p style="font-weight: 500; font-size: 20px; color: #000000; margin-top: 10px;">Welcome to {{$businessname}} </p>
                                                                                    <p style="font-weight: 400; font-size: 14px; color: #000000; margin-bottom: 10px; margin-top: 0px; text-align: left;">Hi {{$custmername}}!  </p>
                                                                                    <p style="font-weight: 400; font-size: 14px; color: #000000; margin-bottom: 0px; margin-top: 0px; text-align: left;">We welcome you to the {{$company_name}} family. We use Fitnessity for our management software. This allows us to manage our bookings, customer membership details, reviews, and more. To view all of your booking details and purchase history with  {{$company_name}}, check your profile page on Fitnessity under your booking info section. Please leave us a review about your experience with {{$provider_name}} here. We invite you to book more activities with us via Fitnessity.  </p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="text-align: center; padding: 0px 28px 30px;" align="center">
                                                                                    <p style="font-weight: 400; font-size: 14px; color: #000000; margin-bottom: 0px; margin-top: 0px; text-align: left;">With Fitnessity you can:   </p>
                                                                                    <ul style="text-align: left; font-size: 14px;margin-top: 0px;">
                                                                                        <li>View and post reviews. </li>
                                                                                        <li>Gain access to our services, memberships, and events.</li>
                                                                                        <li>Buy or rent our products, gear, apparel, and more</li>
                                                                                        <li>Rebook, schedule or cancel a booking at any time. </li>
                                                                                        <li>Receive reminders about upcoming appointments</li>
                                                                                        <li>Share your experience with others on the social network</li>
                                                                                    </ul>
                                                                                </td>
                                                                            </tr>
                                                                             <tr>
                                                                                <td style="border-radius: 0; background: #ffffff; padding: 0px 0px 25px 0px;">
                                                                                    <a href="#" style="background: #ef1313; font-weight:bold; font-family: sans-serif; font-size: 15px; line-height: 14px; text-decoration: none; padding: 10px 14px; color: #fff; display: inline-block; border-radius: 8px; width: 22%;">View Your Profile</a>
                                                                                    
                                                                                    <a href="{{$providerurl}}" style="background: #606060; font-weight:bold; font-family: sans-serif; font-size: 15px; line-height: 14px; text-decoration: none; padding: 10px 14px; color: #fff; display: inline-block; border-radius: 8px; width: 22%;">View Provider Profile</a>
                                                                                </td>
                                                                            </tr>
                                                                             <tr>
                                                                                <td style="border-radius: 0; background: #ffffff; padding: 0px 0px 25px 0px;">
                                                                                    <p style="margin-bottom: 0px; margin-top: 0px;"> LEARN MORE ABOUT FITNESSITY BELOW</p>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <!-- Banner Image with Text : END -->
                                                
                                                <!-- Red Background with Text : BEGIN -->
                                                <tr>
                                                    <td style="padding:0px 0px 0px">
                                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                            <tr>
                                                                <td style="text-align: center; background-color: #ef1313;">
                                                                    <div>
                                                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                            <tr>
                                                                                <td style="text-align: center; padding: 0px 30px;" align="center">
                                                                                    <h6 style="font-weight: 500; font-size: 19px; color: #fff; margin-bottom: 0px; margin-top: 15px;"> What is Fitnessity? </h6>
                                                                                    <h6 style="font-weight: 400; font-size: 15px; color: #fff; margin-top: 15px; margin-bottom: 15px;"> Fitnessity is your connection to multi-sport and wellness activities. A marketplace that simiplies the process of booking active activities online. Users can search, compare, book and rate activities from local businesses from personal trainers to coached, therapists to classes, adventures to tours. These services may be provided in person or online.</h6>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <!-- Red Background with Text : END -->
                                                
                                                <!-- Font Image : BEGIN -->
                                                <tr>
                                                    <td style=" padding:0px 10px 0px; text-align: center" align="center">
                                                        <h6 style="font-size: 21px; font-weight: 400; text-decoration: underline #ef1313 2px; margin-bottom: 15px; margin-top: 15px;">Here’s how to get started with Fitnessity<h6>
                                                    </td>
                                                </tr>
                                                <!-- Font Image : END -->

                                            
                                                <!-- Thumbnail Left, Text Right : BEGIN -->
                                                <tr>
                                                   
                                                    <td dir="ltr" height="100%" valign="top" width="100%" style="font-size:0; padding: 0px 0;  text-align: center; " align="center" valign="center">
                                                       
                                                        <div style="display:inline-block; margin: 0 -1px; max-width: 353px; min-width:160px; vertical-align:top; width:100%;">
                                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                <tr>
                                                                    <td dir="ltr" style="padding: 70px 10px 10px 10px;">
                                                                        <a href="#" style="text-decoration:none;border:0;line-height:0; display: block"><img src="{{$img1}}" width="276" height="" border="0" alt="alt_text" style="width: 100%; max-width: 290px; height: auto; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;"></a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                       
                                                        <div style="display:inline-block; margin: 0 -1px; max-width: 375px; min-width:160px; vertical-align:top;">
                                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="border-spacing:0!important;  border-collapse:collapse!important; table-layout:fixed!important;   margin:0 auto!important">
                                                                <tr>
                                                                    <td dir="ltr" style="font-family: sans-serif; font-size: 15px; line-height: 45px; color: #555555; padding: 20px 20px; text-align: left; height: 90px;" align="center" valign="center">
                                                                        <h2 style="margin: 0 0 5px 0; font-family: 'Poppins',sans-serif; font-size: 20px; line-height: 45px; color: black; font-weight: 400;">Step 1: Tell Us About Yourself  </h2>
                                                                        <h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 21px; color: black; font-weight: 300; padding: 0px 15px 5px 0px;">Let service providers, friends, family, and others get to know you better by completing your personal profile. Add your images, write a little about yourself, and add family members to your profile to simplify the booking process. Post your expriences to the only dedicated social network to the sports and wellness industry. </h2>
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
                                                       
                                                        <div style="display:inline-block; margin: 0 -1px; max-width: 353px; min-width:200px; vertical-align:top; width:100%;">
                                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                <tr>
                                                                    <td dir="ltr" style="padding: 68px 30px 72px 44px;;">
                                                                        <a href="#" style="text-decoration:none;border:0;line-height:0; display: block"><img src="{{$img2}}" width="276" height="" border="0" alt="alt_text" style="width: 100%; max-width: 200px; height: auto; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;"></a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                      
                                                        <div style="display:inline-block; margin: 0 -1px; max-width: 350px; min-width:200px; vertical-align:top;">
                                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="border-spacing:0!important; border-collapse:collapse!important;  table-layout:fixed!important;   margin:0 auto!important">
                                                                <tr>
                                                                    <td dir="ltr" style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 20px 10px; text-align: left; height: 243px;">
                                                                    <h2 style="margin: 0 0 5px 0; font-family: 'Poppins',sans-serif; font-size: 20px; line-height: 50px; color: black; font-weight: 400;">Step 2: Get Going | Book Instantly </h2>
                                                                       <h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 21px; color: black; font-weight: 300;">With the instant hire feature, you can search our database for the best activities and providers in your area. You can find and book lessons with personal trainers & coaches, find your favorite class and other ways to work out, book your next adventure or experience for your upcoming vacation, or add a little fun to your weekend. Invite friends and family to join you before you check out.</h2>
                                                                        <!-- Button : BEGIN -->
                                                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="border-spacing:0!important;   border-collapse:collapse!important; margin:0 !important; text-align: left; padding: 0px; display: block;">
                                                                            <tr>
                                                                                <td style="border-radius: 0; background: #ffffff; padding: 10px 0px 0px 0px;">
                                                                                    <a href="{{$bookactivity}}" style="background: #ef1313; font-weight:bold; font-family: sans-serif; font-size: 15px; line-height: 14px; text-decoration: none; padding: 10px 14px; color: #fff; display: block; border-radius: 8px;">Book an Activity</a>
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
                                                <!-- Thumbnail Right, Text Left : END -->
                                                
                                                    <!-- Thumbnail Left, Text Right : BEGIN -->
                                                <tr>
                                                   
                                                    <td dir="ltr" height="100%" valign="top" width="100%" style="font-size:0; padding: 0px 0;  text-align: center; " align="center" valign="center">
                                                       
                                                        <div style="display:inline-block; margin: 0 -1px; max-width: 353px; min-width:160px; vertical-align:top; width:100%;">
                                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                <tr>
                                                                    <td dir="ltr" style="padding: 50px 27px 0px 39px;">
                                                                        <a href="#" style="text-decoration:none;border:0;line-height:0; display: block"><img src="{{$img3}}" width="276" height="" border="0" alt="alt_text" style="width: 100%; max-width: 285px; height: auto; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;"></a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                       
                                                        <div style="display:inline-block; margin: 0 -1px; max-width: 375px; min-width:160px; vertical-align:top;">
                                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="border-spacing:0!important;  border-collapse:collapse!important; table-layout:fixed!important;   margin:0 auto!important">
                                                                <tr>
                                                                    <td dir="ltr" style="font-family: sans-serif; font-size: 15px; line-height: 45px; color: #555555; padding: 20px 20px; text-align: left; height: 90px;" align="center" valign="center">
                                                                        <h2 style="margin: 0 0 5px 0; font-family: 'Poppins',sans-serif; font-size: 20px; line-height: 28px; color: black; font-weight: 400;">Whats Are We Working On?</h2>
                                                                        <h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 21px; color: black; font-weight: 300; padding: 10px 15px 5px 0px;">Were working on ways for you to rent or buy equipment, gear, apparel, join online and on demand activites, build a better social network, better ways to schedule and book activities and more.</h2>
                                                                        <h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 21px; color: black; font-weight: 300; padding: 10px 15px 5px 0px;">We make it easy to find the products you need for the activities you love. While booking activities, you may need gear and more. Find what you are looking for offered by service providers listed on Fitnessity.</h2>
                                                                        <!-- Button : BEGIN -->
                                                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="border-spacing:0!important;  border-collapse:collapse!important;  table-layout:fixed!important;  ">
                                                                            <tr>
                                                                                <td style="border-radius: 0; background: #ffffff; padding: 0px 0px 25px 0px;">
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