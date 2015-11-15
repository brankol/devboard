@githubRepo
Feature: Creating github repo
  In order to have github repos monitored
  As a user
  I need to add github repo as a part of creating project

  Background:
    Given I am logged in as "visitor1"

  Scenario: Creating new github repo
    Given I am adding new github repo
    When I create "devboard/test-hitman" github repo
    Then there should be github repo with "devboard/test-hitman" as full name in system

  Scenario: Creating new github repo that doesnt exist
    Given I am adding new github repo
    When I create "AcmeDude542/BreakingBad" github repo
    Then I will get an error that repo doesnt exist
