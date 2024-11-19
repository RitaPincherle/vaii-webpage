<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Post;

class PostController extends AControllerBase
{

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        return $this->redirect($this->url("post.add"));
    }

    public function add(): Response {
        return $this->html("post.add");
    }
    public function upload(): Response {
        $post = new Post();
        $post->setAutor($_SESSION['user']);
        $post->setRating($this->request()->getValue("rating"));
        $post->setNazov($this->request()->getValue("title"));
        $post->setText($this->request()->getValue("text"));
        if($this->request()->getValue("imageUrl") === "") {
            $post->setObrazok($this->request()->getValue("fileInput"));
        } else {
            $post->setObrazok($this->request()->getValue("imageUrl"));
        }
        $post->setTypPostu($this->request()->getValue("typ_postu"));
        $post->save();
        return $this->redirect("?c=Home");
    }
}