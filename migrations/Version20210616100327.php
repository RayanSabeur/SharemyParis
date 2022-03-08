<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210616100327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('ALTER TABLE activites ADD user_id INT DEFAULT NULL');
        // $this->addSql('ALTER TABLE activites ADD CONSTRAINT FK_766B5EB5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        // $this->addSql('CREATE INDEX IDX_766B5EB5A76ED395 ON activites (user_id)');
        // $this->addSql('ALTER TABLE user CHANGE description description VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE images');
        $this->addSql('ALTER TABLE activites DROP FOREIGN KEY FK_766B5EB5A76ED395');
        $this->addSql('DROP INDEX IDX_766B5EB5A76ED395 ON activites');
        $this->addSql('ALTER TABLE activites DROP user_id');
        $this->addSql('ALTER TABLE user CHANGE description description VARCHAR(1000) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
