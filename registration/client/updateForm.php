<?php require("../server/handleFormSubmissions.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/output.css">
    <title>Update Form</title>
</head>

<body>
    <div class="bg-gray-200/70 flex items-center justify-center h-screen">
        <article class="w-1/3 bg-white p-4 space-y-5">
            <h1 class="text-4xl font-semibold text-center">Update Form</h1>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="space-y-7 py-5">
                <div class="grid grid-cols-2 gap-6">
                    <div class="relative">
                        <input type="text" name="name" id="name" placeholder="Full Name" value="<?= $_GET['name'] ?? '' ?>"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span
                            class="text-red-600 text-sm font-medium"><?= $updationErr['fnameErr'] ?? ''; ?></span>
                    </div>
                    <div class="relative">
                        <input type="text" name="username" id="username" placeholder="Username" value="<?= $_GET['uname'] ?? '' ?>"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span
                            class="text-red-600 text-sm font-medium"><?= $updationErr['unameErr'] ?? ''; ?></span>
                    </div>
                </div>
                <div class="flex items-center gap-4 !mt-4 !-mb-2">
                    <p class="text-lg text-gray-500">Gender:</p>
                    <div class="flex items-center gap-2">
                        <input type="radio" name="gender" id="male" value="Male" <?= ($_GET['gender'] ?? '') === 'Male' ? 'checked' : ''; ?>
                            class="accent-indigo-600 w-3.5 h-3.5 cursor-pointer">
                        <label for="male" class="cursor-pointer">Male</label>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="radio" name="gender" id="female" value="Female" <?= ($_GET['gender'] ?? '') === 'Female' ? 'checked' : ''; ?>
                            class="accent-indigo-600 w-3.5 h-3.5 cursor-pointer">
                        <label for="female" class="cursor-pointer">Female</label>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="radio" name="gender" id="other" value="Other" <?= ($_GET['gender'] ?? '') === 'Other' ? 'checked' : ''; ?>
                            class="accent-indigo-600 w-3.5 h-3.5 cursor-pointer">
                        <label for="other" class="cursor-pointer">Other</label>
                    </div>
                    <span class="text-red-600 text-sm font-medium"><?= $updationErr['genderErr'] ?? ''; ?></span>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="relative">
                        <input type="text" name="email" id="email" placeholder="Email Address" value="<?= $_GET['email'] ?? '' ?>"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span
                            class="text-red-600 text-sm font-medium"><?= $updationErr['emailErr'] ?? ''; ?></span>
                    </div>
                    <div class="relative">
                        <input type="text" name="phone" id="phone" placeholder="Phone Number" value="<?= $_GET['phone'] ?? '' ?>"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span
                            class="text-red-600 text-sm font-medium"><?= $updationErr['phoneErr'] ?? ''; ?></span>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="relative">
                        <input type="password" name="password" id="password" placeholder="Password"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span
                            class="text-red-600 text-sm font-medium"><?= $updationErr['passwordErr'] ?? ''; ?></span>
                    </div>
                    <div class="relative">
                        <input type="password" name="confirmPassword" id="confirmPassword"
                            placeholder="Confirm Password"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span
                            class="text-red-600 text-sm font-medium"><?= $updationErr['cnfrmPasswordErr'] ?? ''; ?></span>
                    </div>
                </div>

                <button name="update" id="update"
                    class="w-full px-4 py-2 bg-indigo-600 text-white text-lg font-medium rounded-md hover:bg-indigo-800">Update</button>
            </form>
            <footer>
                <p class="text-lg">Don't want to update? <a href="./dashboard.php" class="text-indigo-600 font-medium">Go back to Dashboard</a></p>
            </footer>
        </article>
    </div>
</body>

</html>