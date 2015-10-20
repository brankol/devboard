<?php
namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151018191654 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Projects (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', projectName VARCHAR(255) NOT NULL, active INT NOT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ProjectGithubRepos (project_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', githubrepo_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_FB337D6E166D1F9C (project_id), INDEX IDX_FB337D6E4D67CCE7 (githubrepo_id), PRIMARY KEY(project_id, githubrepo_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ProjectUsers (project_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_id INT NOT NULL, INDEX IDX_A9C7E916166D1F9C (project_id), INDEX IDX_A9C7E916A76ED395 (user_id), PRIMARY KEY(project_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE GithubRepos (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', githubId INT NOT NULL, owner VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, fullName VARCHAR(255) NOT NULL, htmlUrl VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, fork INT NOT NULL, defaultBranch VARCHAR(255) NOT NULL, githubPrivate INT NOT NULL, gitUrl VARCHAR(255) NOT NULL, sshUrl VARCHAR(255) NOT NULL, githubCreatedAt DATETIME NOT NULL, githubUpdatedAt DATETIME NOT NULL, githubPushedAt DATETIME NOT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, UNIQUE INDEX UNIQ_DD984E143157D290 (fullName), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE GithubBranches (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, repoId CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', lastCommitId CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_9833B218E52A88D8 (repoId), INDEX IDX_9833B2186707D2E (lastCommitId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE GithubCommits (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', sha VARCHAR(255) NOT NULL, authorDate DATETIME NOT NULL, committerDate DATETIME NOT NULL, message VARCHAR(255) NOT NULL, internalStatus INT DEFAULT NULL, githubStatus INT DEFAULT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, githubRepoId CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', authorId CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', committerId CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_3FB6E1D3BF42037E (githubRepoId), INDEX IDX_3FB6E1D3A196F9FD (authorId), INDEX IDX_3FB6E1D3D6B9275D (committerId), UNIQUE INDEX uniq_repo_sha (githubRepoId, sha), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ProjectGithubRepos ADD CONSTRAINT FK_FB337D6E166D1F9C FOREIGN KEY (project_id) REFERENCES Projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ProjectGithubRepos ADD CONSTRAINT FK_FB337D6E4D67CCE7 FOREIGN KEY (githubrepo_id) REFERENCES GithubRepos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ProjectUsers ADD CONSTRAINT FK_A9C7E916166D1F9C FOREIGN KEY (project_id) REFERENCES Projects (id)');
        $this->addSql('ALTER TABLE ProjectUsers ADD CONSTRAINT FK_A9C7E916A76ED395 FOREIGN KEY (user_id) REFERENCES Users (id)');
        $this->addSql('ALTER TABLE GithubBranches ADD CONSTRAINT FK_9833B218E52A88D8 FOREIGN KEY (repoId) REFERENCES GithubRepos (id)');
        $this->addSql('ALTER TABLE GithubBranches ADD CONSTRAINT FK_9833B2186707D2E FOREIGN KEY (lastCommitId) REFERENCES GithubCommits (id)');
        $this->addSql('ALTER TABLE GithubCommits ADD CONSTRAINT FK_3FB6E1D3BF42037E FOREIGN KEY (githubRepoId) REFERENCES GithubRepos (id)');
        $this->addSql('ALTER TABLE GithubCommits ADD CONSTRAINT FK_3FB6E1D3A196F9FD FOREIGN KEY (authorId) REFERENCES GithubUsers (id)');
        $this->addSql('ALTER TABLE GithubCommits ADD CONSTRAINT FK_3FB6E1D3D6B9275D FOREIGN KEY (committerId) REFERENCES GithubUsers (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ProjectGithubRepos DROP FOREIGN KEY FK_FB337D6E166D1F9C');
        $this->addSql('ALTER TABLE ProjectUsers DROP FOREIGN KEY FK_A9C7E916166D1F9C');
        $this->addSql('ALTER TABLE ProjectGithubRepos DROP FOREIGN KEY FK_FB337D6E4D67CCE7');
        $this->addSql('ALTER TABLE GithubBranches DROP FOREIGN KEY FK_9833B218E52A88D8');
        $this->addSql('ALTER TABLE GithubCommits DROP FOREIGN KEY FK_3FB6E1D3BF42037E');
        $this->addSql('ALTER TABLE GithubBranches DROP FOREIGN KEY FK_9833B2186707D2E');
        $this->addSql('DROP TABLE Projects');
        $this->addSql('DROP TABLE ProjectGithubRepos');
        $this->addSql('DROP TABLE ProjectUsers');
        $this->addSql('DROP TABLE GithubRepos');
        $this->addSql('DROP TABLE GithubBranches');
        $this->addSql('DROP TABLE GithubCommits');
    }
}
