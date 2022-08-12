<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220807151218 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE partenaire (id INT AUTO_INCREMENT NOT NULL, client_name VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, short_description VARCHAR(255) NOT NULL, full_description LONGTEXT NOT NULL, logo VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, dpo VARCHAR(255) NOT NULL, technical_contact VARCHAR(255) NOT NULL, commercial_contact VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_32FFA3738FBFBD64 (client_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE partenaire');
    }
}
