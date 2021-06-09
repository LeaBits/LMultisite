<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210608143935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blog_category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog_post (id INT AUTO_INCREMENT NOT NULL, blog_category_id INT DEFAULT NULL, template_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_BA5AE01DCB76011C (blog_category_id), INDEX IDX_BA5AE01D5DA0FB8 (template_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog_post_block (id INT AUTO_INCREMENT NOT NULL, blog_post_id INT DEFAULT NULL, template_block_id INT DEFAULT NULL, content LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_F2C63924A77FBEAF (blog_post_id), INDEX IDX_F2C63924B6BBB27F (template_block_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog_tag (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog_tag_blog_post (blog_tag_id INT NOT NULL, blog_post_id INT NOT NULL, INDEX IDX_D8EB10562F9DC6D0 (blog_tag_id), INDEX IDX_D8EB1056A77FBEAF (blog_post_id), PRIMARY KEY(blog_tag_id, blog_post_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE navigation (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE navigation_page (id INT AUTO_INCREMENT NOT NULL, navigation_id INT DEFAULT NULL, page_id INT DEFAULT NULL, position INT NOT NULL, INDEX IDX_238A635239F79D6D (navigation_id), INDEX IDX_238A6352C4663E4 (page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, site_id INT DEFAULT NULL, template_id INT DEFAULT NULL, template_block_id INT DEFAULT NULL, content LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_140AB620F6BD1646 (site_id), INDEX IDX_140AB6205DA0FB8 (template_id), INDEX IDX_140AB620B6BBB27F (template_block_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_block (id INT AUTO_INCREMENT NOT NULL, page_id INT DEFAULT NULL, template_block_id INT DEFAULT NULL, content LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_E59A68F4C4663E4 (page_id), INDEX IDX_E59A68F4B6BBB27F (template_block_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, color VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site_hostname (id INT AUTO_INCREMENT NOT NULL, site_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_E91C7FCBF6BD1646 (site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE template (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE template_block (id INT AUTO_INCREMENT NOT NULL, template_id INT DEFAULT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_B0CD44ED5DA0FB8 (template_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blog_post ADD CONSTRAINT FK_BA5AE01DCB76011C FOREIGN KEY (blog_category_id) REFERENCES blog_category (id)');
        $this->addSql('ALTER TABLE blog_post ADD CONSTRAINT FK_BA5AE01D5DA0FB8 FOREIGN KEY (template_id) REFERENCES template (id)');
        $this->addSql('ALTER TABLE blog_post_block ADD CONSTRAINT FK_F2C63924A77FBEAF FOREIGN KEY (blog_post_id) REFERENCES blog_post (id)');
        $this->addSql('ALTER TABLE blog_post_block ADD CONSTRAINT FK_F2C63924B6BBB27F FOREIGN KEY (template_block_id) REFERENCES template_block (id)');
        $this->addSql('ALTER TABLE blog_tag_blog_post ADD CONSTRAINT FK_D8EB10562F9DC6D0 FOREIGN KEY (blog_tag_id) REFERENCES blog_tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE blog_tag_blog_post ADD CONSTRAINT FK_D8EB1056A77FBEAF FOREIGN KEY (blog_post_id) REFERENCES blog_post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE navigation_page ADD CONSTRAINT FK_238A635239F79D6D FOREIGN KEY (navigation_id) REFERENCES navigation (id)');
        $this->addSql('ALTER TABLE navigation_page ADD CONSTRAINT FK_238A6352C4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB620F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB6205DA0FB8 FOREIGN KEY (template_id) REFERENCES template (id)');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB620B6BBB27F FOREIGN KEY (template_block_id) REFERENCES template_block (id)');
        $this->addSql('ALTER TABLE page_block ADD CONSTRAINT FK_E59A68F4C4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
        $this->addSql('ALTER TABLE page_block ADD CONSTRAINT FK_E59A68F4B6BBB27F FOREIGN KEY (template_block_id) REFERENCES template_block (id)');
        $this->addSql('ALTER TABLE site_hostname ADD CONSTRAINT FK_E91C7FCBF6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE template_block ADD CONSTRAINT FK_B0CD44ED5DA0FB8 FOREIGN KEY (template_id) REFERENCES template (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog_post DROP FOREIGN KEY FK_BA5AE01DCB76011C');
        $this->addSql('ALTER TABLE blog_post_block DROP FOREIGN KEY FK_F2C63924A77FBEAF');
        $this->addSql('ALTER TABLE blog_tag_blog_post DROP FOREIGN KEY FK_D8EB1056A77FBEAF');
        $this->addSql('ALTER TABLE blog_tag_blog_post DROP FOREIGN KEY FK_D8EB10562F9DC6D0');
        $this->addSql('ALTER TABLE navigation_page DROP FOREIGN KEY FK_238A635239F79D6D');
        $this->addSql('ALTER TABLE navigation_page DROP FOREIGN KEY FK_238A6352C4663E4');
        $this->addSql('ALTER TABLE page_block DROP FOREIGN KEY FK_E59A68F4C4663E4');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB620F6BD1646');
        $this->addSql('ALTER TABLE site_hostname DROP FOREIGN KEY FK_E91C7FCBF6BD1646');
        $this->addSql('ALTER TABLE blog_post DROP FOREIGN KEY FK_BA5AE01D5DA0FB8');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB6205DA0FB8');
        $this->addSql('ALTER TABLE template_block DROP FOREIGN KEY FK_B0CD44ED5DA0FB8');
        $this->addSql('ALTER TABLE blog_post_block DROP FOREIGN KEY FK_F2C63924B6BBB27F');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB620B6BBB27F');
        $this->addSql('ALTER TABLE page_block DROP FOREIGN KEY FK_E59A68F4B6BBB27F');
        $this->addSql('DROP TABLE blog_category');
        $this->addSql('DROP TABLE blog_post');
        $this->addSql('DROP TABLE blog_post_block');
        $this->addSql('DROP TABLE blog_tag');
        $this->addSql('DROP TABLE blog_tag_blog_post');
        $this->addSql('DROP TABLE navigation');
        $this->addSql('DROP TABLE navigation_page');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE page_block');
        $this->addSql('DROP TABLE site');
        $this->addSql('DROP TABLE site_hostname');
        $this->addSql('DROP TABLE template');
        $this->addSql('DROP TABLE template_block');
        $this->addSql('DROP TABLE user');
    }
}
