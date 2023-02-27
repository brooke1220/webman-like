<?php
return [
    'enable' => true,

    /**
     *  Database Connection
     */
    'database_connection' => 'mysql',

    /**
     * Use uuid as primary key.
     */
    'uuids' => false,

    /*
     * User tables foreign key name.
     */
    'user_foreign_key' => 'user_id',

    /*
     * Table name for likes records.
     */
    'likes_table' => 'likes',

    /*
     * Model name for like record.
     */
    'like_model' => \Brooke1220\WebmanLike\Like::class,

    /**
     * Model name for user
     */
    'user_model' => \plugin\yuxun\app\model\User::class,
];