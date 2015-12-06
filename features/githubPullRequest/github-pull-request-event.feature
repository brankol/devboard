@githubPullRequest
Feature: Github pull request events
  In order to have github pull request monitored
  As a system
  I need to handle pull request events

  Background:
    Given I am logged in as "visitor1"
    And there is "devboard/test-hitman" github repo

  Scenario: Receiving pull request opened event
    Given I am receiving pull request opened event from Github
    When I process pull request event
    Then there should be github repo with "devboard/devboard" as full name in system
    And there should be github user with username "msvrtan"

  Scenario: Receiving pull request sync event
    Given I am receiving pull request sync event from Github
    When I process pull request event
    Then there should be github repo with "devboard/devboard" as full name in system
    And there should be github user with username "msvrtan"

  Scenario: Receiving pull request labeled event
    Given I am receiving pull request labeled event from Github
    When I process pull request event
    Then there should be github repo with "devboard/devboard" as full name in system
    And there should be github user with username "msvrtan"

  Scenario: Receiving pull request closed event
    Given I am receiving pull request closed event from Github
    When I process pull request event
    Then there should be github repo with "devboard/devboard" as full name in system
    And there should be github user with username "msvrtan"

