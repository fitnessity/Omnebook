<!DOCTYPE html>
<html>
<?php  
    $url = env('APP_URL');
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
                                        <td  style="background: #fff;">
                                            <!-- Email Body : BEGIN -->
                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                                                <!-- BEGIN -->
                                                <!-- <tr>
                                                    <td style="padding:0px 0px 0px">
                                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                            <tr>
                                                                <td style="text-align: center; background-color: #e4e4e4;">
                                                                    <div>
                                                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                            <tr>
                                                                                <td style="text-align: left; padding: 15px; font-size: 13px;">SUBJECT: CONGRATULATIONS YOU ARE NOW LIVE ON FITNESSITY
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr> -->
                                                <!-- END -->
                                                
                                                <!-- BEGIN -->
                                                <tr>
                                                    <?php $url1 = $url.'/public/img/bg.png'; ?>
                                                    <td style="text-align: center; background-image: url({{$url1}}); background-repeat: no-repeat; background-position: center; padding: 15px 15px 25px;;">
                                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                            <tr>
                                                                <td>
                                                                    <div>
                                                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                            <tr>
                                                                                <td style="text-align: center; padding: 25px 0px 45px 0px;">
                                                                                    <img src="{{$url}}/public/images/logo1.png" width="225"  alt="logo" border="0" style="height: auto;">
                                                                                </td>
                                                                            </tr>
                                                                            <tr><td style="font-size: 22px; font-weight: 600; text-align: center; padding-bottom: 16px;">CONGRATULATIONS!</td></tr>
                                                                            <tr><td style="font-size: 22px; font-weight: 600; text-align: center; padding: 0px 15px;">YOUR BUSINESS HAS BEEN LISTED ON FITNESSITY FOR FREE BY YOUR FORMER OR CURRENT CLIENT</td></tr>
                                                                            <tr><td><a href="{{$url}}/claim-your-business" style="background: #ef1313;border: none;font-family: 'Poppins' ,sans-serif;font-size: 16px;line-height: 30px;  text-decoration: none;padding: 10px 0px;color: #ffffff;display: block;border-radius: 0;font-weight: 500;margin: auto;width:35%;height: 30px; margin-bottom: 30px; margin-top: 30px; border-radius: 10px; text-align: center;">CLAIM YOUR BUSINESS</a></td></tr>
                                                                            
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
                                                                <td style="background-color: #e4e4e4;">
                                                                    <div>
                                                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                            <tr>
                                                                                <td style="padding: 10px 28px 14px 28px;" align="center">
                                                                                    <p style="font-weight: 600; font-size: 23px; color: #000000; margin: 10px 0px 10px 0px">Greetings {{@$AllDetail['company_data']['company_name']}}  </p>
                                                                                    <p style="font-weight: 400; font-size: 13px; color: #000000; margin-bottom: 0px; margin-top: 0px; text-align: left;">This is to notify you that {{@$AllDetail['company_data']['company_name']}} is officially live on Fitnessity.  </p>
                                                                                    <h3 style="font-weight: 600; font-size: 15px; color: #000000; text-align: left;">How did I get listed? </h3>
                                                                                    <p style="font-weight: 400; font-size: 13px; color: #000000;margin-bottom: 0px; margin-top: 0px; text-align: left;">A current, former customer or someone familiar with your business contributed your business information to Fitnessity so others around the world can learn about what you do, book your services and leave reviews.</p>
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
                                                        <h6 style="font-size: 18px; font-weight: 600; color: #000;margin-bottom: 0px; margin-top: 0px;">Finish your profile to reach others looking to book your services </h6>
                                                    </td>
                                                </tr>
                                                <!-- END -->

                                                 <!-- BEGIN -->
                                                <tr>
                                                    <td style=" padding:23px 10px 23px; text-align: center" align="center">
                                                        <h6 style="font-size: 15px; font-weight: 550; color: #000;margin-bottom: 0px; margin-top: 0px;">What is Fitnessity? </h6>
                                                        <p style="text-align: left;font-size: 13px;">Fitnessity (Fit-ness-ity) is a multi-sport and wellness marketplace that simplifies the process of booking active activities online.  Users can search, compare, book and rate activities from local businesses offering personal training, coaching, fitness classes & adventure experiences. These may be provided in person, or online.</p>
                                                    </td>
                                                </tr>
                                                <!--  END -->
                                                
                                                <!-- BEGIN -->
                                                <tr>
                                                    <td style=" padding:0px 10px 23px; text-align: center" align="center">
                                                        <h6 style="font-size: 15px; font-weight: 550; color: #000;margin-bottom: 0px; margin-top: 0px;">Is the business information that was provided correct?</h6>
                                                        <p style="text-align: left;font-size: 13px;">{{@$AllDetail['company_data']['company_name']}}, here’s what people are seeing on Fitnessity for your business. Is your information correct?</p>
                                                        <h3 style="font-size: 13px; font-weight: 450; color: #000;margin-bottom: 0px; text-align: left;">Business Summary</h3>
                                                        <ul style="text-align: left; font-size: 13px; padding-left: 11px;">
                                                            <li>Business Name: {{@$AllDetail['company_data']['company_name']}}</li>
                                                            <li>Business Address: {{@$AllDetail['company_data']['address']}}, {{@$AllDetail['company_data']['city']}}, {{@$AllDetail['company_data']['state']}}, {{@$AllDetail['company_data']['country']}}</li>
                                                            <li>Business Number: {{@$AllDetail['company_data']['business_phone']}}</li>
                                                            <li>Business Email: {{@$AllDetail['company_data']['business_email']}}</li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <!-- END -->
                                                
                                                <!-- BEGIN -->
                <tr>
                    <td style=" padding:0px 10px 23px; text-align: center" align="center">
                        <h6 style="font-size: 15px; font-weight: 550; color: #000;margin-bottom: 0px;margin-top: 0px;">Your First Review on Fitnessity</h6>
                        <tr>
                            <td style="text-align: left; padding: 0px 10px 0px 10px;">
                                <div style="display:inline-block; width:10%">
                                    <img src="{{$url}}/public/uploads/profile_pic/thumb/{{@$AllDetail['user']['profile_pic']}}" width="225"  alt="logo" border="0" style="height: 45px; border-radius: 100%; width: 45px;">
                                </div>
                                <div style="display:inline-block; width:60%; vertical-align: bottom;">
                                    <h3 style="font-size:15px; font-weight: 400; margin-top:0px; margin-bottom:0px;"> {!! @$AllDetail['user']['firstname'] !!} {!! @$AllDetail['user']['lastname'] !!} 
                                    <img src="{{$url}}/public/img/star.png" width="225"  alt="logo" border="0" style="height: 17px; border-radius: 100%; width: 17px;">
                                    <span style="color: #ea1515; font-size: 15px; font-weight: 500;">{!! @$AllDetail['review']['rating'] !!}</span>
                                    </h3>
                                    <h3 style="font-size:11px; font-weight: 400; margin-top:0px; color: #7c7c7c;"><?php echo date('d M-Y', strtotime(@$AllDetail['review']['created_at'])); ?></h3>
                                </div>
                                <p style="font-size: 14px; margin-top: 2px; margin-bottom: 5px;">{!! @$AllDetail['review']['title'] !!}</p> 
                                <p style="font-size: 13px; margin-top: 2px; margin-bottom: 10px; font-weight: 300;">{!! @$AllDetail['review']['review'] !!}</p>

                                <?php
                                    if( !empty(@$AllDetail['review']['images']) ){
                                        if(str_contains(@$AllDetail['review']['images'], '|')){
                                            $rimg=explode('|',@$AllDetail['review']['images']);
                                            foreach($rimg as $img){ ?>
                                                <img src="{{ $url}}/public/uploads/review/{{$img}}" width="225"  alt="logo" border="0" style="height: 45px; border-radius: 16%; width: 45px;">
                                                <?php
                                            }
                                        }else{ ?>
                                            <img src="{{ $url}}/public/uploads/review/{{@$AllDetail['review']['images']}}" width="225"  alt="logo" border="0" style="height: 45px; border-radius: 16%; width: 45px;">
                                       <?php }
                                    }
                                ?>
                                
                            </td>
                        </tr>
                    </td>
                </tr>
                                                <!-- END -->
                                                
                                                <!-- BEGIN -->
                                                <tr>
                                                    <td style=" padding:23px 10px 23px;">
                                                        <h6 style="font-size: 15px; font-weight: 550; color: #000;margin-bottom: 0px; text-align: left;margin-top: 0px;">How to claim your business profile</h6>
                                                        <p style="text-align: left;font-size: 13px;">When your former or current customer listed your business, they added either a phone number or email that you use for customer to contact you. You will will use that information to claim and verifiy that this business is yours. Once you have verified, you will start the process of adding your business detials, images, services, prices and times slots for your services. Customers can add reviews to your business even if you don’t claim your business. In order to respond to reviews, you will need to claim your business profile.</p>
                                                        <p style="text-align: left;font-size: 13px;">Claim your acount <a style="color: #1e43d7; text-decoration: underline;"  href="{{$url}}/claim-your-business">here</a> and finish setting up your account details to attract more customers, boost your sales and gain instant access to monthly visitors in New York. </p>
                                                        <tr><td><a href="{{$url}}/claim-your-business" style="background: #ef1313;font-family: 'Poppins' ,sans-serif;font-size: 13px;line-height: 30px;  text-decoration: none;padding: 5px 0px;color: #ffffff;display: block;border-radius: 0;font-weight: 500;margin: 0px 10px;width:25%;height: 30px; margin-bottom: 20px; border-radius: 5px; text-align: center;">CLAIM YOUR BUSINESS</a></td></tr>
                                                    </td>
                                                </tr>
                                                <!-- END -->
                                                <tr>
                                                    <td><h2 style="padding: 0 10px; text-align: left; font-size:14px; font-weight: normal; margin-bottom: 15px;">Congratulations!</h2></td>
                                                </tr>
                                                <tr>
                                                    <td><h2 style="padding: 0 10px; text-align: left; font-size:14px; font-weight: normal; margin-bottom: 15px;">Team Fitnessity</h2></td>
                                                </tr>
                                                
                                                 <!-- Footer: START -->
                                                <tr>
                                                    <td style=" padding: 15px 10px 0px; background: black;">
                                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" class="follow-us">
                                                            
                                                            <tr>
                                                                <td>
                                                                    <h5 style="color: white; text-align: center; font-weight: 400; margin-top: 20px; margin-bottom: 0px;">Privacy Policy  | Terms of Service</h5>
                                                                    <h5 style="color: white; text-align: center; font-weight: 400; margin-top: 0px; margin-bottom: 30px;">@ copyright <?php echo date('Y'); ?> Fitnessity, Inc.</h5>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <!-- Footer: END -->

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