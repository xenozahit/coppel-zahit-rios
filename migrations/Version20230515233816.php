<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230515233816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE monthly_payment (id INT AUTO_INCREMENT NOT NULL, month INT NOT NULL, year INT NOT NULL, base_salary DOUBLE PRECISION NOT NULL, hourly_bond_quanity INT NOT NULL, hourly_bond_money DOUBLE PRECISION NOT NULL, delivery_bond_quantity INT NOT NULL, delivery_bond_money DOUBLE PRECISION NOT NULL, isr_tax_retention_percentage INT NOT NULL, isr_tax_retention_money DOUBLE PRECISION NOT NULL, food_allowance_percentage INT NOT NULL, food_allowance_money DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE monthly_payment');
    }
}
