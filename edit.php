<?php

include("db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM task WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) { // Si el $result (el objeto tiene la propiedad"num_rows"), contiene al menos 1 "num_rows"

        $row = mysqli_fetch_array($result); // Me convierte el $result en un array y lo almaceno en $row
        $title = $row['title'];
        $description = $row['description'];
    }
}

if (isset($_POST['update'])) {
    $id = $id;
    $title = $_POST['title'];
    $description = $_POST['description'];

    if (strlen($title) > 0 && strlen($description) > 0) {
        $query = "UPDATE task SET title='$title', description='$description' WHERE id=$id";
        $result = mysqli_query($conn, $query);

        $_SESSION['message'] = "Task Updated Successfully";
        $_SESSION['message_type'] = "info";

        header("Location: index.php");
    } else {
        $_SESSION['messageEdit'] = 'You Must Write Something';
        $_SESSION['message_typeEdit'] = 'danger';
    }
}
?>

<?php
include("includes/header.php")
?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <?php
            if (isset($_SESSION['messageEdit'])) { ?>
                <div class="alert alert-<?= $_SESSION['message_typeEdit'] ?> alert-dismissible fade show " role="alert">
                    <?= $_SESSION['messageEdit'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php session_unset(); //Vacia la session, para que el mensaje se vaya cuando actualice la pagina o cuando lo quite
            } ?>
            <div class="card card-body">
                <form action="edit.php?id=<?php echo $id ?>" method="POST">
                    <div class="form-group mb-2">
                        <input type="text" name="title" value="<?php echo $title; ?>" class="form-control" placeholder="Update Title">
                    </div>

                    <div class="form-group mb-3">
                        <textarea name="description" rows="2" class="form-control" placeholder="Update Description"><?php echo $description; ?></textarea>
                    </div>

                    <button class="btn btn-success" name="update">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
include("includes/footer.php")
?>