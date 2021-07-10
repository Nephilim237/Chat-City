<?php

use Chat\Helpers;
use Chat\MakeAvatar;
use Chat\Model\User;

$errors = [];
$messages = [];

if (isset($_POST['register'])) {
    extract($_POST);
    session_start();
    if (isset($_SESSION['user_data'])) {
        header('Location: chatroom.php');
        exit();
    }
    if (empty(trim($name))) {
        $errors['name'] = "Champ Obligatoire";
    }

    $user = new User();
    $userData = $user->getAllEmails();
    $usedEmails = [];
    foreach ($userData as $key => $userDatum) {
        $usedEmails[$key] = $userDatum->getEmail();
    }
    if (in_array($email, $usedEmails)) {
        $errors['email'] = 'Adresse email déjà utilisée.';
    }

    if (empty($errors)) {
        $user->setName($name)
            ->setEmail($email)
            ->setPassword($password)
            ->setProfile(MakeAvatar::makeAvatar(strtoupper($name[0])))
            ->setStatus('Disabled')
            ->setCreatedAt(date('Y-m-d H:i:s'))
            ->setToken(md5(uniqid()))
            ->setLoginStatus('Logout')
        ;

        if ($user->saveData()) {
            $messages['success'] = 'Inscription réussie, vérifiez votre boîte email pour activer votre compte';
        } else {
            $messages['warning'] = 'Une erreur est survenue durant l\'inscription.';
        }
    } else {
        $messages['warning'] = 'Remplissez convenablement le formulaire';
    }
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="/vendor-front/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="/vendor-front/validator/fv.css">

        <title>Coding City Chat</title>
    </head>
    <body>
        <div class="container py-5 my-5">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="card my-3">
                        <?= Helpers::alert($messages) ?>
                        <?= Helpers::alert($messages, 'warning') ?>
                        <div class="card-header bg-dark text-light">
                            <h1 class="text-center">Chat'n</h1>
                        </div>

                        <div class="card-body">
                            <div class="card">
                                <div class="card-header"><h3 class="lead text-center">Rejoindre notre communauté</h3></div>
                            </div>
                            <form method="post" action="" novalidate>
                                <div class="mb-3 field">
                                    <label for="name" class="form-label">Nom *</label>
                                    <input type="text" name="name" id="name" class="form-control" required data-validate-length-range="3,32">
                                    <?= Helpers::errors($errors, 'name') ?>
                                </div>

                                <div class="mb-3 field">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                    <?= Helpers::errors($errors, 'email') ?>
                                </div>

                                <div class="mb-3 field">
                                    <label for="password" class="form-label">Mot de passe *</label>
                                    <input type="password" name="password" id="password" class="form-control" data-validate-length-range="8,32" required>
                                    <?= Helpers::errors($errors, 'password') ?>
                                </div>

                                <div class="mb-3 field">
                                    <label for="password-confirm" class="form-label">Confirmer mot de passe *</label>
                                    <input type="password" name="password-confirm" id="password-confirm" class="form-control" data-validate-linked="password" required>
                                    <?= Helpers::errors($errors, 'password-confirm') ?>
                                </div>

                                <div class="mb-3 text-center">
                                    <input type="submit" name="register" id="register" class="btn btn-primary" value="S'inscrire">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/vendor-front/bootstrap/bootstrap.bundle.min.js"></script>
        <script src="/vendor-front/jquery/jquery3.6.0.min.js"></script>
        <script src="/vendor-front/validator/multifield.js"></script>
        <script src="/vendor-front/validator/validator.js"></script>

        <script>
            let validator = new FormValidator({"events" : ['blur', 'paste', 'change']}, document.forms[0]);

            // on form "submit" event
            document.forms[0].onsubmit = function(e){
                let submit = true,
                    validatorResult = validator.checkAll(this);

                console.log(validatorResult);
                return !!validatorResult.valid;
            }

            // on form "reset" event
            document.forms[0].onreset = function(e){
                validator.reset();
            }
        </script>
    </body>
</html>