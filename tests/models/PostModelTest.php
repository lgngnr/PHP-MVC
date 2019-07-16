<?php

    use PHPUnit\Framework\TestCase;

    require_once dirname(dirname(__DIR__)) . "/app/config/config.php";
    require_once dirname(dirname(__DIR__)) . "/app/libraries/Database.php";
    require_once dirname(dirname(__DIR__)) . "/app/models/Post.php";

    class PostModelTest extends TestCase{

        public function testGetPosts(){
            echo __DIR__;
            $post  = new Post;
            $posts = $post->getPosts();
            $this->assertEquals(count($posts), 2);
        }
    }
?>