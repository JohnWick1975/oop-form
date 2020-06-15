<?php


class App
{
    public static $db;

    /**
     * App constructor.
     * @param string $file_name - path to database.
     */
    public function __construct(string $file_name)
    {
        self::$db = new FileDB($file_name);
        self::$db->load();
    }

    public function __destruct()
    {
        self::$db->save();
    }
}