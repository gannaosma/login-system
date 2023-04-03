<?php
$title = 'change information';
include_once "layout/header.php";
include_once "middlewares/guest.php";
include_once "layout/nav.php";
define('ALLOWED_ExTENSION', ['jpg', 'png', 'jpeg', 'webp']);
define('ALLOWED_SIZE', 10 ** 6);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = [];
    if (empty($_POST['name'])) {
        $errors['name-required'] = '<div class="alert alert-danger p-1 my-1">Name IS Required</div>';
    }
    if (empty($_POST['email'])) {
        $errors['email-required'] = '<div class="alert alert-danger p-1 my-1">Email IS Required</div>';
    }
    if (empty($_POST['gender'])) {
        $errors['gender-required'] = '<div class="alert alert-danger p-1 my-1">Gender IS Required</div>';
    }

    if (empty($errors)) {
        //update information

        //check if request has image
        if ($_FILES['image']['error'] == 0) {
            //validate extension
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            if (!in_array($extension, ALLOWED_ExTENSION)) {
                $errors['image']['extension'] = '<div class="alert alert-danger p-1 my-1"> Allowed Extension are: ' . implode(', ', ALLOWED_ExTENSION) . '</div>';
            }
            //validate size
            if ($_FILES['image']['size'] > ALLOWED_SIZE) {
                $errors['image']['extension'] = '<div class="alert alert-danger p-1 my-1">Allowed size is ' . (ALLOWED_SIZE / (10 ** 6)) . 'byte</div>';
            }
            if (empty($errors)) {
                $imagePath = 'images/users';
                $imageName = time() . '.' . $extension;
                $fullpath = "$imagePath/$imageName";
                //move image from temp => pre
                move_uploaded_file($_FILES['image']['tmp_name'], $fullpath);
                //update session
                $_SESSION['user']['image'] = $imageName;
            }
        }
        if (empty($error)) {
            $_SESSION['user']['name'] = $_POST['name'];
            $_SESSION['user']['email'] = $_POST['email'];
            $_SESSION['user']['gender'] = $_POST['gender'];
            $success = '<div class="alert alert-success p-1 my-1">Information updated successfuly</div>';
        }
    }
}
?>
<div class="container">
    <div class="row m-5">
        <div class="col-12 text-center h1">
            <?= $title ?>
        </div>
        <div class="col-4 offset-4">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group text-center">
                    <label for="image"><img src="images/users/<?= $_SESSION['user']['image'] ?>" alt="<?= $_SESSION['user']['name']; ?>" class="w-100 rounded-circle" style="cursor: pointer;"></label>
                    <input type="file" name="image" id="image" class="form-control d-none" placeholder="" aria-describedby="helpId">
                    <?php
                    if (isset($errors['image'])) {
                        foreach ($errors['image'] as $error) {
                            echo $error;
                        }
                    }
                    ?>
                </div>
                <div class="form-group mb-2">
                    <label for="Name">Name</label>
                    <input type="text" name="name" id="Name" value="<?= $_SESSION['user']['name'] ?>" class="form-control" placeholder="" aria-describedby="helpId">
                    <?php
                    if (isset($errors['name-required'])) {
                        echo $errors['name-required'];
                    }
                    ?>
                </div>
                <div class="form-group mb-2">
                    <label for="Email">Email</label>
                    <input type="email" name="email" id="Email" value="<?= $_SESSION['user']['email']; ?>" class="form-control" placeholder="" aria-describedby="helpId">
                    <?php
                    if (isset($errors['email-required'])) {
                        echo $errors['email-required'];
                    }
                    ?>
                </div>
                <div class="form-group my-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="male" id="flexRadioDefault1" <?= ($_SESSION['user']['gender'] == 'male') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="female" id="flexRadioDefault2" <?= ($_SESSION['user']['gender'] == 'female') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Female
                        </label>
                    </div>
                    <?php
                    if (isset($errors['gender-required'])) {
                        echo $errors['gender-required'];
                    }
                    ?>
                </div>


                <div class="form-group">
                    <button class="btn btn-primary mt-1"><?= $title; ?></button>
                </div>
                <?php
                if(isset($success)){
                    echo $success;
                }
                ?>
            </form>
        </div>
    </div>
</div>
<?php
include_once "layout/footer.php";
?>