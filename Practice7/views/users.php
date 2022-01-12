<?php
    //session_start();
    $isRestricted = false;
    if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
        $isRestricted = true;
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .container {
            width: 400px;
        }
    </style>
    <title>User list</title>
</head>
<body style="padding-top: 3rem;">

<?php if($isRestricted):?>

    <form action="?controller&action=logout" method="post" enctype="multipart/form-data">
        <input type="submit" class="btn right" value="Logout">
    </form>
    <div class="container">
        <div class="row">
            <table>
                <?php foreach ($users as $user):?>
                    <tr>
                        <td>
                            <form action="?controller=users&action=show&id=<?=$user['id']?>" method="post">
                                <button class="btn" type="submit" name="id" value="<?=$user['id']?>"><?=$user['id']?></button>
                            </form>
                        </td>
                        <td><?=$user['name']?></td>
                        <td><?=$user['email']?></td>
                        <td><?=$user['gender']?></td>
                        <?php $path = ($user['path_to_img'] === "")? "public/default/default.png" : "public/uploads/" . $user['path_to_img']?>
                        <td><img src='<?=$path?>' width="50px"/></td>
                        <td>
                            <form action="?controller=users&action=delete&id=<?=$user['id']?>" method="post">
                                <button class="btn" type="submit" name="id" value="<?=$user['id']?>">X</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach;?>
            </table>
        </div>
        <a class="btn" href="?controller=index">Return back</a>
        <a class="btn right" href="?controller=users&action=addForm">Add a new User</a>
        <br><br><br><br><br>
    </div>
<?php else:?>
    <?php include 'restrict.php'?>
<?php endif;?>
</body>
</html>
