<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Favourite;

class FavouriteController extends AControllerBase
{

    /**
     * @inheritDoc
     */
    public function authorize($action): bool
    {

        return $this->app->getAuth()->isLogged();

    }
    public function index(): Response
    {
        return $this->redirect("?c=Home");
    }

    /**
     * Update favourites based on JSON data sent from the client.
     * @return Response
     * @throws \Exception
     */
    public function update(): Response
    {
        try {
            // Get JSON data from the request body
            $data = $this->request()->getRawBodyJSON();
            $userId = $_SESSION['user'] ?? null;
            // Check if required fields are provided
            if (!$userId || !$data || !isset($data->postId) || !isset($data->action)) {
                return $this->json(['status' => 'error', 'message' => 'Invalid request'], 400);
            }

            $postId = $data->postId;
            $action = $data->action;
            $userId = $_SESSION['user'] ?? null;

            // Ensure the user is logged in
            if (!$userId) {
                return $this->json(['status' => 'error', 'message' => 'User not logged in'], 401);
            }

            if ($action === 'add') {
                // Add post to favourites if it doesn't already exist
                $existing = Favourite::getAll("id_autor = ? AND id_postu = ?", [$userId, $postId]);
                if (empty($existing)) {
                    $favourite = new Favourite();
                    $favourite->setIdAutor($userId);
                    $favourite->setIdPostu($postId);
                    $favourite->save();
                }
            } elseif ($action === 'remove') {
                // Remove post from favourites if it exists
                $existing = Favourite::getAll("id_autor = ? AND id_postu = ?", [$userId, $postId]);
                if (!empty($existing)) {
                    $existing[0]->delete();
                }
            } else {
                // Invalid action
                return $this->json(['status' => 'error', 'message' => 'Invalid action'], 400);
            }

            // Return updated favourites for the logged-in user
            $updatedFavourites = Favourite::getAll("id_autor = ?", [$userId]);
            return $this->json($updatedFavourites);

        } catch (\Exception $e) {
            // Log the exception and return a server error response
            error_log($e->getMessage());
            return $this->json(['status' => 'error', 'message' => 'Server error'], 500);
        }
    }
}