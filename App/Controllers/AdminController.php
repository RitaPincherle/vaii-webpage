<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\User;

/**
 * Class HomeController
 * Example class of a controller
 * @package App\Controllers
 */
class AdminController extends AControllerBase
{
    /**
     * Authorize controller actions
     * @param $action
     * @return bool
     */
    public function authorize($action)
    {
        return $this->app->getAuth()->isAdmin();
    }

    /**
     * Example of an action (authorization needed)
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     * @throws \Exception
     */
    public function index(): Response
    {
        $data = User::getAll();
        return $this->html($data);
    }

    /**
     * @throws \Exception
     */
    public function update(): Response {

        $users = User::getAll();

        foreach ($users as $user){
            $cid = $user->getId();
            $val = $this->request()->getValue("$cid");
            if($val == 1){
                $user->setAdmin(1);
                $user->save();
            } elseif($val == 2){
                $user->delete();
            }else{
                $user->setAdmin(0);
                $user->save();
            }
        }

        $data = User::getAll();

        return $this->json($data);
    }
}