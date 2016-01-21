<?php
namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160120135637 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE GithubRepos DROP FOREIGN KEY FK_DD984E14A4584355');
        $this->addSql('DROP INDEX UNIQ_DD984E14A4584355 ON GithubRepos');
        $this->addSql('ALTER TABLE GithubRepos DROP hook');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE GithubRepos ADD hook CHAR(36) DEFAULT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE GithubRepos ADD CONSTRAINT FK_DD984E14A4584355 FOREIGN KEY (hook) REFERENCES GithubHooks (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DD984E14A4584355 ON GithubRepos (hook)');
    }
}
