<?php
include 'db.php';

$nome = $email = $telefone = "";
$nome_err = $email_err = $telefone_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["nome"]))) {
        $nome_err = "Por favor, insira um nome.";
    } else {
        $nome = trim($_POST["nome"]);
    }

    if (empty(trim($_POST["email"]))) {
        $email_err = "Por favor, insira um email.";
    } else {
        $email = trim($_POST["email"]);
    }

    if (empty(trim($_POST["telefone"]))) {
        $telefone_err = "Por favor, insira um telefone.";
    } else {
        $telefone = trim($_POST["telefone"]);
    }

    if (empty($nome_err) && empty($email_err) && empty($telefone_err)) {
        $sql = "INSERT INTO contatos (nome, email, telefone) VALUES (?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $param_nome, $param_email, $param_telefone);

            $param_nome = $nome;
            $param_email = $email;
            $param_telefone = $telefone;

            if ($stmt->execute()) {
                header("location: index.php");
                exit();
            } else {
                echo "Algo deu errado. Por favor, tente novamente mais tarde.";
            }
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Adicionar Contato</title>
</head>

<body>
    <h1>Adicionar Novo Contato</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label>Nome</label>
            <input type="text" name="nome" value="<?php echo $nome; ?>">
            <span><?php echo $nome_err; ?></span>
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
            <span><?php echo $email_err; ?></span>
        </div>
        <div>
            <label>Telefone</label>
            <input type="text" name="telefone" value="<?php echo $telefone; ?>">
            <span><?php echo $telefone_err; ?></span>
        </div>
        <div>
            <input type="submit" value="Adicionar">
            <a href="index.php">Cancelar</a>
        </div>
    </form>
</body>

</html>