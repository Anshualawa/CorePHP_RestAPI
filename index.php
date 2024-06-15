<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REST API</title>
    <link rel="stylesheet" href=<?php echo './assets/tailwind.css' ?>>
</head>

<body>
    <?php
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $requestURL = explode('/', trim($_SERVER['REQUEST_URI'], '/')); ?>

    <section class="w-4/5 h-dvh p-5 m-auto border">
        <div class="w-full">
            <div class="w-full p-5 text-center">
                <h1 class="text-3xl font-bold">Welcome to My REST API</h1>
                <p class="text-lg">Choose an option below to proceed:</p>
            </div>
            <div class="flex justify-between items-center gap-5">
                <a href="http://localhost/PHP_Practice/REST/users.php"
                    class="w-full text-center userLink p-5 border shadow rounded-md hover:bg-blue-100 hover:border-blue-200">
                    <div>
                        <h1 class="font-bold uppercase">User</h1>
                    </div>
                </a>
                <a href="http://localhost/PHP_Practice/REST/product.php"
                    class="w-full text-center productLink p-5 border shadow rounded-md hover:bg-blue-100 hover:border-blue-200">
                    <div>
                        <h1 class="font-bold uppercase">Product</h1>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <script src="<?php echo './assets/jquery.js' ?>"></script>
</body>

</html>