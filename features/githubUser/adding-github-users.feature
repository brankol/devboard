@githubUser
Feature: Github user data
  In order to show relevant commit/issue/branch information
  As a user
  I need to add github user data

  Background:
    Given I am logged in as "visitor1"
    And there is github user with:
      | property  | value                      |
      | githubId  | 2                          |
      | username  | batman2134                 |
      | email     | batman2134@example.com     |
      | name      | Lucky Ngo                  |
      | avatarUrl | http://example.com/ngo.png |

  Scenario: Creating new github user
    Given I am adding new github user
    When I fill in:
      | property  | value                         |
      | githubId  | 11                            |
      | username  | superhero9009                 |
      | email     | superhero9009@example.com     |
      | name      | Jack Doe                      |
      | avatarUrl | http://example.com/avatar.png |
    And I save changes
    Then there should be user with "superhero9009" username in system

  Scenario: Username is only 'must have' info on user
    Given I am adding new github user
    When I fill in:
      | property | value  |
      | username | WhoLee |
    And I save changes
    Then there should be user with "WhoLee" username in system


  Scenario: Username is unique
    Given I am adding new github user
    When I fill in:
      | property | value      |
      | username | batman2134 |
      | name     | Jack Doe   |
    And I save changes
    Then I should see validation error that username already in use

  Scenario: GithubId is unique
    Given I am adding new github user
    When I fill in:
      | property | value   |
      | githubId | 2       |
      | username | JackDoe |
    And I save changes
    Then I should see validation error that githubId already in use

  Scenario: Email is unique
    Given I am adding new github user
    When I fill in:
      | property | value                  |
      | email    | batman2134@example.com |
      | username | JackDoe                |
    And I save changes
    Then I should see validation error that email already in use


  Scenario: Creating new github user
    Given I am adding new github user
    When I create "msvrtan" github user
    Then there should be user with "msvrtan" username in system

  Scenario: Creating new github user that doesnt exist
    Given I am adding new github user
    When I create "AcmeDude542" github user
    Then I will get an error that user doesnt exist
