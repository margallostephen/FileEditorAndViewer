<?php
$btnText = "Find";
$fileDiv = "block";
$contentDiv = $message = "";

if (isset($_POST['file_name']) && file_exists($_POST['file_name'])) {
    $btnText = "Save";
    $fileDiv = "none";
    $contentDiv = '<div>
        <label>Edit File Content:</label>
        <textarea class="form-control mt-2" style="height: 85%; word-break: break-word; resize: none;" name="file_content">';

    if (isset($_POST['file_content'])) {
        $fileName = $_POST['file_name'];
        $newContent = $_POST['file_content'];

        $file = fopen($fileName, "w");
        fwrite($file, $newContent);
        fclose($file);

        $message = '<div class="alert alert-success mt-4 text-center">Successfully edited the file ' . $fileName . '</div>';
        $btnText = "Find";
        $fileDiv = "block";
        $contentDiv = "";
        unset($_POST);
    }
}

if (isset($_POST['file_name']) && !file_exists($_POST['file_name']))
    $message = '<div class="alert alert-danger mt-4 text-center user-select-none">File ' . $_POST['file_name'] . ' does not exist.</div>';
?>

<head>
    <title>Edit File</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body class="m-5">
    <a class="btn btn-primary" href="viewFile.php" style="float:right">View File</a>
    <h1 class="text-center user-select-none">Edit File</h1>
    <form class="form-control" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div style="display: <?php echo $fileDiv ?>;">
            <label class="user-select-none">Input File Name:</label>
            <input class="form-control mt-2" type="text" name="file_name" required value="<?php if (isset($_POST['file_name']) && file_exists($_POST['file_name'])) echo $_POST['file_name']; ?>">
        </div>
        <?php
        echo $contentDiv;

        if (isset($_POST["file_name"]) && file_exists($_POST["file_name"]))
            echo file_get_contents($_POST["file_name"]);

        if (!empty($contentDiv))
            echo "</textarea></div>";
        ?>
        <button class="btn btn-primary mt-2" type="submit"><?php echo $btnText ?></button>
    </form>
    <?php echo $message ?>
</body>