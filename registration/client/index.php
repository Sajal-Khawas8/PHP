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
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" class="space-y-7 py-5">
                <div class="grid grid-cols-2 gap-6">
                    <div class="relative">
                        <input type="text" name="name" id="name" placeholder="Full Name"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span class="text-red-600 text-sm font-medium"><?= $registrationErr['fnameErr'] ?? ''; ?></span>
                    </div>
                    <div class="relative">
                        <input type="text" name="username" id="username" placeholder="Username"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span class="text-red-600 text-sm font-medium"><?= $registrationErr['unameErr'] ?? ''; ?></span>
                    </div>
                </div>
                <div class="flex items-center gap-4 !mt-4 !-mb-2">
                    <p class="text-lg text-gray-500">Gender:</p>
                    <div class="flex items-center gap-2">
                        <input type="radio" name="gender" id="male" value="Male"
                            class="accent-indigo-600 w-3.5 h-3.5 cursor-pointer">
                        <label for="male" class="cursor-pointer">Male</label>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="radio" name="gender" id="female" value="Female"
                            class="accent-indigo-600 w-3.5 h-3.5 cursor-pointer">
                        <label for="female" class="cursor-pointer">Female</label>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="radio" name="gender" id="other" value="Other"
                            class="accent-indigo-600 w-3.5 h-3.5 cursor-pointer">
                        <label for="other" class="cursor-pointer">Other</label>
                    </div>
                    <span class="text-red-600 text-sm font-medium"><?= $registrationErr['genderErr'] ?? ''; ?></span>
                </div>
                <div class="">
                    <div class="flex items-center gap-2">
                        <label>Choose Profile Picture: </label>
                        <input type="file" name="profilePicture"
                            class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 hover:file:cursor-pointer">
                    </div>
                    <span class="text-red-600 text-sm font-medium"><?= $registrationErr['pictureErr'] ?? ''; ?></span>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="relative">
                        <input type="text" name="email" id="email" placeholder="Email Address"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span class="text-red-600 text-sm font-medium"><?= $registrationErr['emailErr'] ?? ''; ?></span>
                    </div>
                    <div class="relative">
                        <input type="text" name="phone" id="phone" placeholder="Phone Number"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span class="text-red-600 text-sm font-medium"><?= $registrationErr['phoneErr'] ?? ''; ?></span>
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
                <p class="text-lg">Already a user? <a href="./login.php" class="text-indigo-600 font-medium">Login
                        here</a></p>
            </footer>
        </article>
    </div>
</body>

</html>