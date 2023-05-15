<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230515121855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE concert (id INT AUTO_INCREMENT NOT NULL, performer_id_id INT DEFAULT NULL, concert_date DATETIME NOT NULL, INDEX IDX_D57C02D2FFC8D535 (performer_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE concert_festival (concert_id INT NOT NULL, festival_id INT NOT NULL, INDEX IDX_3A53EBE883C97B2E (concert_id), INDEX IDX_3A53EBE88AEBAF57 (festival_id), PRIMARY KEY(concert_id, festival_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facility (id INT AUTO_INCREMENT NOT NULL, festival_id_id INT DEFAULT NULL, category VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, longitude VARCHAR(255) NOT NULL, latitude VARCHAR(255) NOT NULL, INDEX IDX_105994B211F56659 (festival_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE festival (id INT AUTO_INCREMENT NOT NULL, message_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, begin_date DATE NOT NULL, end_date DATE NOT NULL, INDEX IDX_57CF789537A1329 (message_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, type VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE performer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE scene (id INT AUTO_INCREMENT NOT NULL, festival_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, longitude VARCHAR(255) NOT NULL, latitude VARCHAR(255) NOT NULL, INDEX IDX_D979EFDA11F56659 (festival_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE concert ADD CONSTRAINT FK_D57C02D2FFC8D535 FOREIGN KEY (performer_id_id) REFERENCES festival (id)');
        $this->addSql('ALTER TABLE concert_festival ADD CONSTRAINT FK_3A53EBE883C97B2E FOREIGN KEY (concert_id) REFERENCES concert (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE concert_festival ADD CONSTRAINT FK_3A53EBE88AEBAF57 FOREIGN KEY (festival_id) REFERENCES festival (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE facility ADD CONSTRAINT FK_105994B211F56659 FOREIGN KEY (festival_id_id) REFERENCES festival (id)');
        $this->addSql('ALTER TABLE festival ADD CONSTRAINT FK_57CF789537A1329 FOREIGN KEY (message_id) REFERENCES message (id)');
        $this->addSql('ALTER TABLE scene ADD CONSTRAINT FK_D979EFDA11F56659 FOREIGN KEY (festival_id_id) REFERENCES festival (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE concert DROP FOREIGN KEY FK_D57C02D2FFC8D535');
        $this->addSql('ALTER TABLE concert_festival DROP FOREIGN KEY FK_3A53EBE883C97B2E');
        $this->addSql('ALTER TABLE concert_festival DROP FOREIGN KEY FK_3A53EBE88AEBAF57');
        $this->addSql('ALTER TABLE facility DROP FOREIGN KEY FK_105994B211F56659');
        $this->addSql('ALTER TABLE festival DROP FOREIGN KEY FK_57CF789537A1329');
        $this->addSql('ALTER TABLE scene DROP FOREIGN KEY FK_D979EFDA11F56659');
        $this->addSql('DROP TABLE concert');
        $this->addSql('DROP TABLE concert_festival');
        $this->addSql('DROP TABLE facility');
        $this->addSql('DROP TABLE festival');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE performer');
        $this->addSql('DROP TABLE scene');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
