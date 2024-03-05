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

    $query = "UPDATE task SET title='$title', description='$description' WHERE id=$id";
    $result = mysqli_query($conn, $query);

    $_SESSION['message'] = "Task Updated Successfully";
    $_SESSION['message_type'] = "info";

    header("Location: index.php");
}
?>

<?php
include("includes/header.php")
?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
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