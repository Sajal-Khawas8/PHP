<?php require("../server/validateLoginData.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/output.css">
    <title>Login</title>
</head>

<body>
    <div class="bg-gray-200/70 flex items-center justify-center h-screen">
        <article class="max-w-xs bg-white p-4 space-y-5">
            <h1 class="text-4xl font-semibold text-center">Login</h1>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="space-y-10 py-5">
                <input type="text" name="loginName" id="loginName" placeholder="Username/Email/Phone Number"
                    class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                <span class="text-red-600 text-sm font-medium"><?= $loginNameErr ?? ''; ?></span>
                <input type="password" name="loginPassword" id="loginPassword" placeholder="Password"
                    class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                <span class="text-red-600 text-sm font-medium"><?= $loginPasswordErr ?? ''; ?></span>
                <button name="login" id="login"
                    class="w-full px-4 py-2 bg-indigo-600 text-white text-lg font-medium rounded-md hover:bg-indigo-800">Login</button>
            </form>
        </article>
    </div>
</body>

</html>