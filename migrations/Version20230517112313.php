<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230517112313 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE concert_festival DROP FOREIGN KEY FK_3A53EBE883C97B2E');
        $this->addSql('ALTER TABLE concert_festival DROP FOREIGN KEY FK_3A53EBE88AEBAF57');
        $this->addSql('DROP TABLE concert_festival');
        $this->addSql('ALTER TABLE concert ADD scene_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE concert ADD CONSTRAINT FK_D57C02D2166053B4 FOREIGN KEY (scene_id) REFERENCES scene (id)');
        $this->addSql('CREATE INDEX IDX_D57C02D2166053B4 ON concert (scene_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE concert_festival (concert_id INT NOT NULL, festival_id INT NOT NULL, INDEX IDX_3A53EBE88AEBAF57 (festival_id), INDEX IDX_3A53EBE883C97B2E (concert_id), PRIMARY KEY(concert_id, festival_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE concert_festival ADD CONSTRAINT FK_3A53EBE883C97B2E FOREIGN KEY (concert_id) REFERENCES concert (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE concert_festival ADD CONSTRAINT FK_3A53EBE88AEBAF57 FOREIGN KEY (festival_id) REFERENCES festival (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE concert DROP FOREIGN KEY FK_D57C02D2166053B4');
        $this->addSql('DROP INDEX IDX_D57C02D2166053B4 ON concert');
        $this->addSql('ALTER TABLE concert DROP scene_id');
    }
}
