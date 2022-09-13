@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">

        @include('business.leftNavigation')

        <div class="col-md-10">

            <form id="serviceSpecifics" name="serviceSpecifics" action="{{route('addbusinessspecification')}}" method="post">
                @csrf
                <input type="hidden" name="userid" id="userid" value="{{Auth::user()->id}}">
                <div class="container-fluid p-0" id="detail-form2">
                    <div class="tab-hed">Service Specifics</div>
                    <hr style="border: 15px solid black;width: 104%;margin-left: -38px;">
                    <section class="row">
                        <div class="col-md-12">
                            <div class="row" style="padding-right: 200px;">
                                <div class="form-group col-md-12">
                                    <label for="email">Language(s) you and your staff speak ? (click all that apply) </label>
                                    <select name="languages[]" id="testdemo" multiple>
                                        <option value="English">English</option>
                                        <option value="Afar">Afar</option>
                                        <option value="Abkhazian">Abkhazian</option>
                                        <option value="Afrikaans">Afrikaans</option>
                                        <option value="Amharic">Amharic</option>
                                        <option value="Arabic">Arabic</option>
                                        <option value="Assamese">Assamese</option>
                                        <option value="Aymara">Aymara</option>
                                        <option value="Azerbaijani">Azerbaijani</option>
                                        <option value="Bashkir">Bashkir</option>
                                        <option value="Belarusian">Belarusian</option>
                                        <option value="Bulgarian">Bulgarian</option>
                                        <option value="Bihari">Bihari</option>
                                        <option value="Bislama">Bislama</option>
                                        <option value="Bengali/Bangla">Bengali/Bangla</option>
                                        <option value="Tibetan">Tibetan</option>
                                        <option value="Breton">Breton</option>
                                        <option value="Catalan">Catalan</option>
                                        <option value="Corsican">Corsican</option>
                                        <option value="Czech">Czech</option>
                                        <option value="Welsh">Welsh</option>
                                        <option value="Danish">Danish</option>
                                        <option value="German">German</option>
                                        <option value="Bhutani">Bhutani</option>
                                        <option value="Greek">Greek</option>
                                        <option value="Esperanto">Esperanto</option>
                                        <option value="Spanish">Spanish</option>
                                        <option value="Estonian">Estonian</option>
                                        <option value="Basque">Basque</option>
                                        <option value="Persian">Persian</option>
                                        <option value="Finnish">Finnish</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Faeroese">Faeroese</option>
                                        <option value="French">French</option>
                                        <option value="Frisian">Frisian</option>
                                        <option value="Irish">Irish</option>
                                        <option value="Scots/Gaelic">Scots/Gaelic</option>
                                        <option value="Galician">Galician</option>
                                        <option value="Guarani">Guarani</option>
                                        <option value="Gujarati">Gujarati</option>
                                        <option value="Hausa">Hausa</option>
                                        <option value="Hindi">Hindi</option>
                                        <option value="Croatian">Croatian</option>
                                        <option value="Hungarian">Hungarian</option>
                                        <option value="Armenian">Armenian</option>
                                        <option value="Interlingua">Interlingua</option>
                                        <option value="Interlingue">Interlingue</option>
                                        <option value="Inupiak">Inupiak</option>
                                        <option value="Indonesian">Indonesian</option>
                                        <option value="Icelandic">Icelandic</option>
                                        <option value="Italian">Italian</option>
                                        <option value="Hebrew">Hebrew</option>
                                        <option value="Japanese">Japanese</option>
                                        <option value="Yiddish">Yiddish</option>
                                        <option value="Javanese">Javanese</option>
                                        <option value="Georgian">Georgian</option>
                                        <option value="Kazakh">Kazakh</option>
                                        <option value="Greenlandic">Greenlandic</option>
                                        <option value="Cambodian">Cambodian</option>
                                        <option value="Kannada">Kannada</option>
                                        <option value="Korean">Korean</option>
                                        <option value="Kashmiri">Kashmiri</option>
                                        <option value="Kurdish">Kurdish</option>
                                        <option value="Kirghiz">Kirghiz</option>
                                        <option value="Latin">Latin</option>
                                        <option value="Lingala">Lingala</option>
                                        <option value="Laothian">Laothian</option>
                                        <option value="Lithuanian">Lithuanian</option>
                                        <option value="Latvian/Lettish">Latvian/Lettish</option>
                                        <option value="Malagasy">Malagasy</option>
                                        <option value="Maori">Maori</option>
                                        <option value="Macedonian">Macedonian</option>
                                        <option value="Malayalam">Malayalam</option>
                                        <option value="Mongolian">Mongolian</option>
                                        <option value="Moldavian">Moldavian</option>
                                        <option value="Marathi">Marathi</option>
                                        <option value="Malay">Malay</option>
                                        <option value="Maltese">Maltese</option>
                                        <option value="Burmese">Burmese</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepali">Nepali</option>
                                        <option value="Dutch">Dutch</option>
                                        <option value="Norwegian">Norwegian</option>
                                        <option value="Occitan">Occitan</option>
                                        <option value="(Afan)/Oromoor/Oriya">(Afan)/Oromoor/Oriya</option>
                                        <option value="Punjabi">Punjabi</option>
                                        <option value="Polish">Polish</option>
                                        <option value="Pashto/Pushto">Pashto/Pushto</option>
                                        <option value="Portuguese">Portuguese</option>
                                        <option value="Quechua">Quechua</option>
                                        <option value="Rhaeto-Romance">Rhaeto-Romance</option>
                                        <option value="Kirundi">Kirundi</option>
                                        <option value="Romanian">Romanian</option>
                                        <option value="Russian">Russian</option>
                                        <option value="Kinyarwanda">Kinyarwanda</option>
                                        <option value="Sanskrit">Sanskrit</option>
                                        <option value="Sindhi">Sindhi</option>
                                        <option value="Sangro">Sangro</option>
                                        <option value="Serbo-Croatian">Serbo-Croatian</option>
                                        <option value="Singhalese">Singhalese</option>
                                        <option value="Slovak">Slovak</option>
                                        <option value="Slovenian">Slovenian</option>
                                        <option value="Samoan">Samoan</option>
                                        <option value="Shona">Shona</option>
                                        <option value="Somali">Somali</option>
                                        <option value="Albanian">Albanian</option>
                                        <option value="Serbian">Serbian</option>
                                        <option value="Siswati">Siswati</option>
                                        <option value="Sesotho">Sesotho</option>
                                        <option value="Sundanese">Sundanese</option>
                                        <option value="Swedish">Swedish</option>
                                        <option value="Swahili">Swahili</option>
                                        <option value="Tamil">Tamil</option>
                                        <option value="Telugu">Telugu</option>
                                        <option value="Tajik">Tajik</option>
                                        <option value="Thai">Thai</option>
                                        <option value="Tigrinya">Tigrinya</option>
                                        <option value="Turkmen">Turkmen</option>
                                        <option value="Tagalog">Tagalog</option>
                                        <option value="Setswana">Setswana</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Turkish">Turkish</option>
                                        <option value="Tsonga">Tsonga</option>
                                        <option value="Tatar">Tatar</option>
                                        <option value="Twi">Twi</option>
                                        <option value="Ukrainian">Ukrainian</option>
                                        <option value="Urdu">Urdu</option>
                                        <option value="Uzbek">Uzbek</option>
                                        <option value="Vietnamese">Vietnamese</option>
                                        <option value="Volapuk">Volapuk</option>
                                        <option value="Wolof">Wolof</option>
                                        <option value="Xhosa">Xhosa</option>
                                        <option value="Yoruba">Yoruba</option>
                                        <option value="Chinese">Chinese</option>
                                        <option value="Zulu">Zulu</option>

                                    </select>

                                    <script>
                                        var p = new SlimSelect({
                                            select: '#testdemo'
                                        });

                                    </script>


                                    <span class="error" id="b_testdemo"></span>


                                </div>


                                <div class="col-md-6">



                                    <div class="form-group">



                                        <label>Do you work with clients with medical conditions ?</label><br>



                                        <input type="radio" name="medical_states" id="checkyes" style="width: 25px;height: 25px;position: relative;top: 5px;" autocomplete="off" value="1">



                                        <span style="font-size: 20px;font-weight: bold;">Yes</span>



                                        <input type="radio" name="medical_states" id="checkno" style="width: 25px;height: 25px;position: relative;top: 5px;margin-left: 20px;" autocomplete="off" value="0">



                                        <span style="font-size: 20px;font-weight: bold;">No</span>



                                    </div>



                                    <div class="form-group" id="medproblm" style="display:none;">



                                        <label for="email">If Yes, what type? </label>


                                        <select name="medical_type[]" id="mcc" multiple>


                                            <option value="0">Breathing Problem</option>
                                            <option value="1">Back Problem</option>
                                            <option value="2">Pregnant</option>
                                            <option value="3">Special Needs</option>
                                            <option value="4">Doesnt Matter</option>
                                            <option value="5">Others</option>



                                        </select>

                                        <span class="error" id="b_mcc"></span>

                                        <script>
                                            var p = new SlimSelect({
                                                select: '#mcc'
                                            });

                                        </script>

                                    </div>



                                </div>



                                <div class="col-md-6">



                                    <div class="form-group">



                                        <label>Does your business help clients with these fitness goals ?</label><br>



                                        <input type="radio" name="fitness_goals" id="check_yes" style="width: 25px;height: 25px;position: relative;top: 5px;" autocomplete="off" value="1">



                                        <span style="font-size: 20px;font-weight: bold;">Yes</span>



                                        <input type="radio" name="fitness_goals" id="check_no" style="width: 25px;height: 25px;position: relative;top: 5px;margin-left: 20px;" autocomplete="off" value="0">



                                        <span style="font-size: 20px;font-weight: bold;">No</span>



                                    </div>



                                    <div class="form-group" id="fit-goals" style="display:none;">



                                        <label for="email">If Yes, what type? </label>


                                        <select name="goals_option[]" id="fitness_goals_array" multiple>

                                            <option value="weight_loss">Weight Loss</option>
                                            <option value="firming_&amp;_toning">Firming &amp; Toning</option>
                                            <option value="increase_strenght">Increase Strenght</option>
                                            <option value="endurance_training">Endurance Training</option>
                                            <option value="nutritions">Nutritions</option>
                                            <option value="weight_gain">Weight Gain</option>
                                            <option value="flexibilty">Flexibilty</option>
                                            <option value="aerobics_fitness">Aerobics Fitness</option>
                                            <option value="body_building">Body Building</option>
                                            <option value="pre/post_natal">Pre/Post Natal</option>
                                            <option value="other">Other</option>

                                        </select>

                                        <span class="error" id="b_fitness_goals_array"></span>

                                        <script>
                                            var p = new SlimSelect({
                                                select: '#fitness_goals_array'
                                            });

                                        </script>

                                    </div>



                                </div>


                            </div>


                            <div class="col-md-12 text-center">

                                <br>

                                <div class="form-group">

                                    <label>Add Your Business Hours<br>Add your business hours so its easy customers to know when you are open for business.<br>When you add business hours, Your page is also more likely to be suggested to people in your area.</label><br>



                                    <span style="font-size: 20px;font-weight: bold;">Hours</span><br>



                                    <input type="radio" name="hours_opt" value="Open on selected hours" style="width: 25px;height: 25px;position: relative;top: 5px;" id="hours1" autocomplete="off" >



                                    <span style="font-size: 16px;">Open on selected hours</span>



                                    <input type="radio" name="hours_opt" value="Always open" style="width: 25px;height: 25px;position: relative;top: 5px;margin-left: 20px;" id="hours2" autocomplete="off">



                                    <span style="font-size: 16px;">Always open</span>



                                    <input type="radio" name="hours_opt" value="No hours available" style="width: 25px;height: 25px;position: relative;top: 5px;margin-left: 20px;" id="hours3" autocomplete="off">



                                    <span style="font-size: 16px;">No hours available</span>



                                    <input type="radio" name="hours_opt" value="Temporalily closed" style="width: 25px;height: 25px;position: relative;top: 5px;margin-left: 20px;" id="hours4" autocomplete="off">



                                    <span style="font-size: 16px;">Temporalily closed</span>



                                    <input type="radio" name="hours_opt" value="Permanently closed" style="width: 25px;height: 25px;position: relative;top: 5px;margin-left: 20px;" id="hours5" autocomplete="off">



                                    <span style="font-size: 16px;">Permanently closed</span>



                                </div>



                            </div>



                            <div class="col-md-12" id="selectdays" style="display:none;padding: 30px 110px;">



                                <div class="row">



                                    <div class="form-group col-md-4">



                                        <label for="email">Monday</label>



                                    </div>



                                    <div class="form-group col-md-4">



                                        <input type="text" readonly class="form-control timepicker">



                                    </div>



                                    <div class="form-group col-md-4">



                                        <input type="text" readonly class="form-control timepicker">



                                    </div>



                                </div>



                                <div class="row">



                                    <div class="form-group col-md-4">



                                        <label for="email">Tuesday</label>



                                    </div>



                                    <div class="form-group col-md-4">



                                        <input type="text" readonly class="form-control timepicker">



                                    </div>



                                    <div class="form-group col-md-4">



                                        <input type="text" readonly class="form-control timepicker">



                                    </div>



                                </div>



                                <div class="row">



                                    <div class="form-group col-md-4">



                                        <label for="email">Wednesday</label>



                                    </div>



                                    <div class="form-group col-md-4">



                                        <input type="text" readonly class="form-control timepicker">



                                    </div>



                                    <div class="form-group col-md-4">



                                        <input type="text" readonly class="form-control timepicker">



                                    </div>



                                </div>



                                <div class="row">



                                    <div class="form-group col-md-4">



                                        <label for="email">Thursday</label>



                                    </div>



                                    <div class="form-group col-md-4">



                                        <input type="text" readonly class="form-control timepicker">



                                    </div>



                                    <div class="form-group col-md-4">



                                        <input type="text" readonly class="form-control timepicker">



                                    </div>



                                </div>



                                <div class="row">



                                    <div class="form-group col-md-4">



                                        <label for="email">Friday</label>



                                    </div>



                                    <div class="form-group col-md-4">



                                        <input type="text" readonly class="form-control timepicker">



                                    </div>



                                    <div class="form-group col-md-4">



                                        <input type="text" readonly class="form-control timepicker">



                                    </div>



                                </div>



                                <div class="row">



                                    <div class="form-group col-md-4">



                                        <label for="email">Saturday</label>



                                    </div>



                                    <div class="form-group col-md-4">



                                        <input type="text" readonly class="form-control timepicker">



                                    </div>



                                    <div class="form-group col-md-4">



                                        <input type="text" readonly class="form-control timepicker">



                                    </div>



                                </div>



                                <div class="row">



                                    <div class="form-group col-md-4">



                                        <label for="email">Sunday</label>



                                    </div>



                                    <div class="form-group col-md-4">



                                        <input type="text" readonly class="form-control timepicker">



                                    </div>



                                    <div class="form-group col-md-4">



                                        <input type="text" readonly class="form-control timepicker">



                                    </div>



                                </div>


                                <script>
                                    $('.timepicker').timepicker({
                                        timeFormat: 'h:mm p',
                                        interval: 15,
                                        // minTime: '24',



                                        // maxTime: '10:00pm',



                                        defaultTime: '11',
                                        startTime: '5:00',
                                        dynamic: false,
                                        dropdown: true,
                                        scrollbar: true



                                    });

                                </script>



                            </div>



                            <div class="col-md-12">



                                <br>



                                <br>



                                <br>



                                <div class="row">



                                    <div class="col-md-6">



                                        <div class="form-group">



                                            <label><strong>What is your time zone ?</strong> </label>



                                            <select class="form-control" id="serTimeZone" name="serTimeZone">

                                                <option value=""> Select Time Zone </option>

                                                <option value="est">Eastern Standard Time - EST</option>

                                                <option value="pst">Pacific Standard Time - PST</option>

                                                <option value="mst">Mountatin Standard Time - MST</option>

                                                <option value="cst">Central Standard Time - CST</option>

                                            </select>



                                        </div>



                                        <div class="form-group">
                                            <label><strong>Any Special Days Off ?</strong> </label>
                                            <!--<input type="text" class="form-control multidatepicker" id="mdp-demo" name="special_days_off" placeholder="Click here to select the dates you are closed" onkeydown="no_backspaces(event);">-->
                                            <div class="special-date">
                                                <input type="text" class="form-control" name="special_days_off" placeholder="Click here to select the dates you are closed" id="mdp-demo" onkeydown="no_backspaces(event);" />
                                                <i class="fa fa-calendar"></i>
                                            </div>

                                            <script>
                                                /*$('.multidatepicker').multiDatesPicker();*/
                                                $(document).on('click', '.rounded-corner', function () {
                                                    console.log("runrun")
                                                    console.log($(this).attr('date'))
                                                    $('#mdp-demo').multiDatesPicker('toggleDate', moment($(this).attr('date'), 'MM/DD/YYYY').format('MM/DD/YYYY'));
                                                    $(this).remove()
                                                })
                                                $('#mdp-demo').multiDatesPicker({
                                                    separator: ", ",
                                                    onSelect: function (dateText, inst) {
                                                        $('.rounded-corner').each(function (i, obj) {
                                                            console.log($(this))
                                                            if ($(this).text() == dateText + ' x') {
                                                                console.log("if")
                                                                $(this).click()
                                                            }
                                                        });
                                                        $('.manual-remove').append('<button type="button" date="' + dateText + '" class="rounded-corner">' + dateText + ' x</button>')
                                                    }
                                                });

                                            </script>


                                        </div>



                                        <div class="form-group">



                                            <label><strong>List amenities your business offers (Select that all apply)</strong> </label>



                                            <select multiple id="serBusinessoff1" name="serBusinessoff1[]">



                                                <option value="Cardio Equipment">Cardio Equipment</option>
                                                <option value="Strength Equipment">Strength Equipment</option>
                                                <option value="Stretch Equipment">Stretch Equipment </option>
                                                <option value="Equipment Rental">Equipment Rental</option>
                                                <option value="Lounge Area">Lounge Area</option>
                                                <option value="Waiting Area">Waiting Area</option>
                                                <option value="Wifi">Wifi</option>
                                                <option value="TV">TV</option>
                                                <option value="Showers ">Showers </option>
                                                <option value="Grooming Area">Grooming Area</option>
                                                <option value="Pool ">Pool </option>
                                                <option value="Jacuzzi  ">Jacuzzi </option>
                                                <option value="Massage">Massage</option>
                                                <option value="Salon">Salon</option>
                                                <option value="Sauna">Sauna</option>
                                                <option value="Steam Room">Steam Room</option>
                                                <option value="Basketball court">Basketball court</option>
                                                <option value="Tennis court">Tennis court</option>
                                                <option value="Racquetball court">Racquetball court</option>
                                                <option value="Track">Track</option>
                                                <option value="Tanning beds">Tanning beds</option>
                                                <option value="Juice Bar">Juice Bar</option>
                                                <option value="Smoothie Bar">Smoothie Bar</option>
                                                <option value="Bar Area">Bar Area</option>
                                                <option value="Snacks">Snacks</option>
                                                <option value="Nutritional Food">Nutritional Food</option>
                                                <option value="Food Options">Food Options</option>
                                                <option value="Cleaning Stations">Cleaning Stations</option>
                                                <option value="Sanitizing stations">Sanitizing stations</option>
                                                <option value="Lockers">Lockers</option>
                                                <option value="Water Fountain">Water Fountain</option>
                                                <option value="Bottle Fountain">Bottle Fountain</option>
                                                <option value="Sound system">Sound system</option>
                                                <option value="Social distancing">Social distancing</option>
                                                <option value="Trained staff on AED">Trained staff on AED</option>
                                                <option value="Trained CPR/ First Aid staff">Trained CPR/ First Aid staff </option>
                                                <option value="Certified personal trainers">Certified personal trainers</option>
                                                <option value="Alarm System">Alarm System</option>
                                                <option value="Bike Parking">Bike Parking</option>
                                                <option value="Car Parking">Car Parking</option>
                                                <option value="Elevator">Elevator</option>
                                                <option value="Security Cameras">Security Cameras</option>
                                                <option value="Wheelchair accessible">Wheelchair accessible</option>
                                                <option value="Outdoor seating">Outdoor seating</option>
                                                <option value="Indoor seating">Indoor seating</option>

                                            </select>

                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#serBusinessoff1'
                                                });

                                            </script>



                                        </div>



                                    </div>



                                    <div class="col-md-6" style="background: #dedada;padding: 30px 20px;min-height: 250px;">



                                        <div class="text-center">



                                            <span style="font-size: 18px;font-weight: bold;text-transform: uppercase;">Selected Date Off</span><br>



                                            <label>Customers will not be able to book you on these days</label>



                                        </div>

                                        <div class="manual-remove" style="float:left;">

                                        </div>

                                        <!--<ul style="list-style: none;font-size: 13px;">
                                            <li>- 12/07/2021 <i class="fa fa-times" aria-hidden="true" style="color: red;"></i></li>
                                            <li>- 20/07/2021 <i class="fa fa-times" aria-hidden="true" style="color: red;"></i></li>
                                            <li>- 25/07/2021 <i class="fa fa-times" aria-hidden="true" style="color: red;"></i></li>
                                        </ul>-->



                                    </div>



                                </div>



                            </div>



                            <div class="col-md-12">
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn-bck" onclick="location.href='{{route('experienceBusinessProfile')}}'"><i class="fa fa-arrow-left"></i> Back</button>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="submit" class="btn-nxt" id="btn-nxt3">Continue <i class="fa fa-arrow-right"></i></button>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </section>
                </div>
            </form>

        </div>
    </div>
</div>

@include('layouts.footer')

@endsection
