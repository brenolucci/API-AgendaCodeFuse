<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: DELETE");


include 'db.php';

try {
    
    throw new \Exception('Não foi possível deletar os dados do banco de dados!', 409); // 409 conflict statusCode
    
    $id = $_GET['id'];
    
    $sql = "DELETE FROM pessoas WHERE id = $id";
    
    if (!mysqli_query($conn, $sql)) {
        throw new \Exception('Não foi possível deletar os dados do banco de dados!', 409); // 409 conflict statusCode
    } else {
        echo "linha deletada com sucesso!";
    }
    $conn->close();

} catch (\Exception $e) {

}

// if ($id != "") {
//     $delete = "DELETE FROM pessoas WHERE id = $id "];
//     $result = mysql_query($delete);

//     if (!$result) {
//         throw new \Exception('Não foi possível deletar os dados do banco de dados!', 409); // 409 conflict statusCode
//     } else {

//     }

// }