<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210624140708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activites_categorie (activites_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_D497F44C5B8C31B7 (activites_id), INDEX IDX_D497F44CBCF5E72D (categorie_id), PRIMARY KEY(activites_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activites_categorie ADD CONSTRAINT FK_D497F44C5B8C31B7 FOREIGN KEY (activites_id) REFERENCES activites (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activites_categorie ADD CONSTRAINT FK_D497F44CBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD6345B8C31B7');
        $this->addSql('DROP INDEX IDX_497DD6345B8C31B7 ON categorie');
        $this->addSql('ALTER TABLE categorie DROP activites_id');
        $this->addSql('ALTER TABLE user CHANGE description description VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE activites_categorie');
        $this->addSql('ALTER TABLE categorie ADD activites_id INT NOT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD6345B8C31B7 FOREIGN KEY (activites_id) REFERENCES activites (id)');
        $this->addSql('CREATE INDEX IDX_497DD6345B8C31B7 ON categorie (activites_id)');
        $this->addSql('ALTER TABLE user CHANGE description description VARCHAR(1000) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
