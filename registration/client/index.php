<?php require("../server/handleFormSubmissions.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/output.css">
    <title>Registration</title>
</head>

<body>
    <div class="bg-gray-200/70 flex items-center justify-center h-screen">
        <article class="w-1/3 bg-white p-4 space-y-5">
            <h1 class="text-4xl font-semibold text-center">Registration</h1>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="space-y-7 py-5">
                <div class="grid grid-cols-2 gap-6">
                    <div class="relative">
                        <input type="text" name="fname" id="fname" placeholder="Full Name"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span
                            class="text-red-600 text-sm font-medium"><?= $registrationErr['fnameErr'] ?? ''; ?></span>
                    </div>
                    <div class="relative">
                        <input type="text" name="uname" id="uname" placeholder="Username"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span
                            class="text-red-600 text-sm font-medium"><?= $registrationErr['unameErr'] ?? ''; ?></span>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="relative">
                        <input type="text" name="email" id="email" placeholder="Email Address"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span
                            class="text-red-600 text-sm font-medium"><?= $registrationErr['emailErr'] ?? ''; ?></span>
                    </div>
                    <div class="relative">
                        <input type="text" name="phone" id="phone" placeholder="Phone Number"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span
                            class="text-red-600 text-sm font-medium"><?= $registrationErr['phoneErr'] ?? ''; ?></span>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="relative">
                        <input type="password" name="password" id="password" placeholder="Password"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span
                            class="text-red-600 text-sm font-medium"><?= $registrationErr['passwordErr'] ?? ''; ?></span>
                    </div>
                    <div class="relative">
                        <input type="password" name="confirmPassword" id="confirmPassword"
                            placeholder="Confirm Password"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span
                            class="text-red-600 text-sm font-medium"><?= $registrationErr['cnfrmPasswordErr'] ?? ''; ?></span>
                    </div>
                </div>

                <button name="register" id="register"
                    class="w-full px-4 py-2 bg-indigo-600 text-white text-lg font-medium rounded-md hover:bg-indigo-800">Register</button>
            </form>
            <footer>
                <p class="text-lg">Already a user? <a href="./login.php" class="text-indigo-600 font-medium">Login here</a></p>
            </footer>
        </article>
    </div>
</body>

</html>