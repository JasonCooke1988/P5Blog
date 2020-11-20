<?php


namespace App\Manager;


use App\Core\Container;
use App\Model\Post;

class PostManager extends Manager
{

    public function getList()
    {

        $sql = "SELECT post.id, post.title, post.content, post.createdAt, post.updatedAt, post.header, user.firstName, user.lastName
FROM post_user
         INNER JOIN post ON post_user.postId = post.id
         INNER JOIN user ON post_user.userId = user.id;";

        $query = $this->pdo->query($sql);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Post::class);

        $posts = $query->fetchAll();


        return $posts;
    }

    public function getOne(int $id, array $comments)
    {
        $sql = "SELECT post.id, post.title, post.content, post.createdAt, post.updatedAt, post.header, user.firstName, user.lastName
FROM post_user
         INNER JOIN post ON post_user.postId = post.id
         INNER JOIN user ON post_user.userId = user.id
         WHERE post.id = :id";

        $query = $this->pdo->prepare($sql);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Post::class);
        $query->bindValue(':id', $id);

        $query->execute();
        $post = $query->fetch();

        $post->setComments($comments);

        return $post;
    }


    public function create(array $data)
    {
        $sql = "INSERT INTO post (title, content, header, createdAt) VALUES (:title, :content, :header, now())";

        $query = $this->pdo->prepare($sql);
        $query->bindValue(':title', $data['title']);
        $query->bindValue(':content', $data['content']);
        $query->bindValue(':header', $data['header']);

        $query->execute();

        $sql = "SELECT LAST_INSERT_ID();";
        $query = $this->pdo->query($sql);
        $postId = $query->fetchColumn();


        $sql = "INSERT INTO post_user (userId, postId, createdAt) VALUES (:userId, :postId, now())";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':userId', $data['userId']);
        $query->bindValue(':postId', $postId);
        $query->execute();
    }
}