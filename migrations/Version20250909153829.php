<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250909153829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sous_categorie DROP FOREIGN KEY FK_52743D7BBCF5E72D');
        $this->addSql('ALTER TABLE sous_categorie_produit DROP FOREIGN KEY FK_B7039772365BF48');
        $this->addSql('ALTER TABLE sous_categorie_produit DROP FOREIGN KEY FK_B7039772F347EFB');
        $this->addSql('DROP TABLE sous_categorie');
        $this->addSql('DROP TABLE sous_categorie_produit');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sous_categorie (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, type VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_52743D7BBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sous_categorie_produit (sous_categorie_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_B7039772365BF48 (sous_categorie_id), INDEX IDX_B7039772F347EFB (produit_id), PRIMARY KEY(sous_categorie_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE sous_categorie ADD CONSTRAINT FK_52743D7BBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE sous_categorie_produit ADD CONSTRAINT FK_B7039772365BF48 FOREIGN KEY (sous_categorie_id) REFERENCES sous_categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sous_categorie_produit ADD CONSTRAINT FK_B7039772F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
    }
}
