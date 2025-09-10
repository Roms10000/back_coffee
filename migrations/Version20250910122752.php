<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250910122752 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE intensity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE boisson ADD type_id INT DEFAULT NULL, ADD intensity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE boisson ADD CONSTRAINT FK_8B97C84DC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE boisson ADD CONSTRAINT FK_8B97C84D91A55F57 FOREIGN KEY (intensity_id) REFERENCES intensity (id)');
        $this->addSql('CREATE INDEX IDX_8B97C84DC54C8C93 ON boisson (type_id)');
        $this->addSql('CREATE INDEX IDX_8B97C84D91A55F57 ON boisson (intensity_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boisson DROP FOREIGN KEY FK_8B97C84D91A55F57');
        $this->addSql('ALTER TABLE boisson DROP FOREIGN KEY FK_8B97C84DC54C8C93');
        $this->addSql('DROP TABLE intensity');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP INDEX IDX_8B97C84DC54C8C93 ON boisson');
        $this->addSql('DROP INDEX IDX_8B97C84D91A55F57 ON boisson');
        $this->addSql('ALTER TABLE boisson DROP type_id, DROP intensity_id');
    }
}
