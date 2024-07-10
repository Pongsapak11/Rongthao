<!DOCTYPE html>
<html lang="en">

<head>
    <?= $template['head']; ?>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background-color: #474747;
        }

        main {
            flex: 1;
        }

        footer {
            color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <?= $template['menu']; ?>
    </nav>
    <main>
        <?= $template['content']; ?>
    </main>
    <footer class="bg-dark mt-5">
        <?= $template['footer']; ?>
    </footer>
</body>

</html>