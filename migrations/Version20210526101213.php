<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210526101213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE navigation_page DROP FOREIGN KEY FK_238A635239F79D6D');
        $this->addSql('ALTER TABLE navigation_page DROP FOREIGN KEY FK_238A6352C4663E4');
        $this->addSql('ALTER TABLE navigation_page ADD id INT AUTO_INCREMENT NOT NULL, ADD position INT NOT NULL, CHANGE navigation_id navigation_id INT DEFAULT NULL, CHANGE page_id page_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE navigation_page ADD CONSTRAINT FK_238A635239F79D6D FOREIGN KEY (navigation_id) REFERENCES navigation (id)');
        $this->addSql('ALTER TABLE navigation_page ADD CONSTRAINT FK_238A6352C4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE navigation_page MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE navigation_page DROP FOREIGN KEY FK_238A635239F79D6D');
        $this->addSql('ALTER TABLE navigation_page DROP FOREIGN KEY FK_238A6352C4663E4');
        $this->addSql('ALTER TABLE navigation_page DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE navigation_page DROP id, DROP position, CHANGE navigation_id navigation_id INT NOT NULL, CHANGE page_id page_id INT NOT NULL');
        $this->addSql('ALTER TABLE navigation_page ADD CONSTRAINT FK_238A635239F79D6D FOREIGN KEY (navigation_id) REFERENCES navigation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE navigation_page ADD CONSTRAINT FK_238A6352C4663E4 FOREIGN KEY (page_id) REFERENCES page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE navigation_page ADD PRIMARY KEY (navigation_id, page_id)');
    }
}
