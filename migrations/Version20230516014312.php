<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230516014312 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE monthly_payment ADD employee_id INT NOT NULL');
        $this->addSql('ALTER TABLE monthly_payment ADD CONSTRAINT FK_617D3FA68C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id)');
        $this->addSql('CREATE INDEX IDX_617D3FA68C03F15C ON monthly_payment (employee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE monthly_payment DROP FOREIGN KEY FK_617D3FA68C03F15C');
        $this->addSql('DROP INDEX IDX_617D3FA68C03F15C ON monthly_payment');
        $this->addSql('ALTER TABLE monthly_payment DROP employee_id');
    }
}
