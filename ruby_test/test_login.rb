require_relative 'base'

create_driver


$driver.get BASE_URL


$wait.until { $driver.find_element(class: 'logo-header') }


element = $driver.find_element(css: '.btn.business-sp.btn-style-two')

element = $driver.find_element(partial_link_text: 'Sign in').click
$wait.until { $driver.find_element(class: 'logo-header') }

$driver.find_element(id: 'email').send_keys 'nipavadhavana@gmail.com'
$driver.find_element(id: 'password').send_keys '12345678'
$driver.find_element(id: 'login_submit').click

$wait.until { $driver.find_element(class: 'logo-header') }


