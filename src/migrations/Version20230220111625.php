<?php

declare(strict_types=1);

namespace database\migrations;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Psr\Log\LoggerInterface;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230220111625 extends AbstractMigration
{
    public function __construct(Connection $connection, LoggerInterface $logger)
    {
        parent::__construct($connection, $logger);

        $this->platform->registerDoctrineTypeMapping('enum', 'string');
    }

    public function getDescription(): string
    {
        return config('plugin.brooke1220.webman-like.app.likes_table');
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable(config('plugin.brooke1220.webman-like.app.likes_table'));

        $table->addColumn('id', 'bigint')->setAutoincrement(true);
        $table->addColumn(config('plugin.brooke1220.webman-like.app.user_foreign_key'), 'bigint')->setUnsigned(true)->setComment('user_id');
        $table->addColumn('likeable_id', 'bigint')->setUnsigned(true);
        $table->addColumn('likeable_type', 'string');
        $table->addColumn('created_at', 'datetime')->setNotnull(true)->setComment('创建时间');
        $table->addColumn('updated_at', 'datetime')->setNotnull(true)->setComment('最后修改时间');

        $table->setPrimaryKey(['id']);
        $table->addIndex([config('plugin.brooke1220.webman-like.app.user_foreign_key')]);
        $table->addIndex(['likeable_type']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(config('plugin.brooke1220.webman-like.app.likes_table'));
    }
}
