<?php


namespace App\Manager;


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

    public function getOne(int $postid, array $comments): Post
    {
        $sql = "SELECT p.id, p.title, p.content, p.createdAt, p.updatedAt, p.header, u.firstName, u.lastName
                FROM post p
                LEFT JOIN user u ON p.userId = u.id
                WHERE p.id = :postid";

        $query = $this->pdo->prepare($sql);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Post::class);
        $query->bindValue(':postid', $postid);

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

    public function modify(array $data)
    {
        $sql = "UPDATE post SET title = :title, content = :content, header = :header, updatedAt = now() WHERE id = :postId;";

        $query = $this->pdo->prepare($sql);
        $query->bindValue(':title', $data['title']);
        $query->bindValue(':content', $data['content']);
        $query->bindValue(':header', $data['header']);
        $query->bindValue(':postId', $data['postId']);

        $query->execute();
    }

    public function delete(int $postid)
    {
        $sql = "DELETE FROM post WHERE id = :postid";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':postid', $postid);
        $query->execute();
    }
}