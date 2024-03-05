<?php include("db.php"); ?>

<?php include("includes/header.php") ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4">

            <?php
            if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php session_unset(); //Vacia la session, para que el mensaje se vaya cuando actualice la pagina o cuando lo quite
            } ?>
            <div class="card card-body">
                <form action="save_task.php" method="POST"> <!-- A travez del method POST envia los datos del form al save_task.php -->
                    <div class="form-group mb-3">
                        <input type="text" name="title" class="form-control" placeholder="Task Title" autofocus>
                    </div>

                    <div class="form-group mb-3">
                        <textarea name="description" rows="2" class="form-control" placeholder="Task Description"></textarea>
                    </div>

                    <input type="submit" class="btn btn-success btn-block" name="save_task" value="Save Task">
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $query = "SELECT * FROM task"; // Query que selecciona todo de task
                    $result_task = mysqli_query($conn, $query); // Mandamos la query que nos devuelve $result_task object
                    while ($row = mysqli_fetch_array($result_task)) { ?> <!-- Me convierte el $result_task en un array y lo almaceno en $row -->
                        <!-- Recorremos con el while el array row contiene-->
                        <tr>
                            <td><?php echo $row['title'];  ?></td>
                            <td><?php echo $row['description'];  ?></td>
                            <td><?php echo $row['created_at'];  ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary"> <!-- Le paso al href el parametro de consulta id, el cual viene de $row  -->
                                    <i class="fa-solid fa-marker"></i>
                                </a>

                                <a href="delete_task.php?id=<?php echo $row['id'] ?>" class="btn btn-danger"> <!-- Le paso al href el parametro de consulta id, el cual viene de $row  -->
                                    <i class="fa-regular fa-trash-can"></i>
                                </a>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>