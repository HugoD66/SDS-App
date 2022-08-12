<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220812163710 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE permission (id INT AUTO_INCREMENT NOT NULL, branch_id_id INT DEFAULT NULL, send_newsletter TINYINT(1) NOT NULL, sell_drink TINYINT(1) NOT NULL, payment_stats TINYINT(1) NOT NULL, add_members TINYINT(1) NOT NULL, recrut_employee TINYINT(1) NOT NULL, activated_website TINYINT(1) NOT NULL, place_search TINYINT(1) NOT NULL, restaurant_site TINYINT(1) NOT NULL, renovation TINYINT(1) NOT NULL, available_coach TINYINT(1) NOT NULL, street VARCHAR(255) NOT NULL, INDEX IDX_E04992AA11F59C00 (branch_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE permission ADD CONSTRAINT FK_E04992AA11F59C00 FOREIGN KEY (branch_id_id) REFERENCES structure (id)');
        $this->addSql('ALTER TABLE structure ADD city VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE permission');
        $this->addSql('ALTER TABLE structure DROP city');
    }
}
