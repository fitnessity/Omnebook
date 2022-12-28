require_relative 'base'


create_driver

login

$driver.get "#{BASE_URL}/personal-profile/payment-info"
$wait.until { $driver.find_element(class: 'logo-header') }

$driver.get "#{BASE_URL}/personal-profile/calendar"
$wait.until { $driver.find_element(class: 'logo-header') }

$driver.get "#{BASE_URL}/personal-profile/add-family"
$wait.until { $driver.find_element(class: 'logo-header') }

$driver.get "#{BASE_URL}/personal-profile/favorite"
$wait.until { $driver.find_element(class: 'logo-header') }

$driver.get "#{BASE_URL}/personal-profile/followers"
$wait.until { $driver.find_element(class: 'logo-header') }

$driver.get "#{BASE_URL}/personal-profile/following"
$wait.until { $driver.find_element(class: 'logo-header') }

$driver.get "#{BASE_URL}/personal-profile/booking-info"
$wait.until { $driver.find_element(class: 'logo-header') }


$driver.get "#{BASE_URL}/manage/company"
$wait.until { $driver.find_element(class: 'logo-header') }

element = $driver.find_element(id: 'btnedit').click
$wait.until { $driver.find_element(class: 'tab-hed') }

element = $driver.find_element(partial_link_text: 'Your Experience').click
$wait.until { $driver.find_element(class: 'tab-hed') }

element = $driver.find_element(partial_link_text: 'Company Specifics').click
$wait.until { $driver.find_element(class: 'tab-hed') }

element = $driver.find_element(partial_link_text: 'Set Your Terms').click
$wait.until { $driver.find_element(class: 'tab-hed') }

element = $driver.find_element(partial_link_text: 'Create/Manage Services').click
$wait.until { $driver.find_element(class: 'tab-hed') }









