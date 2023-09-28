<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/output.css">
    <title>Document</title>
</head>

<body>
    <main class="flex">
        <section class="flex-1 px-6 py-3">
            <h1 class="text-4xl font-medium">Add New Clients</h1>
            <?php
            $fnameErr = $lnameErr = $companyErr = $departmentErr = $websiteErr = $contactMethodErr = $emailErr = $phoneErr = $addressErr = '';
            $fname = $lname = $company = $department = $website = $contactMethod = $email = $phone = $address = '';
            $isDataValid = true;
            function cleanData(&$data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
            }

            function validateTextData(&$data)
            {
                global $isDataValid;
                cleanData($data);
                if (empty($data)) {
                    $isDataValid = false;
                    return "*This field is required";
                } elseif (strlen($data) < 3) {
                    $isDataValid = false;
                    return "*Field must contain more than 3 characters";
                } elseif (strlen($data) > 10) {
                    $isDataValid = false;
                    return "*Field must contain less than 10 characters";
                } elseif (!preg_match("/^[a-zA-Z ]$/", $data)) {
                    $isDataValid = false;
                    return "*Only letters and white space are allowed";
                }
            }

            function validateCompanyName(&$data)
            {
                global $isDataValid;
                cleanData($data);
                if (empty($data)) {
                    $isDataValid = false;
                    return "*This field is required";
                } elseif (strlen($data) < 3) {
                    $isDataValid = false;
                    return "*Field must contain more than 3 characters";
                } elseif (strlen($data) > 30) {
                    $isDataValid = false;
                    return "*Field must contain less than 30 characters";
                } elseif (!preg_match("/^[a-zA-Z-'&@() ]$/", $data)) {
                    $isDataValid = false;
                    return "*Only letters, white spaces and ('-', ''', '&', '@', '(', ')') are allowed";
                }
            }

            function validateEmail(&$data)
            {
                global $isDataValid;
                cleanData($data);
                if (empty($data)) {
                    $isDataValid = false;
                    return "*This field is required";
                } elseif (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
                    $isDataValid = false;
                    return "*Invalid Email Address";
                }
            }
            function validatePhoneNumber(&$data)
            {
                global $isDataValid;
                cleanData($data);
                if (empty($data)) {
                    $isDataValid = false;
                    return "*This field is required";
                    // } elseif (strlen($data) !== 10) {
                    //     return "*Invalid Phone Number";
                } elseif (!preg_match("/^[0-9]{10}$/", $data)) {
                    $isDataValid = false;
                    return "*Invalid Phone Number";
                }
            }

            function validateTextarea(&$data)
            {
                global $isDataValid;
                $data = trim($data);
                $data = htmlspecialchars($data);
                if (empty($data)) {
                    $isDataValid = false;
                    return "*This field is required";
                } elseif (strlen($data) < 10) {
                    $isDataValid = false;
                    return "*Address is too small";
                }
            }

            function validateURL(&$data)
            {
                global $isDataValid;
                $data = trim($data);
                if (empty($data)) {
                    $isDataValid = false;
                    return "*This field is required";
                } elseif (!filter_var($data, FILTER_VALIDATE_URL)) {
                    $isDataValid = false;
                    return "*Invalid URL";
                }
            }

            if (isset($_REQUEST['submit'])) {
                // $fnameErr = validateTextData($_REQUEST['fname']);
                // $lnameErr = validateEmail($_REQUEST['lname']);
                $fname = $_REQUEST['fname'];
                if ($fnameErr = validateTextData($fname)) {
                    $fname = '';
                }
                $lname = $_REQUEST['lname'];
                if ($lnameErr = validateTextData($lname)) {
                    $lname = '';
                }
                $company = $_REQUEST['company'];
                if ($companyErr = validateCompanyName($company)) {
                    $company = '';
                }
                if (isset($_REQUEST['department'])) {
                    $department = $_REQUEST['department'];
                } else {
                    $departmentErr = "Select department";
                }
                $website = $_REQUEST['website'];
                if ($websiteErr = validateURL($website)) {
                    $website = '';
                }
                if (isset($_REQUEST['contactMethod'])) {
                    $contactMethod = $_REQUEST['contactMethod'];
                } else {
                    $contactMethodErr = "Select mode of contact";
                }
                $email = $_REQUEST['emailAddress'];
                if ($emailErr = validateEmail($email)) {
                    $email = '';
                }
                $phone = $_REQUEST['phoneNumber'];
                if ($phoneErr = validatePhoneNumber($phone)) {
                    $phone = '';
                }
                $address = $_REQUEST['address'];
                if ($addressErr = validateTextarea($address)) {
                    $address = '';
                }
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="space-y-10 py-5">
                <div class="grid grid-cols-2 gap-6">
                    <div class="relative">
                        <input type="text" name="fname" id="fname" placeholder="First Name"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span
                            class="absolute left-2 top-full text-red-600 text-sm font-medium"><?php echo $fnameErr ?></span>
                    </div>
                    <div class="relative">
                        <input type="text" name="lname" id="lname" placeholder="Last Name"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span
                            class="absolute left-2 top-full text-red-600 text-sm font-medium"><?php echo $lnameErr ?></span>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-2 relative">
                        <input type="text" name="company" id="company" placeholder="Company"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span
                            class="absolute left-2 top-full text-red-600 text-sm font-medium"><?php echo $companyErr ?></span>
                    </div>
                    <div class="relative">
                        <select name="department" id="department"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500 cursor-pointer">
                            <option value="0" disabled selected class="hidden">Department</option>
                            <option value="Sales Department">Sales Department</option>
                            <option value="HR Department">HR Department</option>
                            <option value="Managing Department">Managing Department</option>
                        </select>
                        <span
                            class="absolute left-2 top-full text-red-600 text-sm font-medium"><?php echo $departmentErr ?></span>
                    </div>
                </div>
                <div class="relative">
                    <input type="text" name="website" id="website" placeholder="Company's Website URL"
                        class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                    <span
                        class="absolute left-2 top-full text-red-600 text-sm font-medium"><?php echo $websiteErr ?></span>
                </div>
                <div class="flex items-center gap-8">
                    <p class="text-lg text-gray-500">Preferred Mode of Contact:</p>
                    <div class="flex items-center gap-2">
                        <input type="radio" name="contactMethod" id="phone" value="Phone"
                            class="outline-indigo-600 w-4 h-4 cursor-pointer">
                        <label for="phone" class="cursor-pointer">Phone</label>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="radio" name="contactMethod" id="email" value="Email"
                            class="outline-indigo-600 w-4 h-4 cursor-pointer">
                        <label for="email" class="cursor-pointer">Email</label>
                    </div>
                    <span class="text-red-600 text-sm font-medium"><?php echo $contactMethodErr ?></span>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="relative">
                        <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Phone Number"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span
                            class="absolute left-2 top-full text-red-600 text-sm font-medium"><?php echo $phoneErr ?></span>
                    </div>
                    <div class="relative">
                        <input type="text" name="emailAddress" id="emailAddress" placeholder="Email Address"
                            class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                        <span
                            class="absolute left-2 top-full text-red-600 text-sm font-medium"><?php echo $emailErr ?></span>
                    </div>
                </div>
                <div class="relative">
                    <textarea name="address" id="address" placeholder="Address" rows="5"
                        class="w-full resize-none px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500"></textarea>
                    <span
                        class="absolute left-2 top-full text-red-600 text-sm font-medium"><?php echo $addressErr ?></span>
                </div>

                <button name="submit" id="submit"
                    class="w-full px-4 py-2 bg-indigo-600 text-white text-lg font-medium rounded-md hover:bg-indigo-800">Submit</button>
            </form>
        </section>
        <section class="flex-1 bg-gray-200 px-6 py-4">
            <h2 class="text-2xl font-medium">Client's Details</h2>
            <div class="space-y-1 mt-10 h-[calc(100vh-106px)] overflow-y-auto">
                <?php
                if (isset($_REQUEST['submit'])) {
                    $data = array(
                        'fname' => $fname,
                        'lname' => $lname,
                        'company' => $company,
                        'department' => $department,
                        'website' => $website,
                        'contactMethod' => $contactMethod,
                        'phone' => $phone,
                        'email' => $email,
                        'address' => $address
                    );
                    if ($isDataValid) {
                        isset($_SESSION['formData']) ? array_push($_SESSION['formData'], $data) : $_SESSION['formData'] = array($data);
                    }
                }
                if (isset($_SESSION['formData'])) {

                    foreach ($_SESSION['formData'] as $key => $value) {
                        echo "<div class='bg-white px-4 py-2 rounded-md space-y-2'>
                    <header class='space-y-1'>
                        <h3 class='text-xl font-semibold'>{$value["fname"]} {$value["lname"]}</h3>
                        <div class='flex gap-8'>
                            <h4>{$value["company"]}</h4>
                            <p>{$value["department"]}</p>
                        </div>
                        <dl class='flex gap-2'>
                                <dt>Company Website:</dt>
                                <dd><a href='#' class='text-blue-600'>{$value["website"]}</a></dd>
                        </dl>
                    </header>
                    <dl class='space-y-1'>
                        <div class='flex gap-2'>
                            <dt>Preffered Mode of Contact:</dt>
                            <dd class='bg-green-300 text-blue-800 px-4 rounded-full'>{$value["contactMethod"]}</dd>
                        </div>
                        <div class='flex gap-12'>
                            <div class='flex gap-2'>
                                <dt>Phone Number:</dt>
                                <dd>
                                    <address class='not-italic'><a href='tel:+{$value["phone"]}'>{$value["phone"]}</a></address>
                                </dd>
                            </div>
                            <div class='flex gap-2'>
                                <dt>Email Address:</dt>
                                <dd>
                                    <address class='not-italic'><a href='mailto:{$value["email"]}'>{$value["email"]}</a></address>
                                </dd>
                            </div>
                        </div>
                    </dl>
                    <dl class='space-y-1'>
                        <dt>Address:</dt>
                        <dd>{$value["address"]}</dd>
                    </dl>
                </div>";
                    }
                }

                // session_destroy();
                ?>
            </div>
        </section>
    </main>
</body>

</html>