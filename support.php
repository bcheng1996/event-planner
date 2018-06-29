<?php
function generatePage($body, $title)
{
    $page = <<<EOPAGE
<!doctype html>
<html>
    <head>
    <title>Challenge 3</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatiable" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="mainstyle.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Armata" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="process.js"></script>
    </head>

    <body>
            $body

    </body>
</html>
EOPAGE;

    return $page;
}
