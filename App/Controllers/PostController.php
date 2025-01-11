<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Helpers\FileStorage;
use App\Models\Post;
use Exception;

class PostController extends AControllerBase
{

    /**
     * @inheritDoc
     * @throws Exception
     */

    public function authorize($action): bool
    {
        switch ($action) {
            case 'edit' :
            case 'delete' :
               // get id of post to check
                $id = (int)$this->request()->getValue("id");
                // get post from db
                $postToCheck = Post::getOne($id);
                // check if the logged login is the same as the post author
                // if yes, he can edit and delete post
                return $postToCheck->getAutor() == $this->app->getAuth()->getLoggedUserName() || $this->app->getAuth()->isAdmin();
            case 'upload':
                // get id of post to check
                $id = (int)$this->request()->getValue("id");
                if ($id > 0) {
                    // only author can save the edited post
                    $postToCheck = Post::getOne($id);
                    return $postToCheck->getAutor() == $this->app->getAuth()->getLoggedUserName() || $this->app->getAuth()->isAdmin();
                } else {
                    // anyone can add a new post
                    return $this->app->getAuth()->isLogged();
                }
            default:
                return $this->app->getAuth()->isLogged();
        }
    }

    public function index(): Response
    {
        return $this->redirect("?c=Home");
    }

    public function add(): Response
    {
        return $this->html();
    }

    /**
     * @throws HTTPException
     * @throws Exception
     */
    public function delete(): Response
    {
        $id = (int)$this->request()->getValue('id');
        $post = Post::getOne($id);

        if (is_null($post)) {
            throw new HTTPException(404);
        } else {
            $post->setFavourites();
            $favourites = $post->getFavourites();
            if($post->getIsURL() == 0){
                FileStorage::deleteFile($post->getObrazok());
            }
            foreach ($favourites as $favourite) {
                $favourite->delete();
            }
            $post->delete();
            return new RedirectResponse($this->url("home.index"));
        }
    }

    /**
     * @throws HTTPException
     */
    public function detail(): Response
    {
        $id = (int)$this->request()->getValue('id');
        try {
            $post = Post::getOne($id);
        } catch (Exception $e) {
            throw new HTTPException(404);
        }

        return $this->html(["post" => $post]);
    }

    /**
     * @throws HTTPException
     * @throws Exception
     */
    public function edit(): Response
    {

        $id = (int)$this->request()->getValue('id');
        if ($id > 0) {
            $post = Post::getOne($id);
            if (is_null($post)) {
                throw new HTTPException(404);
            }
        }else{
            throw new HTTPException(404);
        }

        return $this->html(
            ["post" => $post]);
    }

    /**
     * @throws HTTPException
     * @throws Exception
     */
    public function upload(): Response
    {
        $id = (int)$this->request()->getValue('id');
        $oldFileName = "";

        if ($id > 0) {
            $post = Post::getOne($id);

            if ($post->getIsURL() == 0) {
                $oldFileName = $post->getObrazok();
            }
        } else {
            $post = new Post();
            $post->setAutor($this->app->getAuth()->getLoggedUserName());
        }

        $post->setNazov($this->request()->getValue("title"));
        $post->setText($this->request()->getValue("text"));
        $post->setTypPostu($this->request()->getValue("typ_postu"));

        if (!is_numeric($this->request()->getValue("rating"))) {
            $post->setRating(1);
        }
        if ($this->request()->getValue("imageUrl") == null) {

            $post->setObrazok($this->request()->getFiles()['imageFile']['name']);
            $post->setIsURL(0);
        } else {
            $post->setObrazok($this->request()->getValue("imageUrl"));
            $post->setIsURL(1);
        }
        $formErrors = $this->formErrors();

        if (count($formErrors) > 0) {
            return $this->html(
                [
                    "post" => $post,
                    "errors" => $formErrors
                ], 'add'
            );
        } else {
            $post->setRating($this->request()->getValue("rating"));
            if ($oldFileName != "") {
                FileStorage::deleteFile($oldFileName);
            }
            if ($this->request()->getValue("imageUrl") == null) {

                $newFileName = FileStorage::saveFile($this->request()->getFiles()['imageFile']);
                $post->setObrazok($newFileName);
                $post->setIsURL(0);
            } else {
                $post->setObrazok($this->request()->getValue("imageUrl"));
                $post->setIsURL(1);
            }

            $post->save();


            return $this->redirect("?c=Home");
        }
    }

    private function formErrors(): array
    {
        $errors = [];
        if ($this->request()->getFiles()['imageFile']['name'] == "" && $this->request()->getValue("imageUrl") == "") {
            $errors[] = "Pole Súbor alebo URL obrázka musí byť vyplnené!";
        }
        if ($this->request()->getValue('text') == "") {
            $errors[] = "Pole Text príspevku musí byť vyplnené!";
        }
        if ($this->request()->getValue('rating') == "" || ($this->request()->getValue('rating') < 1 || $this->request()->getValue('rating') > 5 || !is_numeric($this->request()->getValue("rating")))) {
            $errors[] = "Pole rating príspevku musí byť vyplnené správnou hodnotou!";
        }
        if ($this->request()->getFiles()['imageFile']['name'] != "" && !in_array($this->request()->getFiles()['imageFile']['type'], ['image/jpeg', 'image/png'])) {
            $errors[] = "Obrázok musí byť typu JPG alebo PNG!";
        }
        if ($this->request()->getValue('text') != "" && strlen($this->request()->getValue('text') < 5)) {
            $errors[] = "Počet znakov v text príspevku musí byť viac ako 5!";
        }
        if ($this->request()->getValue('title') == "") {
            $errors[] = "Pole Review Title príspevku musí byť vyplnené!";
        }

        return $errors;
    }
}