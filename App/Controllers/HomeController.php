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

    /**
     * Example of an action (authorization needed)
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     */
    public function index(): Response
    {
        $posts = Post::getAll();
        //$data = array_slice($posts, 0, 3);
        return $this->html($posts);
    }

    /**
     * Example of an action accessible without authorization
     * @return \App\Core\Responses\ViewResponse
     */
    public function contact(): Response
    {
        return $this->html();
    }

    /**
     * @throws \Exception
     */
    public function books(): Response
    {
        $posts = Post::getAll();
        $data = array();
        $favouritePosts = array();

        if($this->app->getAuth()->isLogged()){
            $autor = $_SESSION['user'];
            $favourites = (new \App\Models\Favourite)->getFavourites($autor);
            foreach ($favourites as $favourite) {
                $p = Post::getOne($favourite->getIdPostu());
                if($p->getTypPostu() == 2)
                    $favouritePosts[] = $p;
            }
        }

        foreach ($posts as $post) {
            if ($post->getTypPostu() == 2) {
                $data[] = $post;
            }
        }

        return $this->html(
            [
                'posts' => $data,
                'favourites' => $favouritePosts
            ]);
    }
    public function series(): Response
    {
        $posts = Post::getAll();
        $data = array();
        $favouritePosts = array();

        if($this->app->getAuth()->isLogged()){
            $autor = $_SESSION['user'];
            $favourites = (new \App\Models\Favourite)->getFavourites($autor);
            foreach ($favourites as $favourite) {
                $p = Post::getOne($favourite->getIdPostu());
                if($p->getTypPostu() == 3)
                    $favouritePosts[] = $p;
            }
        }

        foreach ($posts as $post) {
            if ($post->getTypPostu() == 3) {
                $data[] = $post;
            }
        }

        return $this->html(
            [
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
        $data = array();
        $favouritePosts = array();

        if($this->app->getAuth()->isLogged()){
            $autor = $_SESSION['user'];
            $favourites = (new \App\Models\Favourite)->getFavourites($autor);
            foreach ($favourites as $favourite) {
                $p = Post::getOne($favourite->getIdPostu());
                if($p->getTypPostu() == 1)
                $favouritePosts[] = $p;
            }
        }

        foreach ($posts as $post) {
            if ($post->getTypPostu() == 1) {
                $data[] = $post;
            }
        }



        return $this->html(
            [
                'posts' => $data,
                'favourites' => $favouritePosts
            ]);
    }

}
