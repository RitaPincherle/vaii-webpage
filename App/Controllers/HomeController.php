<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\DB\Connection;
use App\Core\Responses\Response;
use App\Models\Favourite;
use App\Models\Post;
use PDO;

/**
 * Class HomeController
 * Example class of a controller
 * @package App\Controllers
 */
class HomeController extends AControllerBase
{
    /**
     * Authorize controller actions
     * @param $action
     * @return bool
     */
    public function authorize($action)
    {
        return true;
    }

    public function index(): Response
    {
        $posts = Post::getAll();
        //$data = array_slice($posts, 0, 3);
        return $this->html($posts);
    }



    /**
     * @throws \Exception
     */
    public function books(): Response
    {
        $posts = Post::getAll();
        $data = [];
        $favouritePosts = [];

        // Check if the user is logged in
        if ($this->app->getAuth()->isLogged()) {
            $author = $_SESSION['user'];

            // Get all favourites for the logged-in user
            $favourites = (new \App\Models\Favourite())->getFavourites($author);
            $favouritePostIds = array_map(fn($fav) => $fav->getIdPostu(), $favourites);

            foreach ($posts as $post) {
                if (in_array($post->getId(), $favouritePostIds)) {
                    if ($post->getTypPostu() == 2) {
                        $favouritePosts[] = $post;
                    }
                }

                // Add post to the general book list
                if ($post->getTypPostu() == 2) {
                    $data[] = $post;
                }
            }
        } else {

            foreach ($posts as $post) {
                if ($post->getTypPostu() == 2) {
                    $data[] = $post;
                }
            }
        }


        return $this->html([
            'posts' => $data,
            'favourites' => $favouritePosts
        ]);
    }

    /**
     * @throws \Exception
     */
    public function series(): Response {
        $posts = Post::getAll();
        $data = [];
        $favouritePosts = [];


        if ($this->app->getAuth()->isLogged()) {
            $author = $_SESSION['user'];

            $favourites = (new \App\Models\Favourite())->getFavourites($author);
            $favouritePostIds = array_map(fn($fav) => $fav->getIdPostu(), $favourites);

            foreach ($posts as $post) {
                if (in_array($post->getId(), $favouritePostIds)) {
                    if ($post->getTypPostu() == 3) {
                        $favouritePosts[] = $post;
                    }
                }


                if ($post->getTypPostu() == 3) {
                    $data[] = $post;
                }
            }
        } else {

            foreach ($posts as $post) {
                if ($post->getTypPostu() == 3) {
                    $data[] = $post;
                }
            }
        }


        return $this->html([
            'posts' => $data,
            'favourites' => $favouritePosts
        ]);
    }


    /**
     * @throws \Exception
     */
    public function movies(): Response
    {
        $posts = Post::getAll();
        $data = [];
        $favouritePosts = [];


        if ($this->app->getAuth()->isLogged()) {
            $author = $_SESSION['user'];

            $favourites = (new \App\Models\Favourite())->getFavourites($author);
            $favouritePostIds = array_map(fn($fav) => $fav->getIdPostu(), $favourites);

            foreach ($posts as $post) {
                if (in_array($post->getId(), $favouritePostIds)) {
                    if ($post->getTypPostu() == 1) {
                        $favouritePosts[] = $post;
                    }
                }


                if ($post->getTypPostu() == 1) {
                    $data[] = $post;
                }
            }
        } else {

            foreach ($posts as $post) {
                if ($post->getTypPostu() == 1) {
                    $data[] = $post;
                }
            }
        }


        return $this->html([
            'posts' => $data,
            'favourites' => $favouritePosts
        ]);
    }

}
