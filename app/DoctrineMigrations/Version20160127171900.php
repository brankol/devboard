<?php
namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160127171900 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE GithubRepos ADD hookId CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE GithubRepos ADD CONSTRAINT FK_DD984E142A45E91 FOREIGN KEY (hookId) REFERENCES GithubHooks (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DD984E142A45E91 ON GithubRepos (hookId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE GithubRepos DROP FOREIGN KEY FK_DD984E142A45E91');
        $this->addSql('DROP INDEX UNIQ_DD984E142A45E91 ON GithubRepos');
        $this->addSql('ALTER TABLE GithubRepos DROP hookId');
    }
}
