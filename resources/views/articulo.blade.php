<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <title>Articulo</title>
</head>
<body>
    <div id="app">
        <articulo :sku="'{{ $_GET['sku'] }}'"></articulo>
    </div>

    <script src="{{ mix('js/app.js')}}"> </script>
</body>
</html>

