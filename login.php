<?php
    $title = 'Login';
    include_once "layout/header.php";
    include_once "middlewares/auth.php";
    include_once "layout/nav.php";

    $users = [
        [
            'id' => 1,
            'name' => 'ganna',
            'email' => 'ganna@gmail.com',
            'password' => 123456,
            'gender' => 'female',
            'image' => '1.jpg'
        ],
        [
            'id' => 2,
            'name' => 'taha',
            'email' => 'taha@gmail.com',
            'password' => 123456,
            'gender' => 'male',
            'image' => '2.webp'
        ],
        [
            'id' => 3,
            'name' => 'hassan',
            'email' => 'hassan@gmail.com',
            'password' => 123456,
            'gender' => 'male',
            'image' => '3.jpg'
        ]
    ];
    
    if($_POST){
        $errors = [];
        if(empty($_POST['email'])){
            $errors['email-required'] = '<div class="alert alert-danger p-1 my-1">Email IS Required</div>';
        }
        if(empty($_POST['password'])){
            $errors['password-required'] = '<div class="alert alert-danger  p-1 my-1">Password IS Required</div>';
        }

        if(empty($errors)){
            foreach ($users as $index => $user) {
                if($_POST['email'] == $user['email'] && $_POST['password'] == $user['password']){
                    $_SESSION['user'] = $user;
                    header("Location:index.php");
                }
            }
            $errors['wrong-credantial'] = '<div class="alert alert-danger  p-1 my-1">wrong cerdantial</div>';
        }
    }

    
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-12 text-center h1">
            <?=$title?>
        </div>
        <div class="col-4 offset-4">
            <form action="" method="post">
                <div class="form-group">
                  <label for="Email" class="mb-1">Email</label>
                  <input type="email" name="email" id="Email" value="<?= (isset($_POST['email'])) ? $_POST['email'] :""; ?>" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <?php
                    if(isset($errors['email-required'])){
                        echo $errors['email-required'];
                    }
                ?>
                <div class="form-group">
                  <label for="Password" class="mb-1">Password</label>
                  <input type="password" name="password" id="Password" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <?php
                    if(isset($errors['password-required'])){
                        echo $errors['password-required'];
                    }
                    if(isset($errors['wrong-credantial'])){
                        echo $errors['wrong-credantial'];
                    }
                ?>
                <div class="form-group">
                    <button class="btn btn-primary mt-1"><?=$title;?></button>
                </div>
                
            </form>
        </div>
    </div>
</div>

<?php
    include_once "layout/footer.php";
    
?>
