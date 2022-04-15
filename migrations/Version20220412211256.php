<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220412211256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coordinates (id INT AUTO_INCREMENT NOT NULL, latitude VARCHAR(255) NOT NULL, longitude VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dob (id INT AUTO_INCREMENT NOT NULL, date DATETIME DEFAULT NULL, age INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE id (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, coordinates_id INT DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, state VARCHAR(255) DEFAULT NULL, postcode INT DEFAULT NULL, INDEX IDX_5E9E89CB158B0682 (coordinates_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE login (id INT AUTO_INCREMENT NOT NULL, uuid VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, salt VARCHAR(255) NOT NULL, md5 VARCHAR(255) DEFAULT NULL, sha1 VARCHAR(255) NOT NULL, sha256 VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE name (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, first VARCHAR(255) DEFAULT NULL, last VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, large VARCHAR(255) NOT NULL, medium VARCHAR(255) DEFAULT NULL, thumbnail VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE registered (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, age INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE timezone (id INT AUTO_INCREMENT NOT NULL, offset VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (iid INT AUTO_INCREMENT NOT NULL, name_id INT DEFAULT NULL, location_id INT DEFAULT NULL, login_id INT DEFAULT NULL, dob_id INT DEFAULT NULL, registered_id INT DEFAULT NULL, picture_id INT DEFAULT NULL, id_id INT DEFAULT NULL, gender VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) NOT NULL, cell VARCHAR(255) NOT NULL, nat VARCHAR(100) NOT NULL, INDEX IDX_8D93D64971179CD6 (name_id), INDEX IDX_8D93D64964D218E (location_id), INDEX IDX_8D93D6495CB2E05D (login_id), INDEX IDX_8D93D64931EA2FD9 (dob_id), INDEX IDX_8D93D64933F613ED (registered_id), INDEX IDX_8D93D649EE45BDBF (picture_id), INDEX IDX_8D93D6497F449E57 (id_id), PRIMARY KEY(iid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB158B0682 FOREIGN KEY (coordinates_id) REFERENCES coordinates (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64971179CD6 FOREIGN KEY (name_id) REFERENCES name (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64964D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6495CB2E05D FOREIGN KEY (login_id) REFERENCES login (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64931EA2FD9 FOREIGN KEY (dob_id) REFERENCES dob (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64933F613ED FOREIGN KEY (registered_id) REFERENCES registered (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649EE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6497F449E57 FOREIGN KEY (id_id) REFERENCES id (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB158B0682');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64931EA2FD9');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6497F449E57');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64964D218E');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6495CB2E05D');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64971179CD6');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649EE45BDBF');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64933F613ED');
        $this->addSql('DROP TABLE coordinates');
        $this->addSql('DROP TABLE dob');
        $this->addSql('DROP TABLE id');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE login');
        $this->addSql('DROP TABLE name');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE registered');
        $this->addSql('DROP TABLE timezone');
        $this->addSql('DROP TABLE user');
    }
}
