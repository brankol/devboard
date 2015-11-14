@user
Feature: User sign up
  In order to use site
  As a new user
  I need to sign up using Github

  @javascript @integration
  Scenario: Sign up using Github OAuth2
    Given I am on homepage
    And I click "Sign in with Github"
    Then I should see "Sign in"
    When I fill in github test credentials
    And I press "Sign in"
    Then I should be on homepage