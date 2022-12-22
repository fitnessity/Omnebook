require_relative 'base'

create_driver


$driver.get "#{BASE_URL}"
$wait.until { $driver.find_element(class: 'logo-header') }


$driver.get "#{BASE_URL}/activities"
$wait.until { $driver.find_element(class: 'logo-header') }


$driver.get "#{BASE_URL}/activities/next_8_hours"
$wait.until { $driver.find_element(class: 'logo-header') }


$driver.get "#{BASE_URL}/activities/get_started/events"
$wait.until { $driver.find_element(class: 'logo-header') }


$driver.get "#{BASE_URL}/activities/get_started/experiences"
$wait.until { $driver.find_element(class: 'logo-header') }


$driver.get "#{BASE_URL}/activities/get_started/ways_to_workout"
$wait.until { $driver.find_element(class: 'logo-header') }


$driver.get "#{BASE_URL}/activities/get_started/personal_trainer"
$wait.until { $driver.find_element(class: 'logo-header') }


$driver.get "#{BASE_URL}/registration"
$wait.until { $driver.find_element(class: 'logo-header') }


$driver.get "#{BASE_URL}/userlogin"
$wait.until { $driver.find_element(class: 'logo-header') }


$driver.get "#{BASE_URL}/businessprofile/Valor%20NYC%2012/425"
$wait.until { $driver.find_element(class: 'logo-header') }


$driver.get "#{BASE_URL}/activity-details/36"
$wait.until { $driver.find_element(class: 'logo-header') }


$driver.get "#{BASE_URL}/claim-your-business"
$wait.until { $driver.find_element(class: 'logo-header') }


$driver.get "#{BASE_URL}/help-center"
$wait.until { $driver.find_element(class: 'logo-header') }


$driver.get "#{BASE_URL}/feedback"
$wait.until { $driver.find_element(class: 'logo-header') }


$driver.get "#{BASE_URL}/privacy-policy"
$wait.until { $driver.find_element(class: 'logo-header') }


$driver.get "#{BASE_URL}/terms-condition"
$wait.until { $driver.find_element(class: 'logo-header') }






