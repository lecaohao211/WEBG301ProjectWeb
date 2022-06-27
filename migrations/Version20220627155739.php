<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220627155739 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE food DROP FOREIGN KEY FK_D43829F79777D11E');
        $this->addSql('DROP INDEX IDX_D43829F79777D11E ON food');
        $this->addSql('ALTER TABLE food ADD category_id INT DEFAULT NULL, DROP category_id_id, CHANGE chef_id_id chef_id_id INT DEFAULT NULL, CHANGE price price INT NOT NULL');
        $this->addSql('ALTER TABLE food ADD CONSTRAINT FK_D43829F712469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_D43829F712469DE2 ON food (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE food DROP FOREIGN KEY FK_D43829F712469DE2');
        $this->addSql('DROP INDEX IDX_D43829F712469DE2 ON food');
        $this->addSql('ALTER TABLE food ADD category_id_id INT NOT NULL, DROP category_id, CHANGE chef_id_id chef_id_id INT NOT NULL, CHANGE price price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE food ADD CONSTRAINT FK_D43829F79777D11E FOREIGN KEY (category_id_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_D43829F79777D11E ON food (category_id_id)');
    }
}
