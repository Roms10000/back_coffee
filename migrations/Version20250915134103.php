<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250915134103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE boisson_produit (boisson_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_D6D2ACF2734B8089 (boisson_id), INDEX IDX_D6D2ACF2F347EFB (produit_id), PRIMARY KEY(boisson_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE boisson_produit ADD CONSTRAINT FK_D6D2ACF2734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE boisson_produit ADD CONSTRAINT FK_D6D2ACF2F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_boisson DROP FOREIGN KEY FK_4D6C4334734B8089');
        $this->addSql('ALTER TABLE produit_boisson DROP FOREIGN KEY FK_4D6C4334F347EFB');
        $this->addSql('DROP TABLE produit_boisson');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produit_boisson (produit_id INT NOT NULL, boisson_id INT NOT NULL, INDEX IDX_4D6C4334734B8089 (boisson_id), INDEX IDX_4D6C4334F347EFB (produit_id), PRIMARY KEY(produit_id, boisson_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE produit_boisson ADD CONSTRAINT FK_4D6C4334734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_boisson ADD CONSTRAINT FK_4D6C4334F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE boisson_produit DROP FOREIGN KEY FK_D6D2ACF2734B8089');
        $this->addSql('ALTER TABLE boisson_produit DROP FOREIGN KEY FK_D6D2ACF2F347EFB');
        $this->addSql('DROP TABLE boisson_produit');
    }
}
