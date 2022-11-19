<head>
    <title>View File</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body class="m-5">
    <a class="btn btn-primary" href="editFile.php" style="float:right">Edit File</a>
    <h1 class="text-center user-select-none">View File</h1>
    <form class="form-control" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <label class="user-select-none">Input File Name : </label>
        <input class="form-control mt-2" type="text" name="file_name" required>
        <button class="btn btn-primary mt-2" type="submit">Open</button>
    </form>
</body>

<?php
if (!empty($_POST)) {
    $fileName = $_POST["file_name"];

    if (file_exists($fileName)) {
        if (file_get_contents($fileName) == "")
            echo '<div class="alert alert-warning text-center p-3">File ' . $fileName . ' does not have content.</div>';
        else {
            echo "<div class='border rounded pt-3 p-2' style=''><div class='fs-4 text-center'><span class='user-select-none'>📄</span>" . $fileName . "</div><hr>";

            $file = fopen($fileName, "r");
            $lineNumber = 1;

            while (!feof($file)) {
                $line = fgets($file);

                if ($lineNumber < 10)
                    echo "<span class='user-select-none'>&ensp;</span>";

                if (ctype_space((string)$line) || $line == false)
                    echo "<span class='user-select-none'>" . $lineNumber . "&emsp;</span><br>";
                else
                    echo "<span class='user-select-none'>" . $lineNumber . "&emsp;</span><pre class='fs-6 fs' style='word-wrap:break-word; white-space:pre-wrap; display:inline;'>" . htmlspecialchars($line) . "</pre>";

                $lineNumber++;
            }

            fclose($file);
            echo "</div>";
        }
    } else
        echo '<div class="alert alert-danger mt-4 text-center user-select-none">File ' . $fileName . ' does not exist.</div>';
}
?>