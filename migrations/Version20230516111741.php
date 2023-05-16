<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230516111741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facility DROP FOREIGN KEY FK_105994B211F56659');
        $this->addSql('DROP INDEX IDX_105994B211F56659 ON facility');
        $this->addSql('ALTER TABLE facility CHANGE festival_id_id festival_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facility ADD CONSTRAINT FK_105994B28AEBAF57 FOREIGN KEY (festival_id) REFERENCES festival (id)');
        $this->addSql('CREATE INDEX IDX_105994B28AEBAF57 ON facility (festival_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facility DROP FOREIGN KEY FK_105994B28AEBAF57');
        $this->addSql('DROP INDEX IDX_105994B28AEBAF57 ON facility');
        $this->addSql('ALTER TABLE facility CHANGE festival_id festival_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facility ADD CONSTRAINT FK_105994B211F56659 FOREIGN KEY (festival_id_id) REFERENCES festival (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_105994B211F56659 ON facility (festival_id_id)');
    }
}
