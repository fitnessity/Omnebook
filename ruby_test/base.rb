require 'rubygems'
require 'selenium-webdriver'

BASE_URL = "https://www.fitnessity.co"

$wait = Selenium::WebDriver::Wait.new(:timeout => 10)

def login
  $driver.get "#{BASE_URL}/userlogin"
  $wait.until { $driver.find_element(class: 'logo-header') }

  $driver.find_element(id: 'email').send_keys 'nipavadhavana@gmail.com'
  $driver.find_element(id: 'password').send_keys '12345678'
  $driver.find_element(id: 'login_submit').click
end

def create_driver
  $driver = Selenium::WebDriver.for :chrome
  
end