<?php


namespace App\Manager;


use App\Model\Comment;

class CommentManager extends Manager
{

    public function getAll(int $postId)
    {
        $sql = "SELECT comment.content, comment.createdAt, user.firstName, user.lastName
FROM  comment, user
         INNER JOIN comment_user ON comment_user.userId = user.id
    INNER JOIN comment_post ON comment_post.postId = :postId;";

        $query = $this->pdo->prepare($sql);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Comment::class);
        $query->bindValue(':postId', $postId);

        $query->execute();
        $comments = $query->fetchAll();

        return $comments;
    }

    public function create(array $data)
    {
        $sql = "INSERT INTO comment (content, createdAt) VALUES (:content, now())";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':content', $data['commentContent']);
        $query->execute();

        $sql = "SELECT LAST_INSERT_ID();";
        $query = $this->pdo->query($sql);
        $commentId = $query->fetchColumn();

        $sql= "INSERT INTO comment_post (commentId, postId, createdAt) VALUES (:commentId, :postId, now())";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':commentId', $commentId);
        $query->bindValue(':postId', $data['postId']);
        $query->execute();

        $sql= "INSERT INTO comment_user (commentId, userId, createdAt) VALUES (:commentId, :userId, now())";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':commentId', $commentId);
        $query->bindValue(':userId', $data['userId']);
        $query->execute();
    }

}