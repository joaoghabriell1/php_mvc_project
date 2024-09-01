<?php

class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPosts()
    {
        $this->db->query('SELECT *, P.created_at AS created_at, P.id AS post_id, P.title AS post_title, U.id AS user_id, U.name AS user_name FROM POSTS as P INNER JOIN USERS AS U ON P.user_id = U.id ORDER BY P.created_at DESC');
        return $this->db->resultSet();
    }


    public function addPost($title, $body)
    {
        $user_id = $_SESSION['user_id'];

        $this->db->query('INSERT INTO posts (title, body, user_id) VALUES (:title, :body, :user_id)');

        $this->db->bind('title', $title, PDO::PARAM_STR);
        $this->db->bind('body', $body, PDO::PARAM_STR);
        $this->db->bind('user_id', $user_id, PDO::PARAM_INT);

        $row = $this->db->execute();

        return $row;
    }

    public function editPost($title, $body, $post_id)
    {
        $query = 'UPDATE posts SET title = :title, body = :body WHERE id = :id';
        $this->db->query($query);
        $this->db->bind(':title', $title);
        $this->db->bind(':body', $body);
        $this->db->bind(':id', $post_id);

        $row = $this->db->execute();

        return $row;
    }

    public function getPostById($post_id)
    {
        $this->db->query('SELECT * FROM posts WHERE id = :id');
        $this->db->bind(':id', $post_id);

        $row = $this->db->getSingle();;

        return $row;
    }

    public function deletePost($post_id)
    {
        $this->db->query('DELETE FROM posts WHERE id = :id');
        $this->db->bind(':id', $post_id);

        return $this->db->execute();
    }
}
