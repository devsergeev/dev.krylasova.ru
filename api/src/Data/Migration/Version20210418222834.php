<?php

declare(strict_types=1);

namespace App\Data\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210418222834 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auth_user_networks (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_id CHAR(36) NOT NULL COMMENT \'(DC2Type:auth_user_id)\', network_name VARCHAR(16) NOT NULL, network_identity VARCHAR(16) NOT NULL, INDEX IDX_3EA78C3BA76ED395 (user_id), UNIQUE INDEX UNIQ_3EA78C3B257EBD71C756D255 (network_name, network_identity), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auth_users (id CHAR(36) NOT NULL COMMENT \'(DC2Type:auth_user_id)\', date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', email VARCHAR(255) NOT NULL COMMENT \'(DC2Type:auth_user_email)\', password_hash VARCHAR(255) DEFAULT NULL, status VARCHAR(16) NOT NULL COMMENT \'(DC2Type:auth_user_status)\', new_email VARCHAR(255) DEFAULT NULL COMMENT \'(DC2Type:auth_user_email)\', role VARCHAR(16) NOT NULL COMMENT \'(DC2Type:auth_user_role)\', join_confirm_token_value VARCHAR(255) DEFAULT NULL, join_confirm_token_expires DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', password_reset_token_value VARCHAR(255) DEFAULT NULL, password_reset_token_expires DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', new_email_token_value VARCHAR(255) DEFAULT NULL, new_email_token_expires DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_D8A1F49CE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE auth_user_networks ADD CONSTRAINT FK_3EA78C3BA76ED395 FOREIGN KEY (user_id) REFERENCES auth_users (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auth_user_networks DROP FOREIGN KEY FK_3EA78C3BA76ED395');
        $this->addSql('DROP TABLE auth_user_networks');
        $this->addSql('DROP TABLE auth_users');
    }
}
