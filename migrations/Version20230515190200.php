<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230515190200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role ADD daily_base_salary DOUBLE PRECISION NOT NULL, ADD work_day_duration INT NOT NULL, ADD work_days_per_week INT NOT NULL, ADD food_allowance_percentage INT NOT NULL, ADD isr_tax_retention INT NOT NULL, ADD monthly_base_salary DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role DROP daily_base_salary, DROP work_day_duration, DROP work_days_per_week, DROP food_allowance_percentage, DROP isr_tax_retention, DROP monthly_base_salary');
    }
}
