<?php
namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151206221848 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE GithubPullRequests (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', number INT NOT NULL, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, state INT NOT NULL, locked TINYINT(1) NOT NULL, merged TINYINT(1) NOT NULL, githubCreatedAt DATETIME NOT NULL, githubUpdatedAt DATETIME NOT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, repoId CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', createdById CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', assignedToId CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', lastCommitId CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_8D3BFBC0E52A88D8 (repoId), INDEX IDX_8D3BFBC0774D5986 (createdById), INDEX IDX_8D3BFBC01BF04F05 (assignedToId), INDEX IDX_8D3BFBC06707D2E (lastCommitId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE GithubPullRequests ADD CONSTRAINT FK_8D3BFBC0E52A88D8 FOREIGN KEY (repoId) REFERENCES GithubRepos (id)');
        $this->addSql('ALTER TABLE GithubPullRequests ADD CONSTRAINT FK_8D3BFBC0774D5986 FOREIGN KEY (createdById) REFERENCES GithubUsers (id)');
        $this->addSql('ALTER TABLE GithubPullRequests ADD CONSTRAINT FK_8D3BFBC01BF04F05 FOREIGN KEY (assignedToId) REFERENCES GithubUsers (id)');
        $this->addSql('ALTER TABLE GithubPullRequests ADD CONSTRAINT FK_8D3BFBC06707D2E FOREIGN KEY (lastCommitId) REFERENCES GithubCommits (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE GithubPullRequests');
    }
}
