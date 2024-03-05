<?php

include("db.php"); // Incluyo la base de datos

if (isset($_POST['save_task'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    if (strlen($title) > 0 && strlen($description) > 0) {
        $query = "INSERT INTO task(title,description) VALUES ('$title', '$description')"; // Esta es la query que se va a enviar
        $result = mysqli_query($conn, $query); // Se envia la query a la base de datos

        if (!$result) {
            die("Query Failed");
        }

        $_SESSION['message'] = 'Task Saved succesfully';
        $_SESSION['message_type'] = 'success';

        header("Location:index.php");
    } else {
        $_SESSION['message'] = 'You Must Write Something';
        $_SESSION['message_type'] = 'danger';
        header("Location:index.php");
    }
}
