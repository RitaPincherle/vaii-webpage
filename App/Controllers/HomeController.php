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
        $data = array_slice($posts, 0, 3);
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
        $autor = $_SESSION['user'];

//        $favourites = Favourite::getAll("autor = $autor");
        $con = Connection::connect();
        $stmt = $con->prepare("SELECT p.obrazok AS obrazok, p.nazov AS NAZOV, 
        p.id AS ID, p.typ_postu AS typ, p.autor AS autor, 
        p.rating AS rating, p.text AS text 
            FROM posts p JOIN favourites f 
                ON f.id_postu = p.id 
                    WHERE p.typ_postu = 2 AND f.id_autor LIKE :autor");
        // AND f.id_autor like $autor
        $stmt->execute(['autor' => $autor]);
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        foreach ($posts as $post) {
            if ($post->getTypPostu() == 2) {
                $data[] = $post;
            }
        }

        return $this->html(
            [
                'posts' => $data,
//                'favourites' => $favourites,
                'favourites'=>$results
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
