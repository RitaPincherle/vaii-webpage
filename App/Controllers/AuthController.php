<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Core\Responses\ViewResponse;
use App\Models\User;

/**
 * Class AuthController
 * Controller for authentication actions
 * @package App\Controllers
 */
class AuthController extends AControllerBase
{
    /**
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->redirect(Configuration::LOGIN_URL);
    }

    /**
     * Login a user
     * @return Response
     */
    public function login(): Response
    {
        $formData = $this->app->getRequest()->getPost();
        $logged = null;
        if (isset($formData['submit'])) {
            $logged = $this->app->getAuth()->login($formData['login'], $formData['password']);
            if ($logged) {
                if ($this->app->getAuth()->isAdmin()){
                    return $this->redirect($this->url("admin.index"));
                }
                return $this->redirect($this->url("home.index"));
            }
        }

        $data = ($logged === false ? ['message' => 'Zlý login alebo heslo!'] : []);

        return $this->html($data);

    }

    public function register(): Response
    {
        $formData = $this->app->getRequest()->getPost();


        if (isset($formData['submit'])) {
            $username = $this->request()->getValue("login");
            $users = User::getAll();
            foreach ($users as $user) {
                if ($user->getMeno() == $username) {
                    $data["message"] = "meno je už obsadene!";
                    return $this->html($data, "login");
                }
            }
            $heslo = $formData["password"];
            $rheslo = $formData["repassword"];
            if($heslo == $rheslo){
                $user = new User();
                $user->setMeno($username);
                $user->setHeslo(password_hash("$heslo", PASSWORD_DEFAULT));
                $user->setAdmin(0);
                $user->save();
            }else{
                $data["message"] = "passwords must match!";
                return $this->html($data, "login");
            }
        }
        return $this->redirect($this->url("auth.login"));
    }

    /**
     * Logout a user
     * @return ViewResponse
     */
    public function logout(): Response
    {
        $this->app->getAuth()->logout();
        return $this->redirect($this->url("home.index"));
    }
}