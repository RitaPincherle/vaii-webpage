<?php

use \App\Models\User;
$layout = 'root';
/** @var \App\Core\IAuthenticator $auth
 * @var User[] $data
 * @var \App\Core\LinkGenerator $link
 * */ ?>

<div class="container py-5">
    <div class="row mb-4">
        <div class="col text-center">
            <h1 class="text-purple">User Management</h1>
            <p class="text-white">
                Welcome, <strong><?= $auth->getLoggedUserName() ?></strong>!<br>
                This section is accessible only to administrators.
            </p>
        </div>
    </div>
    <form id="userUpForm" action="<?php $link->url("admin.update") ?>" method="post">
        <div class="table-responsive">
            <table id="userTable" class="table table-bordered table-striped table-hover">
                <tr>
                    <th>Username</th>
                    <th>Is Admin</th>
                    <th>Delete User</th>
                </tr>
                <?php foreach ($data as $user): ?>
                    <tr>
                        <td><?php echo $user->getMeno(); ?></td>
                        <td><input type="checkbox" name="<?php echo $user->getId(); ?>" value="1" <?php echo $user->getAdmin() ? 'checked' : ''; ?>></td>
                        <td><input type="checkbox" name="<?php echo $user->getId(); ?>" value="2"></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-purple" onclick="submitUserUpdateForm(event)">submit changes</button>
        </div>
    </form>
</div>