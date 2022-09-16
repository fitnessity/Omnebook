<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Mail;
use Illuminate\Support\Facades\Config;
use Image;
use App\ProfessionalType;

class Miscellaneous extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;

    public static function sendEmail($mailto, $subject, $templates, $data) {

        Mail::send($templates, $data, function($message)use($mailto, $subject) {
            $message->to($mailto, 'admin')->subject($subject);
        });
        return true;
    }

    public static function getMiscellaneous($type, $order = null, $is_alphbet_sort = false) {
        $query = DB::table('miscellaneous')
                ->where('type', $type);

        if (isset($order) && $order != null)
            $query->orderby($order, 'asc');

        if (isset($is_alphbet_sort) && $is_alphbet_sort) {
            $db_data = $query->get();
            $result = array();
            if (count($db_data) > 0) {
                foreach ($db_data as $data) {
                    if (!isset($result[substr($data->title, 0, 1)]))
                        $result[substr($data->title, 0, 1)] = array();
                    $result[substr($data->title, 0, 1)][] = $data;
                }
            }
        }
        else {
            $result = $query->get();
        }
        return $result;
    }

    public static function getMiscOptions() {
        $data = array();
        $data[0]['question'] = 'train_whom';
        $data[0]['question_title'] = 'Whom you provide training ?';
        $data[0]['answer'] = array(array('value' => 'kid', 'title' => 'Kid'),
            array('value' => 'adult', 'title' => 'Adult'),
            array('value' => 'teen', 'title' => 'Teen'),
            array('value' => 'group', 'title' => 'Group'));

        $data[1]['question'] = 'gender';
        $data[1]['question_title'] = 'Gender';
        $data[1]['answer'] = array(array('value' => 'male', 'title' => 'Male'),
            array('value' => 'female', 'title' => 'Female'));


        $data[2]['question'] = 'personality';
        $data[2]['question_title'] = 'How is your personality as a trainer ?';
        $data[2]['answer'] = array(array('value' => 'Drill Sergeant', 'title' => 'A Drill Sergeant'),
            array('value' => 'An Educator or Teacher', 'title' => 'An Educator or Teacher'),
            array('value' => 'A Supportive, Nurturing Coach', 'title' > 'A Supportive, Nurturing Coach'));

        $data[3]['question'] = 'availability';
        $data[3]['question_title'] = 'On which days you are available ?';
        $data[3]['answer'] = array(array('value' => 'sunday', 'title' => 'Sunday'),
            array('value' => 'monday', 'title' => 'Monday'),
            array('value' => 'tuesday', 'title' => 'Tuesday'),
            array('value' => 'wednesday', 'title' => 'Wednesday'),
            array('value' => 'thursday', 'title' => 'Thursday'),
            array('value' => 'friday', 'title' => 'Friday'),
            array('value' => 'saturday', 'title' => 'Saturday'));
    }

    public function array_push_assoc($array, $key, $value) {
        $array[$key] = $value;
        return $array;
    }

    public static function getLanguages() {
        $data = DB::table('languages')
                ->get();
        $new_arr = [];
        for ($i = 0; $i < count($data); $i++) {
            // print_r($data[$i]->{'name'});die;
            $new_arr[$data[$i]->{'name'}] = $data[$i]->{'name'};
        }
        return $new_arr;
        //   print_r($new_arr);die;
        //   return array(
        //       'english'  => 'English',
        //       'spanish'  => 'Spanish',
        //       'french' => 'French',
        //       'hebrew' => 'Hebrew',
        //       'russions'  => 'Russions',
        //       'italian'  => 'Italian');
    }

    public static function getTimeSlot() {
        return array(
            'early_morning' => 'Early Morning ( Before 9am )',
            'morning' => 'Morning ( 9am - 12pm )',
            'afternoon' => 'Afternoon ( 12pm - 6pm )',
            'evening' => 'Evening ( After 6pm )');
    }

    public static function trainingLocation() {
        return array(
            'notravel' => 'I Prefer not to travel',
            'yes travel' => 'I am willing to travel',
        );
    }

    public static function StartActivity() {
        return array(
            'ASAP' => 'Soon as possible',
            'Tomorrow' => 'Tomorrow',
            'ThisWeek' => 'This month',
            'ThisMonths' => 'This month',
            'UpcomingTrip' => 'Upcoming Trip',
            'Other' => 'Other',
        );
    }

    public static function travelUpto() {
        return array(
            '1' => '1 Mile',
            '3' => '3 Miles',
            '5' => '5 Miles',
            '10' => '10 Miles',
            '15' => '15 Miles',
            '20' => '20 Miles',
            '30' => '30 Miles'
        );
    }

    public static function getDays() {
        return array(
            'Sunday' => 'Sunday',
            'Monday' => 'Monday',
            'Tuesday' => 'Tuesday',
            'Wednesday' => 'Wednesday',
            'Thursday' => 'Thursday',
            'Friday' => 'Friday',
            'Saturday' => 'Saturday');
    }

    public static function getQuestions() {

        return array('qoutes' => 'How many quotes you want ?',
            'train_wants' => 'Who will be training?',
            'skill' => 'How skilled are you in this sport?',
            'gear' => 'Do you have any gear for this sport?',
            'work_out' => 'How often do you workout ?',
            'goal' => 'While you are learning your new sport, do you have any fitness goals?',
            'train_location' => 'Where would you like to Train ?',
            'best_work' => 'Which type of professional personality works best for you ?',
            'gender' => 'Do you have a gender preference ?',
            'age' => 'Select Age Range',
            'train_interest' => 'How long are you interested in being trained ?',
            'days_available' => 'What days are you available ?',
            'time_available' => 'What time works best for you ?',
            'medical' => 'Any medical issues ?',
            'personal_train_occur' => 'Where can a personal training occur ?',
            'travel_upto' => 'I will travel upto',
            'personal_training' => 'How soon do you want to start ?',
            'trainer_know' => 'Any important information the provider should be aware of?',
            'sport' => "what Activity ?",
            'experience' => 'What activity experience are you looking for?',
            'experiencelevel' => 'What experience level should your professional have?',
        );
    }

    public static function getAnswers($key = '') {

        $answers = array(
            'football' => 'Football',
            'golf' => 'Golf',
            'basketball' => 'Basketball',
            'baseball' => 'Baseball',
            'rugby' => 'Rugby',
            'icehockey' => 'Ice Hockey',
            'motorsports' => 'Motorsports',
            'tennis' => 'Tennis',
            'shooting' => 'Shooting',
            'wrestling' => 'Wrestling',
            'kid' => 'For a kid',
            'family' => 'For a Family',
            'couple' => 'For a Couple',
            'group' => 'A Group of us',
            'teen' => 'For a Teen',
            'adult' => 'For an adult',
            'never' => 'Never Tried (Looking to start)',
            'intermediate' => 'Intermediate (I have done this before)',
            'beginner' => 'Beginner (I have some experience)',
            'advance' => 'Advanced (I’ve done this a lot before)',
            'never' => 'I Never Work Out',
            'few_time' => 'A Few Times in a Week',
            'been_while' => 'Its Been a While',
            'daily' => 'Fitness is Part of My Daily Life',
            'weight_loss' => 'Weight Loss',
            'weight_gain' => 'Weight Gain',
            'firming_toning' => 'Firming & Toning',
            'flexibility' => 'Flexibility',
            'muscle_strength' => 'Icrease Muscle Strength',
            'aerobics_fitness' => 'Aerobics Fitness',
            'endurance_training' => 'Endurance Training',
            'body_building' => 'Body Building',
            'nutritions' => 'Nutritions',
            'pre_post_natal' => 'Pre/Post Natal',
            'home' => 'Home',
            'office' => 'Office',
            'outdoors' => 'Outdoors',
            'gym' => 'Appartment Gym',
            'studio' => 'Private Studio',
            'recommended' => 'As recommended by Trainer',
            'educator' => 'An Educator & Teacher',
            'lot-of-energy' => 'A Lot Of Energy',
            'drill-sergeant' => 'A Drill Sergeant',
            'challenging' => 'Challenging',
            'bootcamp' => 'Bootcamp',
            'intermediated' => 'Intermediate',
            'advanced' => 'Adavnced',
            'supportive' => 'Supportive, Soft And Nurturing',
            'tough-and-firm' => 'Tough And Firm',
            'care-about-details' => 'Care About The Details',
            'gentle' => 'Gentle',
            'intense' => 'Intense',
            'beginner' => 'Beginner',
            'pro' => 'Pro',
            'male' => 'Male',
            'no_preference' => 'No Preference',
            'female' => 'Female',
            '2-4' => '2 - 4 Years old',
            '5-7' => '5 - 7 Years old',
            '8-12' => '8 - 12 Years old',
            '13-17' => '13 - 17 Years old',
            '18-22' => '18 - 22 Years old',
            '31-40' => '31 - 40 Years old',
            '51-60' => '51 - 60 Years old',
            '23-30' => '23 - 30 Years old',
            '41-50' => '41 - 50 Years old',
            '61-elder' => '61 or Elder',
            '1day' => '1 Day',
            '1week' => '1 Week',
            '2weeks' => '2 Weeks',
            '3weeks' => '3 Weeks',
            '1month' => '1 Month',
            '3month' => '3 Months',
            '5month' => '5 Months',
            '2month' => '2 Months',
            '4month' => '4 Months',
            'recommended' => 'As recommended by Trainer',
            'early_morning' => 'Early Morning ( Before 9am )',
            'early_afternoon' => 'Early Afternoon ( Noon - 3pm )',
            'evening' => 'Evening ( After 6pm )',
            'morning' => 'Morning ( 9am - Noon )',
            'late_afternoon' => 'Late Afternoon ( 3pm - 6pm )',
            'false' => 'No',
            'true' => 'Yes',
            'yes' => 'Yes',
            'no' => 'No',
            '1' => '1 Mile',
            '3' => '3 Miles',
            '5' => '5 Miles',
            '10' => '10 Miles',
            '15' => '15 Miles',
            '20' => '20 Miles',
            '30' => '30 Miles',
            'ASAP' => 'Soon as possible',
            'Tomorrow' => 'Tomorrow',
            'ThisWeek' => 'This week',
            'ThisMonths' => 'This month',
            'UpcomingTrip' => 'Upcoming Trip',
            'Other' => '',
            'notprefer' => 'Not Prefer',
            'prefer' => 'Prefer'
        );

        if (isset($answers[$key]))
            $keyvalue = $answers[$key];
        else
            $keyvalue = $key;
		
        if (!empty($keyvalue) && isset($keyvalue)) {
            return $keyvalue;
        } else {
            return $keyvalue = '';
        }
    }

    public static function getBusinessProfileAnswers($key = '') {
		
        $answers = array(
            'entry_level' => 'Entry Level',
            'intermediate' => 'Intermediate',
            'expert' => 'Expert',
            'early_morning' => 'Early Morning ( Before 9am )',
            'morning' => 'Morning ( 9am - 12pm )',
            'afternoon' => 'Afternoon ( 12pm - 6pm )',
            'evening' => 'Evening ( After 6pm )',
            'kid' => 'For a kid',
            'family' => 'For a Family',
            'couple' => 'For a Couple',
            'group' => 'A Group of us',
            'teen' => 'For a Teen',
            'adult' => 'For an adult',
            'educator' => 'An Educator & Teacher',
            'lot-of-energy' => 'A Lot Of Energy',
            'drill-sergeant' => 'A Drill Sergeant',
            'challenging' => 'Challenging',
            'bootcamp' => 'Bootcamp',
            'intermediated' => 'Intermediate',
            'advanced' => 'Adavnced',
            'supportive' => 'Supportive, Soft And Nurturing',
            'tough-and-firm' => 'Tough And Firm',
            'care-about-details' => 'Care About The Details',
            'gentle' => 'Gentle',
            'intense' => 'Intense',
            'beginner' => 'Beginner',
            'pro' => 'Pro',
        );
		
        if (isset($answers[$key]))
            $keyvalue = $answers[$key];
        else
            $keyvalue = $key;

        if (!empty($keyvalue) && isset($keyvalue)) {
            return $keyvalue;
        } else {
            return $keyvalue = '';
        }
    }

    public static function getSecurityQuestions() {
        return array(
            "pet_name" => "What is your first pet name?",
            "grandfather_profession" => "What is your grand father's profession?",
            "fav_teacher" => "Who was your favorite teacher name in primary school?",
            "first_car" => "What was your first car?",
            "mother_maiden" => "What is your Mother's maiden name?"
        );
    }

    public static function arraysearchcustom($array, $key, $value) {
        $results = array();
        foreach ($array as $arr) {
            if (isset($arr[$key]) && $arr[$key] == $value) {
                return $results = $arr;
            }
        }
        // return $results;
    }

    public static function getBookingQuestionObject($jobsObj) {


        $qutObj = array();
        $qutObj['quote'] = array();

        $userQut = ($qutObj['quote']) ? $qutObj['quote'] : '';

        $questions = Miscellaneous::getQuestions();

        foreach ($jobsObj as $key => $value) {

            //$answers = Miscellaneous::getAnswers();
            $jobsObj[$key]['question'] = @$questions[@$value['question_id']];

            $goalstr = "";
            if ($value['question_id'] !== 'qoutes' && $value['question_id'] !== 'days_available' && $value['question_id'] !== 'goal' && $value['question_id'] !== 'train_location' && $value['question_id'] !== 'best_work' && $value['question_id'] !== 'train_location' && $value['question_id'] !== 'time_available' && $value['question_id'] !== 'train_wants' && $value['question_id'] !== 'goal') {


                $jobsObj[$key]['full_answer'] = Miscellaneous::getAnswers($value['answer']);
            } else if ($value['question_id'] === 'days_available' || $value['question_id'] === 'time_available' || $value['question_id'] === 'best_work' || $value['question_id'] === 'train_wants' || $value['question_id'] === 'train_location' || $value['question_id'] === 'goal') {

                if ($value['question_id'] === 'time_available') {
                    $value['answer'] = str_replace('true', '', $value['answer']);
                    $available = explode('|', $value['answer']);
                    $avl = "";
                    if (count($available) > 0) {
                        if ($avl == "") {
                            $value['answer'] = Miscellaneous::getAnswers($value['answer']);
                        } else {
                            $value['answer'] .= ', ' . Miscellaneous::getAnswers($value['answer']);
                        }
                    }
                }

                if (strpos($value['answer'], '|') !== false) {


                    if ($value['question_id'] === 'best_work') {
                        $workArr = explode('|', $value['answer']);
                        $best_work = "";
                        foreach ($workArr as $k => $v) {
                            if ($best_work == "") {
                                $best_work .= Miscellaneous::getAnswers($v);
                            } else {
                                $best_work .= ', ' . Miscellaneous::getAnswers($v);
                            }
                        }
                        $value['answer'] = $best_work;
                    }

                    if ($value['question_id'] === 'train_wants') {
                        $workArr = explode('|', $value['answer']);
                        $best_work = "";
                        foreach ($workArr as $k => $v) {
                            if ($best_work == "") {
                                $best_work .= Miscellaneous::getAnswers($v);
                            } else {
                                $best_work .= ', ' . Miscellaneous::getAnswers($v);
                            }
                        }
                        $value['answer'] = $best_work;
                    }

                    $replace = ucwords(str_replace('|', ', ', $value['answer']));
                    if (strpos($replace, '_') !== false) {
                        $replace = ucwords(str_replace('_', ' ', $replace));
                    }
                } else {
                    $replace = ucwords(Miscellaneous::getAnswers($value['answer']));
                }
                $jobsObj[$key]['full_answer'] = $replace;
            } else {
                $jobsObj[$key]['full_answer'] = "";
            }
        }

        return $jobsObj;
    }

    public static function getPhoneCode($country = 'US') {
        return '+1';
    }

    public static function getLatLong($zipcode) {
        $return = array();
        $return['lat'] = NULL;
        $return['long'] = NULL;
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $zipcode . "&key=" . Config::get('constants.MAP_KEY');
        $details = @file_get_contents($url);
        if ($details != FALSE) {
            $result = json_decode($details, true);
            if (count($result) > 0 && isset($result['results'][0]['geometry'])) {
                $return['lat'] = $result['results'][0]['geometry']['location']['lat'];
                $return['long'] = $result['results'][0]['geometry']['location']['lng'];
            }
        }
        return $return;
    }

    public static function uploadPhotoGallery($file, $file_upload_path, $is_thumbnail = 0, $thumbnail_upload_path = NULL, $thumbnail_height = NULL, $thumbnail_width = NULL) {
        if (!is_dir($file_upload_path)) {
            mkdir($file_upload_path, 0775, true);
        }
        if (!is_dir($thumbnail_upload_path)) {
            mkdir($thumbnail_upload_path, 0775, true);
        }
        if ($file && $file_upload_path && $file_upload_path != '') {
            if (@getimagesize($file)[2] > 0) {
                $min_width = 350;
                $min_height = 300;
                // Check file width
                $filename = time() . '-' . $file->getClientOriginalName();
                $image = Image::make($file);
                $file_width = $image->width();
                $file_height = $image->height();
                $v_height = $min_width * $file_height / $file_width;
                if ($file_height >= $file_width) {
                    if ($file_height <= $min_height) {
                        return array('success' => false, 'message' => 'Please provide higher resolution images');
                    }
                    Image::make($file)->save($file_upload_path . $filename);
                    //Image::make($file)->resize($file_width, $min_height)->save($thumbnail_upload_path . $filename);
                    $image->resize(null, $min_height, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $image->save($thumbnail_upload_path . $filename);
                    return array('success' => true, 'filename' => $filename);
                }
                if ($file_height <= $file_width) {
                    if ($file_width <= $min_height) {
                        return array('success' => false, 'message' => 'Please provide higher resolution images');
                    }
                    Image::make($file)->save($file_upload_path . $filename);
                    //Image::make($file)->resize($min_width, $file_height)->save($thumbnail_upload_path . $filename);
                    $image->resize($min_width, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $image->save($thumbnail_upload_path . $filename);
                    return array('success' => true, 'filename' => $filename);
                }
            } else {
                return array('success' => false, 'message' => 'Image must be a file of type: jpg, png, jpeg.');
            }
        } else {
            return array('success' => false, 'message' => 'Error uploading image.');
        }
    }

    public static function savePostImageAndThumbnail($file, $file_upload_path, $is_thumbnail = 0, $thumbnail_upload_path = NULL, $thumbnail_height = NULL, $thumbnail_width = NULL) {

        if (!is_dir($file_upload_path)) {
            mkdir($file_upload_path, 0775, true);
        }

        if (!is_dir($thumbnail_upload_path)) {
            mkdir($thumbnail_upload_path, 0775, true);
        }

        if ($file && $file_upload_path && $file_upload_path != '') {

            if (@getimagesize($file)[2] > 0) {
                $min_width = 400;
                $min_height = 400;
                // Check file width
                $filename = time() . '-' . $file->getClientOriginalName();
                $image = Image::make($file);
                $file_width = $image->width();
                $file_height = $image->height();
                $v_height = $min_width * $file_height / $file_width;
                if ($file_height >= $file_width) {
                    if ($file_height <= $min_height) {
                        return array('success' => false, 'message' => 'Please provide higher resolution images');
                    }
                    Image::make($file)->save($file_upload_path . $filename);
                    //Image::make($file)->resize($file_width, $min_height)->save($thumbnail_upload_path . $filename);
                    $image->resize(null, $min_height, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $image->save($thumbnail_upload_path . $filename);
                    return array('success' => true, 'filename' => $filename);
                }

                if ($file_height <= $file_width) {
                    if ($file_width <= $min_height) {
                        return array('success' => false, 'message' => 'Please provide higher resolution images');
                    }

                    Image::make($file)->save($file_upload_path . $filename);
                    //Image::make($file)->resize($min_width, $file_height)->save($thumbnail_upload_path . $filename);
                    $image->resize($min_width, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $image->save($thumbnail_upload_path . $filename);
                    return array('success' => true, 'filename' => $filename);
                }

                // if ($file_width > $min_width) {
                //     $image->resize($min_width, null, function ($constraint) {
                //         $constraint->aspectRatio();
                //     });
                // } elseif ($file_height > $min_height) {
                //     $image->resize(null, $min_height, function ($constraint) {
                //         $constraint->aspectRatio();
                //     });
                // }
                // if($is_thumbnail == 1 && $thumbnail_upload_path && $thumbnail_upload_path != ''){
                //     if(!$thumbnail_height) $thumbnail_height = 100;
                //     if(!$thumbnail_width) $thumbnail_width = $thumbnail_height;
                //     //Store thumb
                //     Image::make($file)->resize($thumbnail_width, $thumbnail_height)->save($thumbnail_upload_path . $filename);
                // }
                // Image::make($file)->save($file_upload_path . $filename);
                // $image->save($thumbnail_upload_path . $filename);
            } else {
                return array('success' => false, 'message' => 'Image must be a file of type: jpg, png, jpeg.');
            }
        } else {
            return array('success' => false, 'message' => 'Error uploading image.');
        }
    }

    public static function saveFileAndThumbnail($file, $file_upload_path, $is_thumbnail = 0, $thumbnail_upload_path = NULL, $thumbnail_height = NULL, $thumbnail_width = NULL) {

        if (!is_dir($file_upload_path) || !file_exists($file_upload_path)) {
            mkdir($file_upload_path, 0775, true);
        }

        if (!is_dir($thumbnail_upload_path) || !file_exists($thumbnail_upload_path)) {
            mkdir($thumbnail_upload_path, 0775, true);
        }


        if ($file && $file_upload_path && $file_upload_path != '') {
            if (@getimagesize($file)[2] > 0) {
                // $max_width = 500;
                // $max_height = 500;
                // Check file width
                $filename = time() . '-' . $file->getClientOriginalName();
                $image = Image::make($file);

                $file_width = $image->width();
                $file_height = $image->height();

                if ($is_thumbnail == 1 && $thumbnail_upload_path && $thumbnail_upload_path != '') {

                    if (!$thumbnail_height)
                        $thumbnail_height = 100;
                    if (!$thumbnail_width)
                        $thumbnail_width = $thumbnail_height;

                    //Store thumb
                    Image::make($file)->resize($thumbnail_width, $thumbnail_height)->save($thumbnail_upload_path . $filename);
                }

                // if ($file_width > $max_width && $file_height > $max_height) {
                //     $image->resize($max_width, $max_height);
                // } elseif ($file_width > $max_width) {
                //     $image->resize($max_width, null, function ($constraint) {
                //         $constraint->aspectRatio();
                //     });
                // } elseif ($file_height > $max_height) {
                //     $image->resize(null, $max_height, function ($constraint) {
                //         $constraint->aspectRatio();
                //     });
                // }

                $image->save($file_upload_path . $filename);

                return array(
                    'success' => 'File uploaded succesfully!',
                    'filename' => $filename
                );
            } else {
                return array('danger' => 'Image must be a file of type: jpg, png, jpeg.');
            }
        } else {
            return array('danger' => 'Error uploading image.');
        }
    }

    public static function saveFileAndThumbnail1($file, $file_upload_path, $is_thumbnail = 0, $thumbnail_upload_path = NULL, $thumbnail_height = NULL, $thumbnail_width = NULL) {

        if (!is_dir($file_upload_path) || !file_exists($file_upload_path)) {
            mkdir($file_upload_path, 0775, true);
        }

        if (!is_dir($thumbnail_upload_path) || !file_exists($thumbnail_upload_path)) {
            mkdir($thumbnail_upload_path, 0775, true);
        }


        if ($file && $file_upload_path && $file_upload_path != '') {

            if (@getimagesize($file)[2] > 0) {

                // $max_width = 500;
                // $max_height = 500;
                // Check file width
                $filename = time() . '-' . $file->getClientOriginalName();
                $image = Image::make($file);

                $file_width = $image->width();
                $file_height = $image->height();

                if ($is_thumbnail == 1 && $thumbnail_upload_path && $thumbnail_upload_path != '') {

                    if (!$thumbnail_height)
                        $thumbnail_height = 100;
                    if (!$thumbnail_width)
                        $thumbnail_width = $thumbnail_height;

                    //Store thumb
                    //Image::make($file)->resize($file_width, $file_height)->save($thumbnail_upload_path . $filename);
                    Image::make($file)->save($thumbnail_upload_path . $filename);
                }


                // if ($file_width > $max_width && $file_height > $max_height) {
                //     $image->resize($max_width, $max_height);
                // } elseif ($file_width > $max_width) {
                //     $image->resize($max_width, null, function ($constraint) {
                //         $constraint->aspectRatio();
                //     });
                // } elseif ($file_height > $max_height) {
                //     $image->resize(null, $max_height, function ($constraint) {
                //         $constraint->aspectRatio();
                //     });
                // }

                $image->save($file_upload_path . $filename);

                return array(
                    'success' => 'File uploaded succesfully!',
                    'filename' => $filename
                );
            } else {
                return array('danger' => 'Image must be a file of type: jpg, png, jpeg.');
            }
        } else {
            return array('danger' => 'Error uploading image.');
        }
    }

    public static function businessType() {
        return ProfessionalType::select('type', 'id')->get();
    }

    public static function programType() {
        return array(
            'Personal Training' => 'Personal Training',
            'Coaching' => 'Coaching',
            'Therapy' => 'Therapy',
            'Class' => 'Class',
            'Team' => 'Team',
            'Camp' => 'Camp',
            'Clinic' => 'Clinic',
            'Adventure' => 'Adventure',
            'Trips' => 'Trips',
            'Tours' => 'Tours'
        );
    }

    public static function programFor() {
        return array(
            'kid' => 'Kids',
            'teen' => 'Teens',
            'adult' => 'Adults',
            'seniors' => 'Seniors'
        );
    }

    public static function numberOfPeople() {
        return array(
            "1" => "1",
            "2" => "2",
            "5" => "5",
            "10" => "10",
            "20" => "20",
            "30" => "30",
            "40" => "40",
            "50" => "50",
                // "Any"=>"Any"
        );
    }

    public static function activity() {
        return array(
            'An Individual' => 'An Individual',
            'For a couple/partner' => 'For a couple/partner',
            'For a family ' => 'For a family ',
            'For a group' => 'For a group',
            'Any' => 'Any'
        );
    }

    public static function ageRange() {
        return array(
            'Newborn (0 to 4 weeks)' => 'Newborn (0 to 4 weeks)',
            'Infant (4 weeks to 1 year.)' => 'Infant (4 weeks to 1 year.)',
            'Toddler (12 months to 24 months)' => 'Toddler (12 months to 24 months)',
            'Preschooler (2 to 5 years)' => 'Preschooler (2 to 5 years)',
            'Grade School (6 to 12 years)' => 'Grade School (6 to 12 years)',
            'Teens (13 to 17)' => 'Teens (13 to 17)',
            'Adult (18 to 49)' => 'Adult (18 to 49)',
            'Ages 50+' => 'Ages 50+',
            'All Ages' => 'All Ages',
        );
    }

    public static function expLevel() {
        return array(
            'Beginner' => 'Beginner',
            'Intermediate' => 'Intermediate',
            'Advance' => 'Advance',
            'Amateur' => 'Amateur',
            'Professional' => 'Professional',
            'any' => 'Any'
        );
    }

    public static function participateActivity() {
        return array(
            'One time' => 'One time',
            '1x a week' => '1x a week',
            '2x a week' => '2x a week',
            '3x a week' => '3x a week',
            '4x a week' => '4x a week',
            '5x a week' => '5x a week',
            '6x a week' => '6x a week',
            'Monthly' => 'Monthly',
            'Yearly' => 'Yearly',
            'Other' => 'Other'
        );
    }

    public static function dayactivity() {
        return array(
            'Sunday' => 'Sunday',
            'Monday' => 'Monday',
            'Tuesday' => 'Tuesday',
            'Wednesday' => 'Wednesday',
            'Thursday' => 'Thursday',
            'Friday' => 'Friday',
            'Saturday' => 'Saturday'
        );
    }

    public static function expProfessional() {
        return array(
            'Level 1 (less than 6 months)' => 'Level 1 (less than 6 months)',
            'Level 2 (One year and less) ' => 'Level 2 (One year and less)',
            'Level 3 (5 years and less)' => 'Level 3 (5 years and less)',
            'Level 4 (10 years and less)' => 'Level 4 (10 years and less)',
            'Level 5 (10 Years or more)' => 'Level 5 (10 Years or more)',
            'any' => 'Any'
        );
    }

    public static function activeLevel() {
        return array(
            'I’m not active at all' => 'I’m not active at all',
            'It’s been a while ' => 'It’s been a while ',
            'A Few Times in a Week' => 'A Few Times in a Week',
            'More than a few times a week' => 'More than a few times a week',
            'Almost Daily' => 'Almost Daily',
            'Other' => 'Other'
        );
    }

    public static function expActivity() {
        return array(
            "Technical" => "Technical",
            "Workout" => "Workout",
            "Bootcamp" => "Bootcamp",
            "Challenging and Tough " => "Challenging and Tough ",
            "Strength and Conditioning" => "Strength and Conditioning",
            "Learning a skill" => "Learning a skill",
            "Educational" => "Educational",
            "Adventurous" => "Adventurous"
        );
    }

    public static function teaching() {
        return array(
            "An educator & teacher" => "An educator & teacher",
            "A lot of energy" => "A lot of energy",
            "A drill sergeant" => "A drill sergeant",
            "Inspiring" => "Inspiring",
            "Motivational" => "Motivational",
            "Supportive, Soft and Nurturing" => "Supportive, Soft and Nurturing",
            "Tough and Firm" => "Tough and Firm",
            "Detail oriented" => "Detail oriented",
            "Gentle" => "Gentle",
            "Intense" => "Intense",
            "Calls a spade a spade" => "Calls a spade a spade",
            "Likes to talk" => "Likes to talk",
            "Punctual" => "Punctual",
            "Organized" => "Organized",
            "Stern" => "Stern",
            "Friendly & outgoing " => "Friendly & outgoing ",
            "Tells Jokes" => "Tells Jokes",
            "Entertaining & Funny" => "Entertaining & Funny",
            "Any" => "Any",
        );
    }

    public static function serviceLocation() {
        return array(
            "Online" => "Online",
            /*"Local Gym" => "Local Gym",
            "Studio" => "Studio",
            "Training Facility" => "Training Facility",
            "My Home/Apartment" => "My Home/Apartment",
            "My Office" => "My Office",
            "Outside" => "Outside",
            "Recommended by Provider" => "Recommended by Provider",*/
			"At Business" => "At Business",
			"On Location" => "On Location",
            /*"Any" => "Any",*/
        );
    }

    public static function gender() {
        return array(
            "Male" => "Male",
            "Female" => "Female",
            "No" => "No Preference"
        );
    }

    public static function pFocuses() {
        return array(
            'Teaching a desired skill' => 'Teaching a desired skill',
            'Accomplish a goal or skill' => 'Accomplish a goal or skill',
            'Cardio' => 'Cardio',
            'Weight loss' => 'Weight loss',
            'Technique' => 'Technique',
            'Strength and conditioning' => 'Strength and conditioning',
            'Athletic conditioning' => 'Athletic conditioning',
            'Body building' => 'Body building',
            'Total body workout' => 'Total body workout',
            'Get toned' => 'Get toned',
            'With equipment' => 'With equipment',
            'Fun experience' => 'Fun experience',
            'Thrilling experience' => 'Thrilling experience',
            'Challenging experience' => 'Challenging experience',
            'Gross motor skills' => 'Gross motor skills',
            'Hand eye coordination' => 'Hand eye coordination',
            'Discipline' => 'Discipline',
            'Focus' => 'Focus',
            'Self-Defense' => 'Self-Defense',
            'Confidence' => 'Confidence',
            'Mental Challenge' => 'Mental Challenge',
        );
    }

    public static function specialDeals() {
        return array(
            'trial' => 'Trial Session',
            'Gift Certificate' => 'Gift Certificate',
            'Student Discount' => 'Student Discount',
            'Military Discount' => 'Military Discount',
            'Holiday Special' => 'Holiday Special',
            'Black Friday' => 'Black Friday',
            'Cyber Monday' => 'Cyber Monday',
            'New Year’s Resolution' => 'New Year’s Resolution',
            'New Members Only' => 'New Members Only',
            'Summer Special' => 'Summer Special',
            'Winter Special' => 'Winter Special',
            'Fall Special ' => 'Fall Special ',
            'Spring Special' => 'Spring Special',
        );
    }

    public static function servicePriceOption() {
        return array(
            "Per Trip" => "Per Trip",
            "Per Tour" => "Per Tour",
            'Drop In' => 'Drop In',
            'Per Class' => 'Per Class',
            'Assessment' => 'Assessment',
            'Consultation' => 'Consultation',
            'Contract' => 'Contract',
            "Membership" => "Membership"
        );
    }

    public static function duration() {
        return array(
            '1 Session' => '1 Session',
            '2 Sessions' => '2 Sessions',
            '3 Sessions' => '3 Sessions',
            '4 Sessions' => '4 Sessions',
            '5 Sessions' => '5 Sessions',
            '10 Sessions' => '10 Sessions',
            '15 Sessions' => '15 Sessions',
            '20 Sessions' => '20 Sessions',
            '25 Sessions' => '25 Sessions',
            '30 Sessions' => '30 Sessions',
            '40 Sessions' => '40 Sessions',
            '50 Sessions' => '50 Sessions',
        );
    }

    public static function sportActivity() {
        return array(
        );
    }

}
