<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116201755 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE connexion CHANGE secretary_id secretary_id INT NULL');
        $this->addSql('ALTER TABLE patient_account ADD connexion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient_account ADD CONSTRAINT FK_2055034F8D566613 FOREIGN KEY (connexion_id) REFERENCES connexion (id)');
        $this->addSql('CREATE INDEX IDX_2055034F8D566613 ON patient_account (connexion_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patient_account DROP FOREIGN KEY FK_2055034F8D566613');
        $this->addSql('DROP INDEX IDX_2055034F8D566613 ON patient_account');
        $this->addSql('ALTER TABLE patient_account DROP connexion_id');
        $this->addSql('ALTER TABLE connexion CHANGE secretary_id secretary_id INT DEFAULT NULL');
    }
}
