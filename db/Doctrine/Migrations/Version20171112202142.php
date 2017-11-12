<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171112202142 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('CREATE TABLE Tank (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(250) NOT NULL, description VARCHAR(1000) DEFAULT NULL, volume_capacity NUMERIC(10, 0) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE GreenHouse ADD description VARCHAR(1000) DEFAULT NULL');
        $this->addSql('ALTER TABLE System ADD description VARCHAR(1000) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('DROP TABLE Tank');
        $this->addSql('ALTER TABLE GreenHouse DROP description');
        $this->addSql('ALTER TABLE System DROP description');
    }
}
