<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230516121531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE concert DROP FOREIGN KEY FK_D57C02D2FFC8D535');
        $this->addSql('DROP INDEX IDX_D57C02D2FFC8D535 ON concert');
        $this->addSql('ALTER TABLE concert CHANGE performer_id_id performer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE concert ADD CONSTRAINT FK_D57C02D26C6B33F3 FOREIGN KEY (performer_id) REFERENCES festival (id)');
        $this->addSql('CREATE INDEX IDX_D57C02D26C6B33F3 ON concert (performer_id)');
        $this->addSql('ALTER TABLE faq DROP FOREIGN KEY FK_E8FF75CC11F56659');
        $this->addSql('DROP INDEX IDX_E8FF75CC11F56659 ON faq');
        $this->addSql('ALTER TABLE faq CHANGE festival_id_id festival_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE faq ADD CONSTRAINT FK_E8FF75CC8AEBAF57 FOREIGN KEY (festival_id) REFERENCES festival (id)');
        $this->addSql('CREATE INDEX IDX_E8FF75CC8AEBAF57 ON faq (festival_id)');
        $this->addSql('ALTER TABLE scene DROP FOREIGN KEY FK_D979EFDA11F56659');
        $this->addSql('DROP INDEX IDX_D979EFDA11F56659 ON scene');
        $this->addSql('ALTER TABLE scene CHANGE festival_id_id festival_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE scene ADD CONSTRAINT FK_D979EFDA8AEBAF57 FOREIGN KEY (festival_id) REFERENCES festival (id)');
        $this->addSql('CREATE INDEX IDX_D979EFDA8AEBAF57 ON scene (festival_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE scene DROP FOREIGN KEY FK_D979EFDA8AEBAF57');
        $this->addSql('DROP INDEX IDX_D979EFDA8AEBAF57 ON scene');
        $this->addSql('ALTER TABLE scene CHANGE festival_id festival_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE scene ADD CONSTRAINT FK_D979EFDA11F56659 FOREIGN KEY (festival_id_id) REFERENCES festival (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D979EFDA11F56659 ON scene (festival_id_id)');
        $this->addSql('ALTER TABLE concert DROP FOREIGN KEY FK_D57C02D26C6B33F3');
        $this->addSql('DROP INDEX IDX_D57C02D26C6B33F3 ON concert');
        $this->addSql('ALTER TABLE concert CHANGE performer_id performer_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE concert ADD CONSTRAINT FK_D57C02D2FFC8D535 FOREIGN KEY (performer_id_id) REFERENCES festival (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D57C02D2FFC8D535 ON concert (performer_id_id)');
        $this->addSql('ALTER TABLE faq DROP FOREIGN KEY FK_E8FF75CC8AEBAF57');
        $this->addSql('DROP INDEX IDX_E8FF75CC8AEBAF57 ON faq');
        $this->addSql('ALTER TABLE faq CHANGE festival_id festival_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE faq ADD CONSTRAINT FK_E8FF75CC11F56659 FOREIGN KEY (festival_id_id) REFERENCES festival (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E8FF75CC11F56659 ON faq (festival_id_id)');
    }
}
