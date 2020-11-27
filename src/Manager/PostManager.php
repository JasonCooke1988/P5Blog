<?php


namespace App\Manager;


use App\Core\Container;
use App\Model\Post;

class PostManager extends Manager
{

    public function getList(): array
    {

        $sql = "SELECT p.id, p.title, p.content, p.createdAt, p.updatedAt, p.header, u.firstName, u.lastName
FROM post p
         LEFT JOIN user u ON p.userId = u.id";

        $query = $this->pdo->query($sql);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Post::class);

        $posts = $query->fetchAll();


        return $posts;
    }

    public function getOne(int $postId, array $comments): Post
    {
        $sql = "SELECT p.id, p.title, p.content, p.createdAt, p.updatedAt, p.header, u.firstName, u.lastName
                FROM post p
                LEFT JOIN user u ON p.userId = u.id
                WHERE p.id = :id";

        $query = $this->pdo->prepare($sql);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Post::class);
        $query->bindValue(':id', $postId);

        $query->execute();
        $post = $query->fetch();

        $post->setComments($comments);

        return $post;
    }


    public function create(array $data)
    {
        $sql = "INSERT INTO post (title, content, header, userId, createdAt) 
                VALUES (:title, :content, :header, :userId, now());";

        $query = $this->pdo->prepare($sql);
        $query->bindValue(':title', $data['title']);
        $query->bindValue(':content', $data['content']);
        $query->bindValue(':header', $data['header']);
        $query->bindValue(':userId', $data['userId']);

        $query->execute();
    }
}