<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dist/style.css">
    <title><?php echo isset($title) ? $title : "Title"; ?></title>
</head>

<body>
    <div class="container">
        <?php echo isset($message) ? "<div class=\"message_container\">$message</div>" : null; ?>
        <?php echo isset($errorMessage) ? "<div class=\"erreur_container\">$errorMessage</div>" : null; ?>
        <div class="navbar">
            <?php echo isset($navbarContent) ? $navbarContent : null; ?>
        </div>
        <div class="side_bar">
            <?php echo isset($sidebarContent) ? $sidebarContent : null; ?>
        </div>
        <div class="content">
            <?php echo isset($content) ? $content : null; ?>
        </div>
    </div>
    <script src="../dist/app-bundle.js"></script>
</body>

</html>