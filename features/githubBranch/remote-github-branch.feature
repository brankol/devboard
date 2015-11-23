@githubBranch
Feature: Remove github branch
  In order to have github branch monitored
  As a user
  I need to fetch remote github branch data

  Background:
    Given I am logged in as "visitor1"
    And there is "devboard/test-hitman" github repo


  Scenario: Fetching github branch data
    Given I am fetching remote branch data from Github
    When I look for details "master" on "devboard/test-hitman" github repo
    Then I will get branch details

