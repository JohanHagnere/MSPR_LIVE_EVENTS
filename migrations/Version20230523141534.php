<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523141534 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE concert DROP FOREIGN KEY FK_D57C02D26C6B33F3');
        $this->addSql('ALTER TABLE concert ADD CONSTRAINT FK_D57C02D26C6B33F3 FOREIGN KEY (performer_id) REFERENCES performer (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE concert DROP FOREIGN KEY FK_D57C02D26C6B33F3');
        $this->addSql('ALTER TABLE concert ADD CONSTRAINT FK_D57C02D26C6B33F3 FOREIGN KEY (performer_id) REFERENCES festival (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
