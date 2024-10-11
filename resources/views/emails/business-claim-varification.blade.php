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

                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="    font-family: Arial,sans-serif; text-align: center;  color: rgba(255,255,255,.5);  font-family: sans-serif;  font-size: 12px;  line-height: 18px; ">

                                <tr>

                                    <td style="padding:0 0 10px 0;">

                                        <!--<webversion style="text-decoration: underline; font-weight: bold; color: black;">View in web browser</webversion>-->

                                    </td>

                                </tr>

                            </table>

                            <table height="100%" width="100%" cellpadding="0" cellspacing="0" border="0">

                                <tr>

                                    <td  style="padding:21px 0px 0px;  background: #fff;">

                                        <!-- Email Body : BEGIN -->

                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">

                                            <!-- Email Header : BEGIN -->

                                            <tr>

                                                <td style="padding: 0  0 18px 0; text-align: center">

                                                </td>

                                            </tr>

                                            <!-- Email Header : END -->

                                           

                                            <!-- Background Image with Text : BEGIN -->

                                            <tr>

                                                <td style="padding:0px 0px 0px">

                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">

                                                        <tr>

                                                            <!-- Bulletproof Background Images c/o https://backgrounds.cm -->

                                                            <td style="text-align: center; background-color: #e4e4e4;">

                                                                <div>

                                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">

                                                                        <tr>

                                                                            <td style="text-align: left; padding: 0px 15px;">

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

                                               <!-- <td style="text-align: left; padding: 15px 15px 40px;">-->
                                                <?php $url1 = $url.'/public/images/bg-1.png'; ?>
												<td style="text-align: center; background-image: url({{ $url1}}); background-size: cover !important; padding: 15px 15px 98px;;">

                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">

                                                        <tr>

                                                            <td>

                                                                <div>

                                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">

                                                                        <tr><td style="font-size: 13px;text-align: left;"></td></tr>

																		<tr><td style="font-size: 13px;text-align: left;"></td></tr>

																		<tr><td style="font-size: 13px;text-align: left;"></td></tr>

																		<tr><td style="font-size: 13px;text-align: left;"></td></tr>

																		<tr>

																			<td style="text-align: center; padding: 25px 0px 15px 0px;">

																				<img src="{{$url}}/public/images/logo1.png" width="225"  alt="logo" border="0" style="height: auto;">

                                                                            </td>

																		</tr>

																		<tr><td style="font-size: 28px; font-weight: 600; text-align: center;"></td></tr>

                                                                    </table>

                                                                </div>

                                                            </td>

                                                        </tr>

                                                    </table>

                                                </td>

                                            </tr>



                                            <tr>

                                                <td style="padding:0px 0px 0px">

                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">

                                                        <tr>

                                                            <!-- Bulletproof Background Images c/o https://backgrounds.cm -->

                                                            <td style="text-align: center;">

                                                                <div>

                                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">

                                                                        <tr>

                                                                            <td style="text-align: center; padding: 0px 28px 30px;" align="center">

																				<p style="font-weight: 500; font-size: 15px; color: #000000;">Your verification code for Cliam Business is {{@$details['random_code']}} </p>

                                                                            </td>

                                                                        </tr>

                                                                    </table>

                                                                </div>

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