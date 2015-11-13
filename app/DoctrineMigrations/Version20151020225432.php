<?php
namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151020225432 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE ProjectUsers');
        $this->addSql('ALTER TABLE Projects ADD userId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Projects ADD CONSTRAINT FK_A5E5D1F264B64DCC FOREIGN KEY (userId) REFERENCES Users (id)');
        $this->addSql('CREATE INDEX IDX_A5E5D1F264B64DCC ON Projects (userId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ProjectUsers (project_id CHAR(36) NOT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:guid)\', user_id INT NOT NULL, INDEX IDX_A9C7E916166D1F9C (project_id), INDEX IDX_A9C7E916A76ED395 (user_id), PRIMARY KEY(project_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ProjectUsers ADD CONSTRAINT FK_A9C7E916A76ED395 FOREIGN KEY (user_id) REFERENCES Users (id)');
        $this->addSql('ALTER TABLE ProjectUsers ADD CONSTRAINT FK_A9C7E916166D1F9C FOREIGN KEY (project_id) REFERENCES Projects (id)');
        $this->addSql('ALTER TABLE Projects DROP FOREIGN KEY FK_A5E5D1F264B64DCC');
        $this->addSql('DROP INDEX IDX_A5E5D1F264B64DCC ON Projects');
        $this->addSql('ALTER TABLE Projects DROP userId');
    }
}
