@githubRepo
Feature: Remote Github repo data
  In order to have github repos monitored
  As a user
  I need to fetch remote github repo data

  Background:
    Given I am logged in as "visitor1"

  Scenario: Fetching remote repo data
    Given I am fetching remote repo data from Github
    When I look for details on "devboard/test-hitman"
    Then I will get repo details

  Scenario: Fetching non existing remote repo data
    Given I am fetching remote repo data from Github
    When I look for details on "AcmeDude542/BreakingBad"
    Then I will get an error that repo doesnt exist
