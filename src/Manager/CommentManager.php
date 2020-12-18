<?php


namespace App\Manager;


use App\Model\Comment;

class CommentManager extends Manager
{

    public function getAll(int $postId)
    {
        $sql = "SELECT c.id, c.content, c.createdAt, u.firstName, u.lastName
FROM  comment c, user u LEFT JOIN post p ON p.id = :postId WHERE c.postId = :postId2 AND u.id = p.userId";

        $query = $this->pdo->prepare($sql);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Comment::class);
        $query->bindValue(':postId', $postId);
        $query->bindValue(':postId2', $postId);

        $query->execute();

        return $query->fetchAll();
    }

    public function getNonValidated(int $postId)
    {
        $sql = "SELECT c.id, c.content, c.createdAt, u.firstName, u.lastName
FROM  comment c, user u LEFT JOIN post p ON p.id = :postId WHERE c.postId = :postId2 AND u.id = p.userId AND c.validated = 0";

        $query = $this->pdo->prepare($sql);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Comment::class);
        $query->bindValue(':postId', $postId);
        $query->bindValue(':postId2', $postId);

        $query->execute();

        return $query->fetchAll();
    }

    public function getValidated(int $postId)
    {
        $sql = "SELECT c.id, c.content, c.createdAt, u.firstName, u.lastName
FROM  comment c, user u LEFT JOIN post p ON p.id = :postId WHERE c.postId = :postId2 AND u.id = p.userId AND c.validated = 1";

        $query = $this->pdo->prepare($sql);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Comment::class);
        $query->bindValue(':postId', $postId);
        $query->bindValue(':postId2', $postId);

        $query->execute();

        return $query->fetchAll();
    }

    public function create(array $data)
    {
        $sql = "INSERT INTO comment (content, postId, userId, createdAt) VALUES (:content, :postId, :userId, now())";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':content', $data['commentContent']);
        $query->bindValue(':userId', $data['userId']);
        $query->bindValue(':postId', $data['postId']);
        $query->execute();
    }

    public function validate(int $commentid)
    {
        $sql = "UPDATE comment SET validated = 1, updatedAt = now() WHERE id = :commentid";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':commentid', $commentid);
        $query->execute();
    }

    public function delete(int $commentid)
    {
        $sql = "DELETE FROM comment WHERE id = :commentid";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':commentid', $commentid);
        $query->execute();
    }
}