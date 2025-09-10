<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250909152459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634365BF48');
        $this->addSql('DROP INDEX IDX_497DD634365BF48 ON categorie');
        $this->addSql('ALTER TABLE categorie DROP sous_categorie_id');
        $this->addSql('ALTER TABLE sous_categorie DROP FOREIGN KEY FK_52743D7BA21214B7');
        $this->addSql('DROP INDEX IDX_52743D7BA21214B7 ON sous_categorie');
        $this->addSql('ALTER TABLE sous_categorie CHANGE categories_id categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE sous_categorie ADD CONSTRAINT FK_52743D7BBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_52743D7BBCF5E72D ON sous_categorie (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie ADD sous_categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634365BF48 FOREIGN KEY (sous_categorie_id) REFERENCES sous_categorie (id)');
        $this->addSql('CREATE INDEX IDX_497DD634365BF48 ON categorie (sous_categorie_id)');
        $this->addSql('ALTER TABLE sous_categorie DROP FOREIGN KEY FK_52743D7BBCF5E72D');
        $this->addSql('DROP INDEX IDX_52743D7BBCF5E72D ON sous_categorie');
        $this->addSql('ALTER TABLE sous_categorie CHANGE categorie_id categories_id INT NOT NULL');
        $this->addSql('ALTER TABLE sous_categorie ADD CONSTRAINT FK_52743D7BA21214B7 FOREIGN KEY (categories_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_52743D7BA21214B7 ON sous_categorie (categories_id)');
    }
}
