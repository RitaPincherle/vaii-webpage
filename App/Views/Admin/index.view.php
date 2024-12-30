<?php

use \App\Models\User;
$layout = 'auth';
/** @var \App\Core\IAuthenticator $auth
 * @var User[] $data
 * @var \App\Core\LinkGenerator $link
 * */ ?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div>
                Vitaj, <strong><?= $auth->getLoggedUserName() ?></strong>!<br><br>
                Táto časť aplikácie je prístupná len pre administrátora.
            </div>
        </div>
    </div>
</div>

<h1>User Management</h1>
<form id="userUpForm" action="<?php $link->url("admin.update") ?>" method="post">
    <table id="userTable">
        <tr>
            <th>Username</th>
            <th>Is Admin</th>
            <th>delete user</th>
        </tr>
        <?php foreach ($data as $user): ?>
            <tr>
                <td><?php echo $user->getMeno(); ?></td>
                <td><input type="checkbox" name="<?php echo $user->getId(); ?>" value="1" <?php echo $user->getAdmin() ? 'checked' : ''; ?>></td>
                <td><input type="checkbox" name="<?php echo $user->getId(); ?>" value="2"></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <button type="submit" onclick="submitUserUpdateForm(event)">submit changes</button>
</form>