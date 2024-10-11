<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />

    <title>Fitnessity</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta content="width=device-width, initial-scale=1" name="viewport" />

    <link rel="shortcut icon" href="{{ url('public/images/email/favicon.ico') }}">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,700,900' rel='stylesheet' type='text/css'>

</head>


<body style="margin: 0;padding: 0;font-family: 'Roboto', sans-serif;font-size: 14px;font-weight: 400;line-height: 1.5;color: #000000;">
    <div style="width:960px; margin:0 auto">
        <header>
            <table width="100%" align="center">
                <tr>
                    <td>
                        <a href="http://www.fitnessity.co">
                            <img src="{{ url('public/images/logo_new1.jpg') }}" width="200px">
                        </a>
                    </td>
                    <td align="right">
                        Login to <a href="http://www.fitnessity.co">fitnessity.co</a>
                    </td>
                </tr>
            </table>
        </header>
        <hr/>
        <section style="padding: 30px 0;">
            <center>
                <p style="margin-bottom: 0;">
                    Please confirm that {{ $user->email }} is your email address by clicking on the button below
                </p>
                <br/>
                <a href="{{url('/verifyuser/'.$user->confirmation_code)}}" style="text-decoration: none; color:#ffffff; font-weight: bold">
                <div style="text-align: center; padding:10px 5px; background: #ea1515; color:#ffffff; border-radius:50px; width:200px">
                Verify Email
                </div>>
                </a>
            </center>
        </section>
    </div>
    <div style="display:none">
        
        <header style="padding: 4px 0px 0;text-align: center;">
            <div style="max-width: 960px;margin: 0 auto;">
                <a href="#" style="background:#000; display: inline-block; height: 100px;">
                    <img src="{{ url('public/images/email/logo_new.png') }}" alt="" style="height: 100%;width: 100%;object-fit: contain;">
                </a>
            </div>
        </header>
        
        <p class="MsoNormal" style="margin:0in;font-size:11pt;font-family:Calibri,sans-serif;text-align:center" align="center">
        <span style="font-size:16pt;line-height:normal">Welcome to Fitnessity! Before we get started, please confirm your email address</span><span style="font-size:24.0pt"><u></u><span style="font-size:16pt;line-height:normal">&nbsp;</span><u></u></span></p>
        
        <a href="{{url('/verifyuser/'.$user->confirmation_code)}}">
        <p class="MsoNormal" style="margin: 0in; font-size: 11pt; font-family: Calibri, sans-serif; text-align: center;" align="center">
        <span style="font-size: 24pt;"><u></u><img style="width: 209px; height: 68px; max-width: 100%;" src="{{ url('public/images/verify-email.png') }}" class="CToWUd" width="209" height="68">&nbsp;<u></u></span></p>
        </a>
        
        <section style="padding: 30px 0;">
            <div style="max-width: 960px;margin: 0 auto;text-align: center;">
                <h4 style="font-size: 18px;font-weight: 400;margin-bottom: .5rem;font-family: inherit;line-height: 1.2;margin-top: 0;">WHAT ACTIVITY EXCITES YOU TO STAY ACTIVE?</h4>
                <p style="margin-bottom: 0;">
                    Fitnessity (Fit-ness-ity), is a directory & marketplace connecting consumers to trainers, coaches, classes & active experiences with adventures & Tours. You can participate in activities at local businesses, onlie, or while traveling. Fitnessity is for people who believe that an active lifestyle is a necessity.
                </p>
            </div>
        </section>

        <section style="padding: 40px 0;">
            <div style="max-width: 960px;margin: 0 auto;padding-left: 5rem;padding-right: 5rem;">
                <div style="width: 100%; text-align: center;">
                    <h3 style="border-bottom: 5px solid #d02f4c;display: inline-block;font-size: 28px;color: #000000;padding-bottom: 3px;margin-bottom: .5rem;font-family: inherit;line-height: 1.2;margin-top: 0;">Here's how to get started with Fitnessity</h3>
                </div>
                <div style="display: flex;align-items: flex-start;margin-top: 2.5rem;">
                    <div style="width: 40%;">
                        <div><img src="{{ url('public/images/email/about-yourself.jpg') }}" style="width: 100%;" alt=""></div>
                    </div>
                    <div style="width: 60%;padding-left: 120px;padding-right: 35px;">
                        <h4 style="font-weight: 700;font-size: 20px;margin-bottom: .5rem;font-family: inherit;line-height: 1.2;margin-top: 0;">Tell Us About Yourself</h4>
                        <p style="font-size: 16px;">
                            let service providers, friends, family, and othwe get to know you better by completing your profile. Add your images, write a little about yourself, and add family members to your profile for a more straightforward booking process.
                        </p>
                        <a href="#" style="display: inline-block;background: #585858;color: #fff;font-size: 16px;padding: 5px 10px;border-radius: 8px;font-weight: 500;max-width: 140px;width: 100%;text-align: center;text-decoration: none;">Go to Profile</a>
                    </div>
                </div>
                <div style="display: flex;align-items: flex-start;margin-top: 5rem;">
                    <div style="width: 70%;padding-right: 150px;">
                        <h4 style="font-weight: 700;font-size: 20px;margin-bottom: .5rem;font-family: inherit;line-height: 1.2;margin-top: 0;">Get Going | Book Instantly or Send A Request</h4>
                        <p style="font-size: 16px;">
                            With the instant hire, you can immediatley confirm a booking. With Instant match, you can send a provider a request and hear back from providers that match what you are looking for with an offer. You can book lessons with personal trainers, coaches, and instructors. Find your favorite class locally or online. Book your next adventure for your upcoming vaction or to add a little fun to your weekend. Invite friends to join you when you before you check out.
                        </p>
                        <a href="#" style="display: inline-block;background: #585858;color: #fff;font-size: 16px;padding: 5px 10px;border-radius: 8px;font-weight: 500;max-width: 140px;width: 100%;text-align: center;text-decoration: none;">Book an Activity</a>
                    </div>
                    <div style="width: 30%;">
                        <div><img src="{{ url('public/images/email/book.jpg') }}" style="width: 80%" alt=""></div>
                    </div>
                </div>
                <div style="display: flex;align-items: flex-start;margin-top: 2.5rem;">
                    <div style="width: 30%;">
                        <div><img src="{{ url('public/images/email/equipment.jpg') }}" style="width: 80%" alt=""></div>
                    </div>
                    <div style="width: 60%;padding-left: 45px;padding-right: 15px;">
                        <h4 style="font-weight: 700;font-size: 20px;margin-bottom: .5rem;font-family: inherit;line-height: 1.2;margin-top: 0;">Buy Equipment, Apparel, Gear, and More</h4>
                        <p style="font-size: 16px;">
                            We make it easy to find the products you need for the activities you love. While booking activities, you may need gear and more. Find what you are looking for offered by service providers listed on Fitnessity.
                        </p>
                        <a href="#" style="display: inline-block;background: #585858;color: #fff;font-size: 16px;padding: 5px 10px;border-radius: 8px;font-weight: 500;max-width: 140px;width: 100%;text-align: center;text-decoration: none;">Buy Products</a>
                    </div>
                </div>
            </div>
        </section>

        

    </div>

</body>

</html>
