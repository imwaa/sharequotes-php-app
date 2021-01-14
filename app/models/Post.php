<?php

class Post
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getMyPosts()
    {
        $this->db->query('SELECT *,
                          posts.id as postId,
                          users.id as userId,
                          posts.created_at as postCreated,
                          users.created_at as userCreated
                          FROM posts
                          INNER JOIN users
                          ON posts.user_id = users.id
                          WHERE posts.user_id = :user_id
                          ORDER BY posts.created_at DESC
                          ');
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getPosts()
    {
        $this->db->query('SELECT *,
                          posts.id as postId,
                          users.id as userId,
                          posts.created_at as postCreated,
                          users.created_at as userCreated
                          FROM posts
                          INNER JOIN users
                          ON posts.user_id = users.id
                          ORDER BY posts.created_at DESC
                          ');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getPostById($id)
    {
        $this->db->query('SELECT * FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    public function addPost($data)
    {
        //QUERY TO ADD POST
        $this->db->query('INSERT INTO posts (body,author,user_id) VALUES(:body, :author, :user_id)');
        //BIND VALUES
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':author', $data['author']);
        $this->db->bind(':user_id', $data['user_id']);

        //EXECUTE
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePost($data)
    {
        //QUERY TO ADD POST
        $this->db->query('UPDATE posts SET body = :body, author = :author WHERE id = :id');
        //BIND VALUES
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':author', $data['author']);

        //EXECUTE
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePost($id)
    {
    }
}
