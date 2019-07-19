<?php

    use PHPUnit\Framework\TestCase;

    require_once dirname(dirname(__DIR__)) . "/app/config/config.php";
    require_once dirname(dirname(__DIR__)) . "/app/libraries/Database.php";
    require_once dirname(dirname(__DIR__)) . "/app/models/Post.php";

    /**
     * Test Class for Post Model
     */
    class PostModelTest extends TestCase{

        // Prepare data
        private $data = [
            "title" => "testAddModel_title",
            "body" => "testAddModel_body",
            "user_id" => 5 // test user
        ];

        /**
         * Test Post model function addPost,
         * should add a new post and return true,
         * false otherwise
         *
         * @test
         */
        public function testAddPost(){
            // Istantiate Post Model
            $post  = new Post;
            $res = $post->addPost($this->data);
            $this->assertTrue($res);
        }

        /**
         * Test Post MODEL method getPosts(),
         * should return all the posts added
         * 
         * @depends testAddPost
         */

        public function testGetPosts(){
            // Istantiate Post Model
            $post  = new Post;
            $posts = $post->getPosts();
            
            // Istantiate db
            $db =  new Database;
            $db->query("SELECT * FROM posts");
            $db->execute();
            $numPosts = $db->rowCount();

            $this->assertTrue(count($posts) == $numPosts);
            return $posts;
        }

        /**
         * Test Post MODEL method getPost($id),
         * should return the poste added with testAddPost(data)
         * 
         * @depends testAddPost
         * @depends testGetPosts
         */
        public function testGetPost($tmp, $posts){
            // Make sure testGetPosts return posts
            $this->assertNotNull($posts);

            // Looking for post added by user_id 5
            $post = NULL;
            foreach($posts as $p){
                if($p->user_id == 5){
                    $post = $p;
                }
            }

            // Mkae sure the post is found
            $this->assertNotEmpty($post);
            // Check id
            $this->assertNotNull($post->id);
            // Check title
            $this->assertEquals($post->title, $this->data['title']);
            // Check body
            $this->assertEquals($post->body, $this->data['body']);

            $this->postModel = new Post;
            $getPost = $this->postModel->getPost($post->id);

            // Mkae sure the post is found
            $this->assertNotNull($getPost);
            // Check title
            $this->assertEquals($getPost->title, $this->data['title']);
            // Check body
            $this->assertEquals($getPost->body, $this->data['body']);

            return $getPost;
        }

        /**
         * Test Post MODEL method updatePost($data),
         * shuld update previously added post with new data
         *
         * @depends testGetPost
         */
        public function testUpdatePost($post){
            $this->assertEquals($post->title, 'testAddModel_title');
            // Update data
            $data = array(
                'id'=> $post->id, 
                'title'=> $post->title . "_UPDATED",
                'body'=> $post->body . "_UPDATED",
            );
            
            // Istantiate Post Model
            $postModel = new Post;
            // Check success execution
            $this->assertTrue($postModel->updatePost($data));

            // Second check
            // Istantiate db
            $db = new Database;
            $db->query("SELECT * FROM posts WHERE id = :id");
            $db->bind(':id', $post->id);
            $res = $db->resultSet();
            $numRes = $db->rowCount();

            // Make sure get the post
            $this->assertEquals($numRes, 1);
            
            // Check each field if match
            $this->assertEquals($res->title, $data['title']);
            $this->assertEquals($res->body, $data['body']);
            return $post->id;
        }


    }
?>