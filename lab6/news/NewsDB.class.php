<?php
require_once "INewsDB.class.php";

class NewsDB implements INewsDB
{
    const DB_NAME = __DIR__ . "/news.db";

    protected PDO $db;

    public function __construct()
    {
        try {
            $isNew = !file_exists(self::DB_NAME) || filesize(self::DB_NAME) === 0;

            $this->db = new PDO("sqlite:" . self::DB_NAME);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if ($isNew) {
                $this->db->beginTransaction();

                $sql = file_get_contents(__DIR__ . "/news.txt");
                $this->db->exec($sql);

                $this->db->commit();
            }

        } catch (PDOException $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            die(
                "Ошибка БД: " .
                $e->getMessage() .
                "<br>Code: " . $e->getCode()
            );
        }
    }

    public function __destruct()
    {
        $this->db = null;
    }

    public function saveNews($title, $category, $description, $source)
    {
        try {
            $sql = "
                INSERT INTO msgs (title, category, description, source, datetime)
                VALUES (
                    " . $this->db->quote($title) . ",
                    " . (int)$category . ",
                    " . $this->db->quote($description) . ",
                    " . $this->db->quote($source) . ",
                    " . time() . "
                )
            ";

            return $this->db->exec($sql) !== false;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function getNews()
    {
        return $this->db->query("
            SELECT
                msgs.id,
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
        return $this->db->exec("DELETE FROM msgs WHERE id=" . (int)$id);
    }
}
