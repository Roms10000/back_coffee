<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250910095350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE archive (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, INDEX IDX_D5FC5D9CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE archive_produit (archive_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_44850DD82956195F (archive_id), INDEX IDX_44850DD8F347EFB (produit_id), PRIMARY KEY(archive_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE boisson (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(100) NOT NULL, note INT NOT NULL, INDEX IDX_8B97C84DBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favoris (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, boisson_id INT NOT NULL, INDEX IDX_8933C432A76ED395 (user_id), INDEX IDX_8933C432734B8089 (boisson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, image VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, price NUMERIC(8, 2) NOT NULL, intensity INT DEFAULT NULL, origin VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_boisson (produit_id INT NOT NULL, boisson_id INT NOT NULL, INDEX IDX_4D6C4334F347EFB (produit_id), INDEX IDX_4D6C4334734B8089 (boisson_id), PRIMARY KEY(produit_id, boisson_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_recette (produit_id INT NOT NULL, recette_id INT NOT NULL, INDEX IDX_8F40E8E9F347EFB (produit_id), INDEX IDX_8F40E8E989312FE9 (recette_id), PRIMARY KEY(produit_id, recette_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette (id INT AUTO_INCREMENT NOT NULL, boisson_id INT NOT NULL, etape VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_49BB6390734B8089 (boisson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(100) NOT NULL, first_name VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE archive ADD CONSTRAINT FK_D5FC5D9CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE archive_produit ADD CONSTRAINT FK_44850DD82956195F FOREIGN KEY (archive_id) REFERENCES archive (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE archive_produit ADD CONSTRAINT FK_44850DD8F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE boisson ADD CONSTRAINT FK_8B97C84DBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C432A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C432734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id)');
        $this->addSql('ALTER TABLE produit_boisson ADD CONSTRAINT FK_4D6C4334F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_boisson ADD CONSTRAINT FK_4D6C4334734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_recette ADD CONSTRAINT FK_8F40E8E9F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_recette ADD CONSTRAINT FK_8F40E8E989312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE archive DROP FOREIGN KEY FK_D5FC5D9CA76ED395');
        $this->addSql('ALTER TABLE archive_produit DROP FOREIGN KEY FK_44850DD82956195F');
        $this->addSql('ALTER TABLE archive_produit DROP FOREIGN KEY FK_44850DD8F347EFB');
        $this->addSql('ALTER TABLE boisson DROP FOREIGN KEY FK_8B97C84DBCF5E72D');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C432A76ED395');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C432734B8089');
        $this->addSql('ALTER TABLE produit_boisson DROP FOREIGN KEY FK_4D6C4334F347EFB');
        $this->addSql('ALTER TABLE produit_boisson DROP FOREIGN KEY FK_4D6C4334734B8089');
        $this->addSql('ALTER TABLE produit_recette DROP FOREIGN KEY FK_8F40E8E9F347EFB');
        $this->addSql('ALTER TABLE produit_recette DROP FOREIGN KEY FK_8F40E8E989312FE9');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB6390734B8089');
        $this->addSql('DROP TABLE archive');
        $this->addSql('DROP TABLE archive_produit');
        $this->addSql('DROP TABLE boisson');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE favoris');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_boisson');
        $this->addSql('DROP TABLE produit_recette');
        $this->addSql('DROP TABLE recette');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
