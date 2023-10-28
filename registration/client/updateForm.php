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
                    <div class="">
                        <input type="text" name="name" id="name" placeholder="Full Name" value="<?= $_GET['name'] ?? '' ?>"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span
                            class="text-red-600 text-sm font-medium"><?= $updationErr['fnameErr'] ?? ''; ?></span>
                    </div>
                    <div class="">
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
                <div class="">
                    <div class="flex items-center gap-2">
                        <label>Choose Profile Picture: </label>
                        <input type="file" name="profilePicture"
                            class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 hover:file:cursor-pointer">
                        <button type="button" name="viewPicture" id="viewPicture">
                        <svg class="w-7 h-7 text-violet-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M.2 10a11 11 0 0 1 19.6 0A11 11 0 0 1 .2 10zm9.8 4a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0-2a2 2 0 1 1 0-4 2 2 0 0 1 0 4z">
                            </path>
                            <title>View Uploaded Image</title>
                        </svg>
                        </button>
                        <section id="imageModal" class="hidden absolute inset-0 bg-gray-300/70 items-center justify-center">
                            <div class="relative w-96 bg-white py-4 space-y-2">
                                <h3 class="text-xl font-semibold text-center">Uploaded Image</h3>
                                <button type="button" id="closeImageModal" class="absolute top-0.5 right-4">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="-6 -6 24 24" fill="currentColor">
                                        <path
                                            d="m7.314 5.9 3.535-3.536A1 1 0 1 0 9.435.95L5.899 4.485 2.364.95A1 1 0 1 0 .95 2.364l3.535 3.535L.95 9.435a1 1 0 1 0 1.414 1.414l3.535-3.535 3.536 3.535a1 1 0 1 0 1.414-1.414L7.314 5.899z">
                                        </path>
                                    </svg>
                                </button>
                                <figure class="mx-auto">
                                    <img src="<?= "../server/uploads/images/" . $_GET['image'] ?>" alt="" class="w-52 h-52 mx-auto">
                                    <figcaption class="text-lg font-medium text-center"><?= $_GET['imageName']; ?></figcaption>
                                </figure>
                            </div>
                        </section>
                    </div>
                    <span class="text-red-600 text-sm font-medium"><?= $updationErr['pictureErr'] ?? ''; ?></span>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="">
                        <input type="text" name="email" id="email" placeholder="Email Address" value="<?= $_GET['email'] ?? '' ?>"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span
                            class="text-red-600 text-sm font-medium"><?= $updationErr['emailErr'] ?? ''; ?></span>
                    </div>
                    <div class="">
                        <input type="text" name="phone" id="phone" placeholder="Phone Number" value="<?= $_GET['phone'] ?? '' ?>"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span
                            class="text-red-600 text-sm font-medium"><?= $updationErr['phoneErr'] ?? ''; ?></span>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="">
                        <input type="password" name="oldPassword" id="oldPassword" placeholder="Old Password"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span
                            class="text-red-600 text-sm font-medium"><?= $updationErr['oldPasswordErr'] ?? ''; ?></span>
                    </div>
                    <div class="">
                        <input type="password" name="password" id="newPassword"
                            placeholder="New Password"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span
                            class="text-red-600 text-sm font-medium"><?= $updationErr['passwordErr'] ?? ''; ?></span>
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
    <script>
        document.getElementById("viewPicture").addEventListener('click', ()=>{
            document.getElementById("imageModal").classList.add('!flex');
        })
        document.getElementById("closeImageModal").addEventListener('click', ()=>{
            document.getElementById("imageModal").classList.remove('!flex');
        })
    </script>
</body>

</html>