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
    public function books(): Response
    {
        $posts = Post::getAll();
        $data = array();
        if($this->app->getAuth()->isLogged()){
            $autor = $_SESSION['user'];
            $favourites = (new \App\Models\Favourite)->getFavourites($autor);
            foreach ($favourites as $favourite) {
                $favouritePosts[] = Post::getOne($favourite->getIdPostu());
            }
        }

        foreach ($posts as $post) {
            if ($post->getTypPostu() == 2) {
                $data[] = $post;
            }
        }

        $favouritePosts = array();

        return $this->html(
            [
                'posts' => $data,
                'favourites' => $favouritePosts
            ]);
    }
    public function series(): Response
    {
        return $this->html();
    }
    public function movies(): Response
    {
        return $this->html();
    }
}
