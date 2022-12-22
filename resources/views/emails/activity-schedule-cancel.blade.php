<!DOCTYPE html>
<html>

<?php  
        $url = env('APP_URL');
        if($usertype == 'user'){
            $custmername = @$userdata->firstname.' '.@$userdata->lastname;
            $userurl = $url.'profile/viewProfile';
        }else{
            $custmername = @$userdata->fname.' '.@$userdata->lname;
            $userurl = '#';
        }
            
        $program_name = @$businessdata->program_name;
        $company_name = @$companydata->company_name;
        $provider_name = @$companydata->first_name.' '.@$companydata->last_name;
        $businessimg = @$companydata->logo;

        $urlfeedback = $url.'feedback';
       // $urlprofile = $url.'profile/viewProfile';
         $urlprofile = '#';
        $img1 = $url.'public/img/img-1_email.png';
        $img2 = $url.'public/img/book_email.png';
        $img3 = $url.'public/img/img-3_email.png';
        $bookactivity = $url.'activities';
        $COM_NAME = strtolower(str_replace(' ', '-',  $company_name)).'/'.$companydata->id;
        $providerurl = $url.'/businessprofile/'.$COM_NAME;

        $address = '';
        if(@$companydata->address != ''){
            $address .= @$companydata->address.',';
        }if(@$companydata->city != ''){
            $address .= @$companydata->city.',';
        }if(@$companydata->state != ''){
            $address .= @$companydata->state.',';
        }if(@$companydata->country != ''){
            $address .= @$companydata->country.',';
        }if(@$companydata->zip_code != ''){
            $address .= @$companydata->zip_code;
        } 
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
                                                     <span style="color: black;">Hi {{$custmername}}, {{$program_name }} on {{$date}} at {{$time}} at {{$company_name}} Has Been Cancelled</span>
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
                                                                                $char = substr($company_name, 0, 1);
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
                                                                                <img src="{{$businessimg}}" width="276" height="" border="0" alt="alt_text" style="width: 100%; width: 70px; height: 70px;font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555; border-radius: 100%;" ></a>
                                                                                <?php } ?>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="text-align: center; padding: 0px 28px 30px;" align="center">
                                                                                    <p style="font-weight: 400; font-size: 14px; color: #000000; margin-bottom: 10px; margin-top: 0px; text-align: left;">Dear,{{$custmername}}!  </p>
                                                                                    <p style="font-weight: 400; font-size: 14px; color: #000000; margin-bottom: 10px; margin-top: 0px; text-align: left;">We are sorry to inform you that the {{$program_name}} scheduled for {{$date}} at {{$time}} has been cancelled. Your reservation for this class is hereby cancelled as of {{$date}} at {{$time}}, and your account has been credited accordingly. We appologize for any inconvenience this may have caused. Please contact {{$provider_name}} if you have any further questions.  </p>
                                                                                    <p style="font-weight: 400; font-size: 14px; color: #000000; margin-bottom: 10px; margin-top: 0px; text-align: left;">You have not been charged for this class. We look forward to serving you again soon. </p>
                                                                                    <p style="font-weight: 400; font-size: 14px; color: #000000; margin-bottom: 10px; margin-top: 0px; text-align: left;">Thank you for your understanding,</p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="text-align: center; padding: 0px 28px 30px;" align="center">
                                                                                    <p style="font-weight: 400; font-size: 14px; color: #000000; margin-bottom: 0px; margin-top: 0px; text-align: left;">Provider Company Contact Details  </p>
                                                                                   <p style="font-weight: 400; font-size: 14px; color: #000000; margin-bottom: 0px; margin-top: 0px; text-align: left;">{{$company_name}}</p>
                                                                                    <p style="font-weight: 400; font-size: 14px; color: #000000; margin-bottom: 0px; margin-top: 0px; text-align: left;">{{$address}}</p>
                                                                                    <p style="font-weight: 400; font-size: 14px; color: #000000; margin-bottom: 0px; margin-top: 0px; text-align: left;">{{@$companydata->email}}</p>
                                                                                    <p style="font-weight: 400; font-size: 14px; color: #000000; margin-bottom: 0px; margin-top: 0px; text-align: left;">{{@$companydata->business_phone}}</p>
                                                                                </td>
                                                                            </tr>
                                                                             <tr>
                                                                                <td style="border-radius: 0; background: #ffffff; padding: 0px 0px 25px 0px;">
                                                                                    @php if($usertype == 'user'){  @endphp
                                                                                        <a href="{{$userurl}}"style="background: #ef1313; font-weight:bold; font-family: sans-serif; font-size: 15px; line-height: 14px; text-decoration: none; padding: 10px 14px; color: #fff; display: inline-block; border-radius: 8px; width: 22%;">View Your Profile</a>
                                                                                    @php  } @endphp
                                                                                    
                                                                                    <a href="{{$providerurl}}" style="background: #606060; font-weight:bold; font-family: sans-serif; font-size: 15px; line-height: 14px; text-decoration: none; padding: 10px 14px; color: #fff; display: inline-block; border-radius: 8px; width: 22%;">View Provider Profile</a>
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