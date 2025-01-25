<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250125162804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE connexion CHANGE secretary_id secretary_id INT  NULL');
        $this->addSql('ALTER TABLE history_rdv ADD id_history_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE history_rdv ADD CONSTRAINT FK_FE6C4249BB8F0485 FOREIGN KEY (id_history_id) REFERENCES patient_account (id)');
        $this->addSql('CREATE INDEX IDX_FE6C4249BB8F0485 ON history_rdv (id_history_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE connexion CHANGE secretary_id secretary_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE history_rdv DROP FOREIGN KEY FK_FE6C4249BB8F0485');
        $this->addSql('DROP INDEX IDX_FE6C4249BB8F0485 ON history_rdv');
        $this->addSql('ALTER TABLE history_rdv DROP id_history_id');
    }
}
