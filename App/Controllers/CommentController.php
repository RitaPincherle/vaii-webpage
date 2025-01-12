<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Models\Comment;
use App\Models\Post;
use Exception;

class CommentController extends AControllerBase
{
    /**
     * @inheritDoc
     * @throws Exception
     */
    public function authorize($action): bool
    {
        switch ($action) {
            case 'delete':
                $id = (int)$this->request()->getValue("id");
                $comment = Comment::getOne($id);
                return $comment && ($comment->getAutor() == $this->app->getAuth()->getLoggedUserName() || $this->app->getAuth()->isAdmin());
            case 'upload':
                $id = (int)$this->request()->getValue("id");
                if ($id > 0) {
                    $comment = Comment::getOne($id);
                    return $comment && $comment->getAutor() == $this->app->getAuth()->getLoggedUserName();
                } else {
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

    /**
     * Handles both adding a new comment and editing an existing one.
     * @throws HTTPException
     * @throws Exception
     */
    public function upload(): Response
    {
        $id = (int)$this->request()->getValue("id");
        if ($id > 0) {
            $comment = Comment::getOne($id);
            if (is_null($comment)) {
                throw new HTTPException(404);
            }
        } else {
            $comment = new Comment();
            $comment->setAutor($this->app->getAuth()->getLoggedUserName());
        }

        $comment->setText($this->request()->getValue('text'));
        $comment->setIdPostu((int)$this->request()->getValue('id_postu'));

        $formErrors = $this->formErrors();

        if (count($formErrors) > 0) {
            return $this->html(
                [
                    'post'=>Post::getOne($comment->getIdPostu()),
                    'comment' => $comment,
                    'errors' => $formErrors
                ], 'edit'
            );
        } else {
            $comment->save();
            return $this->redirect("?c=Post&a=detail&id=" . $comment->getIdPostu());
        }
    }

    /**
     * @throws HTTPException
     * @throws Exception
     */
    public function delete(): Response
    {
        $id = (int)$this->request()->getValue('id');
        $comment = Comment::getOne($id);

        if (is_null($comment)) {
            throw new HTTPException(404);
        }

        $postId = $comment->getIdPostu();
        $comment->delete();

        return $this->redirect("?c=Post&a=detail&id=" . $postId);
    }

    /**
     * Redirects to the add comment form.
     * @throws Exception
     */
    public function add(): Response
    {
        $postId = (int)$this->request()->getValue('id_postu');
        $post = Post::getOne($postId);

        if (is_null($post)) {
            throw new HTTPException(404);
        }

        return $this->html(
            [
                'post' => $post
            ],
            'add'
        );
    }

    /**
     * Redirects to the edit comment form.
     * @throws HTTPException
     * @throws Exception
     */
    public function edit(): Response
    {
        $id = (int)$this->request()->getValue('id');
        $comment = Comment::getOne($id);

        if (is_null($comment)) {
            throw new HTTPException(404);
        }

        $post = Post::getOne($comment->getIdPostu());
        if (is_null($post)) {
            throw new HTTPException(404);
        }

        return $this->html(
            [
                'comment' => $comment,
                'post' => $post,
                'errors' => null
            ],
            'edit'
        );
    }

    /**
     * Validate form inputs for comments.
     * @return array
     */
    private function formErrors(): array
    {
        $errors = [];
        if ($this->request()->getValue('text') == "") {
            $errors[] = "The comment text field must be filled in!";
        }
        if (strlen($this->request()->getValue('text')) < 5) {
            $errors[] = "The comment text must be at least 5 characters long!";
        }
        return $errors;
    }
}
