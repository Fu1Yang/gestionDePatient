<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241212161246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE connexion ADD secretary_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE connexion ADD CONSTRAINT FK_936BF99CA2A63DB2 FOREIGN KEY (secretary_id) REFERENCES secretary (id)');
        $this->addSql('CREATE INDEX IDX_936BF99CA2A63DB2 ON connexion (secretary_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE connexion DROP FOREIGN KEY FK_936BF99CA2A63DB2');
        $this->addSql('DROP INDEX IDX_936BF99CA2A63DB2 ON connexion');
        $this->addSql('ALTER TABLE connexion DROP secretary_id');
    }
}
