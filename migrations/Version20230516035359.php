<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230516035359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE monthly_payment ADD createdy_by_id INT NOT NULL, ADD total_payment DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE monthly_payment ADD CONSTRAINT FK_617D3FA68F1EFF91 FOREIGN KEY (createdy_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_617D3FA68F1EFF91 ON monthly_payment (createdy_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE monthly_payment DROP FOREIGN KEY FK_617D3FA68F1EFF91');
        $this->addSql('DROP INDEX IDX_617D3FA68F1EFF91 ON monthly_payment');
        $this->addSql('ALTER TABLE monthly_payment DROP createdy_by_id, DROP total_payment');
    }
}
