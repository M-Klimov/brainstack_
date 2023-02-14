<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230214102222 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql('create table banner_hit
                            (
                                id         serial
                                    primary key,
                                identifier varchar(32)  not null,
                                ip         inet         not null,
                                user_agent varchar(512) not null,
                                created_at timestamp    not null,
                                updated_at timestamp    not null
                            );');

        $this->addSql('create unique index banner_hit_identifier_uindex
                                on banner_hit (identifier);');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('drop table banner_hit;');
    }
}
