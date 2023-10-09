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
        <section class="flex-1 px-6 py-2">
            <h1 class="text-4xl font-medium">Add New Clients</h1>
            <?php
            $fnameErr = $lnameErr = $companyErr = $departmentErr = $companyTypeErr = $websiteErr = $contactMethodErr = $emailErr = $phoneErr = $addressErr = '';
            $fname = $lname = $company = $department = $companyType = $website = $email = $phone = $address = '';
            $contactMethod = array();
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
                } elseif (!preg_match("/^[a-zA-Z ]*$/", $data)) {
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
                } elseif (!preg_match("/^[a-zA-Z-'&@() ]*$/", $data)) {
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

            if (isset($_POST['submit'])) {
                // $fnameErr = validateTextData($_POST['fname']);
                // $lnameErr = validateEmail($_POST['lname']);
                $fname = $_POST['fname'];
                if ($fnameErr = validateTextData($fname)) {
                    $fname = '';
                }
                $lname = $_POST['lname'];
                if ($lnameErr = validateTextData($lname)) {
                    $lname = '';
                }
                $company = $_POST['company'];
                if ($companyErr = validateCompanyName($company)) {
                    $company = '';
                }
                if (isset($_POST['department'])) {
                    $department = $_POST['department'];
                } else {
                    $departmentErr = "*Select department";
                }
                if (isset($_POST['companyType'])) {
                    $companyType = $_POST['companyType'];
                } else {
                    $isDataValid = false;
                    $companyTypeErr = "*Select company type";
                }
                $website = $_POST['website'];
                if ($websiteErr = validateURL($website)) {
                    $website = '';
                }
                if (isset($_POST['contactMethod'])) {
                    $contactMethod = $_POST['contactMethod'];
                } else {
                    $isDataValid = false;
                    $contactMethodErr = "*Select atleast one mode";
                }
                $email = $_POST['emailAddress'];
                if ($emailErr = validateEmail($email)) {
                    $email = '';
                }
                $phone = $_POST['phoneNumber'];
                if ($phoneErr = validatePhoneNumber($phone)) {
                    $phone = '';
                }
                $address = $_POST['address'];
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
                <div class="flex items-center gap-8 !mt-8 !-mb-4">
                    <p class="text-lg text-gray-500">Company Type:</p>
                    <div class="flex items-center gap-2">
                        <input type="radio" name="companyType" id="startup" value="Startup"
                            class="outline-indigo-600 w-4 h-4 cursor-pointer">
                        <label for="startup" class="cursor-pointer">Startup</label>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="radio" name="companyType" id="sme" value="SME"
                            class="outline-indigo-600 w-4 h-4 cursor-pointer">
                        <label for="sme" class="cursor-pointer">SME</label>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="radio" name="companyType" id="mnc" value="MNC"
                            class="outline-indigo-600 w-4 h-4 cursor-pointer">
                        <label for="mnc" class="cursor-pointer">MNC</label>
                    </div>
                    <span class="text-red-600 text-sm font-medium"><?php echo $companyTypeErr ?></span>
                </div>
                <div class="relative">
                    <input type="text" name="website" id="website" placeholder="Company's Website URL"
                        class="w-full px-4 py-2 border border-gray-600 rounded outline-indigo-600 placeholder:text-gray-500">
                    <span
                        class="absolute left-2 top-full text-red-600 text-sm font-medium"><?php echo $websiteErr ?></span>
                </div>
                <div class="flex items-center gap-8 !mt-8 !-mb-4">
                    <p class="text-lg text-gray-500">Modes of Contact:</p>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="contactMethod[]" id="phone" value="Phone"
                            class="outline-indigo-600 w-4 h-4 cursor-pointer">
                        <label for="phone" class="cursor-pointer">Phone</label>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="contactMethod[]" id="email" value="Email"
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
                if (isset($_POST['submit'])) {
                    $data = array(
                        'fname' => $fname,
                        'lname' => $lname,
                        'company' => $company,
                        'companyType' => $companyType,
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
                            <h3 class='text-2xl font-semibold flex justify-between'>
                                <span>{$value['fname']} {$value['lname']}
                                    <span class='text-base font-medium'>({$value['department']})</span>
                                </span>
                                <strong class='text-base font-medium flex items-center gap-2'>Client Id: <span
                                        class='text-red-600 bg-yellow-200 px-2 rounded'>" . $key + 1 . "</span></strong>
                            </h3>
                            <div class='flex items-center justify-between gap-20'>
                                <div class='flex-1 flex justify-between gap-16'>
                                    <h4 class='font-medium'>{$value['company']}</h4>
                                    <dl class='flex gap-2'>
                                        <dt class='font-medium'>Type:</dt>
                                        <dd>{$value['companyType']}</dd>
                                    </dl>
                                </div>
                                <dl class='flex-1 flex gap-2'>
                                    <dt class='font-medium'>Website:</dt>
                                    <dd><a href='#' class='text-blue-600'>{$value['website']}</a></dd>
                                </dl>
                            </div>
                        </header>
                        <dl class='space-y-2'>
                            <div class='flex items-center gap-4'>
                                <dt class='font-medium'>Preffered Modes of Contact:</dt>
                                <dd class='" . (in_array("Phone", $value['contactMethod']) ? "bg-green-300" : "bg-red-400") . " text-blue-700 px-6 rounded-full'>Phone</dd>
                                <dd class='" . (in_array("Email", $value['contactMethod']) ? "bg-green-300" : "bg-red-400") . " text-blue-700 px-6 rounded-full ml-2'>Email</dd>
                            </div>
                            <div class='grid grid-cols-2 gap-20'>
                                <div class='flex gap-2'>
                                    <dt class='font-medium'>Phone Number:</dt>
                                    <dd>
                                        <address class='not-italic'><a href='tel:+{$value['phone']}'>{$value['phone']}</a></address>
                                    </dd>
                                </div>
                                <div class='flex gap-2'>
                                    <dt class='font-medium'>Email Address:</dt>
                                    <dd>
                                        <address class='not-italic'><a href='mailto:{$value['email']}'>{$value['email']}</a></address>
                                    </dd>
                                </div>
                            </div>
                        </dl>
                        <dl class='flex gap-2'>
                            <dt class='font-medium'>Address:</dt>
                            <dd>{$value['address']}</dd>
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