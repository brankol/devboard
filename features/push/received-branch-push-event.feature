@push
Feature: Creating github branch from push event
  In order to have github branch monitored
  As a system
  I need to add github branch data from Github push

  Background:
    Given I am logged in as "visitor1"
    And there is "AcmeDude542/BreakingBad" github repo
    And there is "master" branch on "AcmeDude542/BreakingBad" github repo

  Scenario: Creating new github branch from push event
    Given I received github push event:
      | repositoryOwner | repositoryName | branch_name    | created | deleted | commitSha | commitMessage     | authorName | authorEmail      | authorUsername | committerName | committerEmail   | committerUsername |
      | AcmeDude542     | BreakingBad    | feature-branch | true    | false   | 1234abc   | New master branch | John Doe   | john@example.com | JohnDoe99999   | Jack Smith    | jack@example.com | jacksmith99999    |
    When I process push event
    Then there should be github branch "feature-branch" for "AcmeDude542/BreakingBad" in system
    And there should be github commit "1234abc" for "AcmeDude542/BreakingBad" in system
    And there should be github user with username "JohnDoe99999"
    And there should be github user with username "jacksmith99999"


  Scenario: Creating new github branch from push event where author is committer
    Given I received github push event:
      | repositoryOwner | repositoryName | branch_name    | created | deleted | commitSha | commitMessage     | authorName | authorEmail      | authorUsername | committerName | committerEmail   | committerUsername |
      | AcmeDude542     | BreakingBad    | feature-branch | true    | false   | 1234abc   | New master branch | John Doe   | john@example.com | JohnDoe99999   | John Doe      | john@example.com | JohnDoe99999      |
    When I process push event
    Then there should be github branch "feature-branch" for "AcmeDude542/BreakingBad" in system
    And there should be github commit "1234abc" for "AcmeDude542/BreakingBad" in system
    And there should be github user with username "JohnDoe99999"


  Scenario: Updating github branch from push event
    Given I received github push event:
      | repositoryOwner | repositoryName | branch_name | created | deleted | commitSha | commitMessage     | authorName | authorEmail      | authorUsername | committerName | committerEmail   | committerUsername |
      | AcmeDude542     | BreakingBad    | master      | false   | false   | 1234abc   | New master branch | John Doe   | john@example.com | JohnDoe99999   | Jack Smith    | jack@example.com | jacksmith99999    |
    And there should be github branch "master" for "AcmeDude542/BreakingBad" in system
    When I process push event
    Then there should be github branch "master" for "AcmeDude542/BreakingBad" in system
    And there should be github commit "1234abc" for "AcmeDude542/BreakingBad" in system
    And there should be github user with username "JohnDoe99999"
    And there should be github user with username "jacksmith99999"


  Scenario: Deleteing github branch from push event
    Given I received github push event:
      | repositoryOwner | repositoryName | branch_name | created | deleted | commitSha | commitMessage     | authorName | authorEmail      | authorUsername | committerName | committerEmail   | committerUsername |
      | AcmeDude542     | BreakingBad    | master      | false   | true   | 1234abc   | New master branch | John Doe   | john@example.com | JohnDoe99999   | Jack Smith    | jack@example.com | jacksmith99999    |
    And there should be github branch "master" for "AcmeDude542/BreakingBad" in system
    When I process push event
    Then there should be no github branch "master" for "AcmeDude542/BreakingBad" in system
    And there should be no github commit "1234abc" for "AcmeDude542/BreakingBad" in system
    And there should be no github user with username "JohnDoe99999"
    And there should be no github user with username "jacksmith99999"