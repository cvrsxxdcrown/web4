<?php
require_once "INewsDB.class.php";

class NewsDB implements INewsDB
{
    const DB_NAME = __DIR__ . "/news.db";
    protected SQLite3 $_db;

    public function __construct()
    {
        try {
            $isNew = !file_exists(self::DB_NAME) || filesize(self::DB_NAME) === 0;

            $this->_db = new SQLite3(self::DB_NAME);
            $this->_db->exec("PRAGMA foreign_keys = ON");

            if ($isNew) {
                $sql = file_get_contents(__DIR__ . "/news.txt");
                if (!$this->_db->exec($sql)) {
                    throw new Exception($this->_db->lastErrorMsg());
                }
            }
        } catch (Throwable $e) {
            die("Ошибка БД: " . $e->getMessage());
        }
    }

    public function __destruct()
    {
        $this->_db->close();
    }

    public function saveNews($title, $category, $description, $source)
    {
        $stmt = $this->_db->prepare("
            INSERT INTO msgs (title, category, description, source, datetime)
            VALUES (:title, :category, :description, :source, :dt)
        ");

        $stmt->bindValue(":title", $title, SQLITE3_TEXT);
        $stmt->bindValue(":category", (int)$category, SQLITE3_INTEGER);
        $stmt->bindValue(":description", $description, SQLITE3_TEXT);
        $stmt->bindValue(":source", $source, SQLITE3_TEXT);
        $stmt->bindValue(":dt", time(), SQLITE3_INTEGER);

        return $stmt->execute() !== false;
    }

    public function getNews()
    {
        return $this->_db->query("
            SELECT msgs.id,
                   msgs.title,
                   category.name AS category,
                   msgs.description,
                   msgs.source,
                   msgs.datetime
            FROM msgs
            JOIN category ON category.id = msgs.category
            ORDER BY msgs.id DESC
        ");
    }

    public function deleteNews($id)
    {
        $id = (int)$id;
        return $this->_db->exec("DELETE FROM msgs WHERE id = $id");
    }
}
