<?php

namespace App\Models;

use App\config\Connection;
use PDO;

class ORM
{
    private $table;
    protected $connection;

    public function __construct()
    {
        $this->connection = Connection::connect();
    }

    public function setTable($table)
    {
        $this->table = $table;
    }

    public function read()
    {
        $query = "SELECT * FROM {$this->table}";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($conditions)
    {
        $conditionFields = [];
        foreach ($conditions as $column => $value) {
            $conditionFields[] = "$column = :$column";
        }
        $query = "DELETE from {$this->table} where " . implode(" AND ", $conditionFields);
        $result = $this->connection->prepare($query);
        $result->execute($conditions);
        return $result->rowCount();
    }

    public function create($data)
    {
        $columns = implode(",", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));
        print_r($data);
        $query = "INSERT  INTO {$this->table} ($columns) VALUES ($values) ";
        $result = $this->connection->prepare($query);
        $result->execute($data);
        return;
    }

    public function update($data, $conditions)
    {
        $conditionFields = [];
        foreach ($conditions as $column => $value) {
            $conditionFields[] = "$column = :$column";
        }
        $updateDataFields = [];
        foreach ($data as $column => $value) {
            $updateDataFields[] = "$column = :$column";
        }
        $query = "UPDATE {$this->table} SET " . implode(", ", $updateDataFields) . " WHERE " . implode(" AND ", $conditionFields);
        $result = $this->connection->prepare($query);
        $result->execute(array_merge($data, $conditions));
        return;
    }

    public function readArticles()
    {

        $query = "SELECT articles.id,title,slug,featured_image as image,content,excerpt,status,views,created_at,categories.name as category_name,users.username as author_name,GROUP_CONCAT(tags.name) as tag_names
        from articles
        JOIN categories on articles.category_id = categories.id
        join users on articles.author_id = users.id
        left join article_tags on articles.id = article_tags.article_id
        left join tags on article_tags.tag_id = tags.id
        group by articles.id
        order by articles.created_at desc";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getRecentArticles()
    {

        $query = "SELECT articles.id,title,slug,featured_image as image,content,excerpt,status,views,created_at,categories.name as category_name,users.username as author_name,GROUP_CONCAT(tags.name) as tag_names
        from articles
        JOIN categories on articles.category_id = categories.id
        join users on articles.author_id = users.id
        left join article_tags on articles.id = article_tags.article_id
        left join tags on article_tags.tag_id = tags.id
        group by articles.id
        order by articles.created_at desc limit 5";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getArticlesById($id)
    {

        $query = "SELECT users.id as author_id,articles.id,title,slug,meta_description,featured_image as image,content,excerpt,status,views,created_at,categories.name as category_name,users.username as author_name,GROUP_CONCAT(tags.name) as tag_names
        from articles
        JOIN categories on articles.category_id = categories.id
        join users on articles.author_id = users.id
        left join article_tags on articles.id = article_tags.article_id
        left join tags on article_tags.tag_id = tags.id
        where articles.id=$id
        group by articles.id
        order by articles.created_at desc";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }


    public function getArticlesByAuthor($id)
    {

        $query = "SELECT users.id as author_id,articles.id,title,slug,meta_description,featured_image as image,content,excerpt,status,views,created_at,categories.name as category_name,users.username as author_name,GROUP_CONCAT(tags.name) as tag_names
        from articles
        JOIN categories on articles.category_id = categories.id
        join users on articles.author_id = users.id
        left join article_tags on articles.id = article_tags.article_id
        left join tags on article_tags.tag_id = tags.id
        where articles.author_id=$id
        group by articles.id
        order by articles.created_at desc";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getpublishedArticles()
    {

        $query = "SELECT users.id as author_id,articles.id,title,slug,meta_description,featured_image as image,content,excerpt,status,views,created_at,categories.name as category_name,users.username as author_name,GROUP_CONCAT(tags.name) as tag_names
        from articles
        JOIN categories on articles.category_id = categories.id
        join users on articles.author_id = users.id
        left join article_tags on articles.id = article_tags.article_id
        left join tags on article_tags.tag_id = tags.id
        where articles.status='published'
        group by articles.id
        order by articles.created_at desc";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticleByslug($id)
    {

        $query = "SELECT users.id as author_id,articles.id,title,slug,meta_description,featured_image as image,content,excerpt,status,views,created_at,categories.name as category_name,users.username as author_name,GROUP_CONCAT(tags.name) as tag_names
        from articles
        JOIN categories on articles.category_id = categories.id
        join users on articles.author_id = users.id
        left join article_tags on articles.id = article_tags.article_id
        left join tags on article_tags.tag_id = tags.id
        where articles.slug='$id'
        group by articles.id
        order by articles.created_at desc";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function sum()
    {
        $query = "SELECT COUNT(*) as total from {$this->table}";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getById($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id=$id";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function login($email, $password)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $result = $this->connection->prepare($query);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);
        if ($result->rowCount() > 0) {
            if (password_verify($password, $row["password_hash"])) {
                return $row;
            }
            return false;
        }
    }

    // public function reviewArticle($status,$id){
    //     $query="UPDATE articles set status=$status where id=$id";
    //     $result= $this->connection->prepare($query);
    //     $result->execute();
    //     return;
    // }

    public function incrementViews($id)
    {
        $query = "UPDATE articles set views=views+1 where id=$id";
        $result = $this->connection->prepare($query);
        $result->execute();
        return;
    }

    public function getTopUsers()
    {
        $query = "SELECT 
     users.id,profile_picture_url, username, 
     COUNT(articles.id) AS article_count, 
     SUM(articles.views) AS viewsAll 
     FROM articles 
     JOIN users ON users.id = articles.author_id 
     GROUP BY users.id 
     ORDER BY viewsAll DESC 
     LIMIT 3";
     $result = $this->connection->prepare($query);
     $result->execute();
     return $result->fetchAll(PDO::FETCH_ASSOC);

     
    }

    public function getLastArticleId(){
        $query = "SELECT * from articles order by created_At desc limit 1;";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function createArticleTags($data){
        $columns = implode(",", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));
        print_r($data);
        $query = "INSERT  INTO article_tags ($columns) VALUES ($values) ";
        $result = $this->connection->prepare($query);
        $result->execute($data);
        return;
    }
    
}
