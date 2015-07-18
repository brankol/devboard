Feature: User registration
  In order to use site
  As a new user
  I need to register

  Scenario: Check that registration is available from homepage
    Given I am on "/"
    And I click "Join"
    Then I should see "Repeat password"
    And url is "/register/"

  Scenario: Check that registration works for new user
    Given there is no user on site with email "test@examaple.com"
    And I am on "/register"
    And I fill in "fos_user_registration_form_username" with "test"
    And I fill in "fos_user_registration_form_email" with "test@examaple.com"
    And I fill in "fos_user_registration_form_plainPassword_first" with "pass123"
    And I fill in "fos_user_registration_form_plainPassword_second" with "pass123"
    And I press "Register"
    Then url is "/register/confirmed"
