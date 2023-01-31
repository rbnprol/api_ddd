<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230131122637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auth (id INT NOT NULL, api_token VARCHAR(255) NOT NULL, project INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, project_id INT NOT NULL, category VARCHAR(255) NOT NULL, `group` VARCHAR(255) NOT NULL, brand VARCHAR(255) NOT NULL, product VARCHAR(255) NOT NULL, ean VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, capacity DOUBLE PRECISION NOT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shop (id INT NOT NULL, project_id INT NOT NULL, shop_type VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, autonomy VARCHAR(255) NOT NULL, province VARCHAR(255) NOT NULL, population VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visit (id INT NOT NULL, project_id INT NOT NULL, shop_id INT NOT NULL, shop VARCHAR(255) NOT NULL, employee VARCHAR(255) NOT NULL, date DATE NOT NULL, comments VARCHAR(255) NOT NULL, time_start VARCHAR(255) NOT NULL, time_end VARCHAR(255) NOT NULL, is_complete TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE auth');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE shop');
        $this->addSql('DROP TABLE visit');
    }
}
