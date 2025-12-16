<?php
require_once "INewsDB.class.php";

class NewsDB implements INewsDB
{
    const DB_NAME  = __DIR__ . "/news.db";
    const RSS_NAME = __DIR__ . "/rss.xml";
    const RSS_TITLE = "Последние новости";
    const RSS_LINK  = "http://f1205831.xsph.ru/web4/lab5/news/news.php";

    protected SQLite3 $_db;

    public function __construct()
    {
        $isNew = !file_exists(self::DB_NAME) || filesize(self::DB_NAME) === 0;
        $this->_db = new SQLite3(self::DB_NAME);

        if ($isNew) {
            $sql = file_get_contents(__DIR__ . "/news.txt");
            $this->_db->exec($sql);
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

        $res = $stmt->execute() !== false;

        if ($res) {
            $this->createRss();
        }

        return $res;
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
        return $this->_db->exec("DELETE FROM msgs WHERE id=" . (int)$id);
    }

    private function createRss()
    {
        $dom = new DOMDocument("1.0", "UTF-8");
        $dom->formatOutput = true;
        $dom->preserveWhiteSpace = false;

        $rss = $dom->createElement("rss");
        $rss->setAttribute("version", "2.0");
        $dom->appendChild($rss);

        $channel = $dom->createElement("channel");
        $rss->appendChild($channel);

        $channel->appendChild($dom->createElement("title", self::RSS_TITLE));
        $channel->appendChild($dom->createElement("link", self::RSS_LINK));

        $news = $this->getNews();
        while ($row = $news->fetchArray(SQLITE3_ASSOC)) {
            $item = $dom->createElement("item");

            $item->appendChild($dom->createElement("title", $row["title"]));
            $item->appendChild($dom->createElement("link", self::RSS_LINK));

            $desc = $dom->createElement("description");
            $desc->appendChild($dom->createCDATASection($row["description"]));
            $item->appendChild($desc);

            $item->appendChild(
                $dom->createElement("pubDate", date(DATE_RSS, $row["datetime"]))
            );

            $item->appendChild(
                $dom->createElement("category", $row["category"])
            );

            $channel->appendChild($item);
        }

        $dom->save(self::RSS_NAME);
    }
}
