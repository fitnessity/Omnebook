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
                                           <!--  <tr>
                                                <td style="padding:0px 0px 0px">
                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td style="text-align: center; background-color: #e4e4e4;">
                                                                <div>
                                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                        <tr>
                                                                            <td style="text-align: left; padding: 15px; font-size: 13px;">Subject:  IS NOW LIVE ON FITNESSITY
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
                                                                                <img src="{{$url}}/images/logo1.png" width="225"  alt="logo" border="0" style="height: auto;">
                                                                            </td>
                                                                        </tr>
                                                                        <?php $redlink = str_replace(" ","-",@$AllDetail['company_data']['company_name'])."/".@$AllDetail['company_data']['id']; ?>
                                                                        <tr><td style="font-size: 29px; font-weight: 600; text-align: center; padding: 0px 45px;">THANK YOU FOR BEING A CONTRIBUTOR ON FITNESSITY.</td></tr>
                                                                        <tr><td><a href="{{$url}}/businessprofile/{{$redlink}}" style="background: #ef1313;border: none;font-family: 'Poppins' ,sans-serif;font-size: 16px;line-height: 30px;  text-decoration: none;padding: 10px 0px;color: #ffffff;display: block;border-radius: 0;font-weight: 500;margin: auto;width:35%;height: 30px; margin-bottom: 30px; margin-top: 30px; border-radius: 10px; text-align: center;">VIEW BUSINESS</a></td></tr>
                                                                        
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
                                                                            <td style="padding: 10px 15px 14px 15px;" align="center">
                                                                                <p style="font-weight: 500; font-size: 23px; color: #000000; margin: 10px 0px 10px 0px">Greetings  {!! @$AllDetail['user']['firstname'] !!} {!! @$AllDetail['user']['lastname'] !!}  </p>
                                                                                <p style="font-weight: 400; font-size: 14px; color: #000000; margin-bottom: 10px; margin-top: 0px; text-align: left;">This is to notify you that {{@$AllDetail['company_data']['company_name']}} is officially live on Fitnessity.</p>
                                                                                
                                                                                <p style="font-weight: 400; font-size: 14px; color: #000000;margin-bottom: 10px; margin-top: 0px; text-align: left;">Click <a style="color: #1e43d7; text-decoration: underline;"  href="{{$url}}/claim-your-business">here</a> to view it yourself. Your contribution helps others learn more about {{@$AllDetail['company_data']['company_name']}}. If you haven't left a  review yet or submitted pictures, please visit the business to do so. You can also book another activity with {{@$AllDetail['company_data']['company_name']}} from the platform.</p>
                                                                                
                                                                                <p style="font-weight: 400; font-size: 14px; color: #000000;margin-bottom: 10px; margin-top: 0px; text-align: left;">Help us and others learn more about other businesses by contributing their information & leaving reviews.</p>
                                                                                
                                                                                <h2 style="padding: 0 0px; text-align: left; font-size:14px; font-weight: normal; margin-bottom: 15px;">Congratulations!</h2>
                                                                                
                                                                                <h2 style="padding: 0 0px; text-align: left; font-size:14px; font-weight: normal; margin-bottom: 15px;">Team Fitnessity</h2>
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
                                        
                                             <!-- Footer: START -->
                                            <tr>
                                                <td style=" padding: 15px 10px 0px; background: black;">
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" class="follow-us">
                                                        
                                                        <tr>
                                                            <td>
                                                                <h5 style="color: white; text-align: center; font-weight: 400; margin-top: 20px; margin-bottom: 0px;">Privacy Policy  | Terms of Service</h5>
                                                                <h5 style="color: white; text-align: center; font-weight: 400; margin-top: 0px; margin-bottom:30px;">@ copyright <?php echo date('Y'); ?> Fitnessity, Inc.</h5> 
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