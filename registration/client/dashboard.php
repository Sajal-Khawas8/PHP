<?php
require("../server/handleFormSubmissions.php");
if (!isset($_SESSION['loginName'])) {
    header("Location: ./login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="This is the dashboard">
    <meta name="keywords" content="Admin Panel, html, css">
    <meta name="author" content="Sajal">
    <link rel="stylesheet" href="../../css/output.css">
    <title>Dashboard</title>
</head>

<body class="flex gap-0 h-screen font-openSans">
    <aside class="w-64 h-full p-3 hidden lg:block">
        <header class="mx-auto my-3 w-fit">
            <svg width="130" height="30" xmlns="http://www.w3.org/2000/svg">
                <text font-weight="bold" fill="black" dominant-baseline="hanging" font-size="28px">
                    listerPros
                </text>
            </svg>
        </header>
        <nav>
            <ul>
                <li class="flex items-center text-sm leading-9 relative">
                    <svg class="w-5 h-5 mx-2.5 my-0" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="currentColor">
                        <path d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"></path>
                    </svg>
                    <span>Home</span>
                    <a href="#" class="absolute inset-0"></a>
                </li>
                <li class="flex items-center text-sm leading-9">
                    <h3 class="text-[#0f91ee] font-semibold text-sm leading-10">General</h3>
                </li>
                <li class="flex items-center text-sm leading-9 relative">
                    <svg class="w-5 h-5 mx-2.5 my-0" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="currentColor">
                        <g>
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path
                                d="M12 11a5 5 0 0 1 5 5v6H7v-6a5 5 0 0 1 5-5zm-6.712 3.006a6.983 6.983 0 0 0-.28 1.65L5 16v6H2v-4.5a3.5 3.5 0 0 1 3.119-3.48l.17-.014zm13.424 0A3.501 3.501 0 0 1 22 17.5V22h-3v-6c0-.693-.1-1.362-.288-1.994zM5.5 8a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zm13 0a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zM12 2a4 4 0 1 1 0 8 4 4 0 0 1 0-8z">
                            </path>
                        </g>
                    </svg>
                    <span>Team Members</span>
                    <a href="#" class="absolute inset-0"></a>
                </li>
                <li class="flex items-center text-sm leading-9 relative">
                    <svg class="w-5 h-5 mx-2.5 my-0" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M14.363 5.22a4.22 4.22 0 11-8.439 0 4.22 4.22 0 018.439 0zM2.67 14.469c1.385-1.09 4.141-2.853 7.474-2.853 3.332 0 6.089 1.764 7.474 2.853.618.486.81 1.308.567 2.056l-.333 1.02A2.11 2.11 0 0115.846 19H4.441a2.11 2.11 0 01-2.005-1.455l-.333-1.02c-.245-.748-.052-1.57.567-2.056z"
                            fill="currentColor"></path>
                    </svg>
                    <span>Customers</span>
                    <a href="#" class="absolute inset-0"></a>
                </li>
                <li class="flex items-center text-sm leading-9 relative">
                    <svg class="w-5 h-5 mx-2.5 my-0" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="currentColor">
                        <path id="path6"
                            d="M12,1,3,5v6c0,5.55,3.84,10.74,9,12,5.16-1.26,9-6.45,9-12V5Zm0,3.9a3,3,0,1,1-3,3A3,3,0,0,1,12,4.9Zm0,7.9c2,0,6,1.09,6,3.08a7.2,7.2,0,0,1-12,0C6,13.89,10,12.8,12,12.8Z">
                        </path>
                    </svg>
                    <span>Admins</span>
                    <a href="#" class="absolute inset-0"></a>
                </li>
                <li class="flex items-center text-sm leading-9 relative">
                    <svg class="w-5 h-5 mx-2.5 my-0" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M19 3H5c-1.1 0-2 .9-2 2v7c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM5 10h3.13c.21.78.67 1.47 1.27 2H5v-2zm14 2h-4.4c.6-.53 1.06-1.22 1.27-2H19v2zm0-4h-5v1c0 1.07-.93 2-2 2s-2-.93-2-2V8H5V5h14v3zm-2 7h-3v1c0 .47-.19.9-.48 1.25-.37.45-.92.75-1.52.75s-1.15-.3-1.52-.75c-.29-.35-.48-.78-.48-1.25v-1H3v4c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-4h-4zM5 17h3.13c.02.09.06.17.09.25.24.68.65 1.28 1.18 1.75H5v-2zm14 2h-4.4c.54-.47.95-1.07 1.18-1.75.03-.08.07-.16.09-.25H19v2z">
                        </path>
                    </svg>
                    <span>All Packages</span>
                    <svg class="w-8 h-8 relative translate-x-1 ml-auto" height="24" width="24"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <g>
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path d="M12 15l-4.243-4.243 1.415-1.414L12 12.172l2.828-2.829 1.415 1.414z"></path>
                        </g>
                    </svg>
                    <a href="#" class="absolute inset-0"></a>
                </li>
                <li class="flex items-center text-sm leading-9 relative">
                    <svg class="w-5 h-5 mx-2.5 my-0" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
                        enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="currentColor">
                        <rect fill="none" height="24" width="24"></rect>
                        <path
                            d="M12,10L12,10c-0.55,0-1-0.45-1-1v0c0-0.55,0.45-1,1-1h0c0.55,0,1,0.45,1,1v0C13,9.55,12.55,10,12,10z M12,6L12,6 c-0.55,0-1-0.45-1-1V2c0-0.55,0.45-1,1-1h0c0.55,0,1,0.45,1,1v3C13,5.55,12.55,6,12,6z M7,18c-1.1,0-1.99,0.9-1.99,2S5.9,22,7,22 s2-0.9,2-2S8.1,18,7,18z M17,18c-1.1,0-1.99,0.9-1.99,2s0.89,2,1.99,2s2-0.9,2-2S18.1,18,17,18z M8.1,13h7.45 c0.75,0,1.41-0.41,1.75-1.03l3.24-6.14c0.25-0.48,0.08-1.08-0.4-1.34v0c-0.49-0.27-1.1-0.08-1.36,0.41L15.55,11H8.53L4.27,2H2 C1.45,2,1,2.45,1,3v0c0,0.55,0.45,1,1,1h1l3.6,7.59l-1.35,2.44C4.52,15.37,5.48,17,7,17h11c0.55,0,1-0.45,1-1v0c0-0.55-0.45-1-1-1H7 L8.1,13z">
                        </path>
                    </svg>
                    <span>Products</span>
                    <a href="#" class="absolute inset-0"></a>
                </li>
                <li class="flex items-center text-sm leading-9 relative">
                    <svg class="w-5 h-5 mx-2.5 my-0" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M3.735 5.507A3 3 0 0 1 6.695 3h6.61a3 3 0 0 1 2.96 2.507L17 10v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-5l.735-4.493ZM6.695 5a1 1 0 0 0-.987.836L5 10v1h1.394a3 3 0 0 1 1.665.504l.832.555a2 2 0 0 0 2.218 0l.832-.555A3 3 0 0 1 13.607 11H15v-1l-.708-4.164A1 1 0 0 0 13.306 5H6.694Z"
                            fill="currentColor"></path>
                    </svg>
                    <span>Orders</span>
                    <span
                        class="ml-auto bg-yellow-300 rounded-md text-sm leading-6 font-bold text-red-600 text-center px-2 py-0.5">5</span>
                    <a href="#" class="absolute inset-0"></a>
                </li>
                <li class="flex items-center text-sm leading-9 relative">
                    <svg class="w-5 h-5 mx-2.5 my-0" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
                        width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zm5.402 9.746c.625 0 1.184-.484 1.184-1.18 0-.832-.527-1.23-1.16-1.23-.586 0-1.168.387-1.168 1.21 0 .817.543 1.2 1.144 1.2z">
                        </path>
                        <path
                            d="M16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-6.664-1.21c-1.11 0-1.656-.767-1.703-1.407h.683c.043.37.387.82 1.051.82.844 0 1.301-.848 1.305-2.164h-.027c-.153.414-.637.79-1.383.79-.852 0-1.676-.61-1.676-1.77 0-1.137.871-1.809 1.797-1.809 1.172 0 1.953.734 1.953 2.668 0 1.805-.742 2.871-2 2.871zm-2.89-5.435v5.332H5.77V8.079h-.012c-.29.156-.883.52-1.258.777V8.16a12.6 12.6 0 0 1 1.313-.805h.632z">
                        </path>
                    </svg>
                    <span>Calender</span>
                    <a href="#" class="absolute inset-0"></a>
                </li>
                <li class="flex items-center text-sm leading-9 relative">
                    <svg class="w-5 h-5 mx-2.5 my-0" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="currentColor">
                        <rect x="6" y="7" width="8" height="2"></rect>
                        <rect x="6" y="11" width="12" height="2"></rect>
                        <rect x="6" y="15" width="2.99" height="2"></rect>
                        <path d="M14,3,11,0V2H4A2,2,0,0,0,2,4V20a2,2,0,0,0,2,2H8V20H4V4h7V6Z"></path>
                        <path d="M10,21l3,3V22h7a2,2,0,0,0,2-2V4a2,2,0,0,0-2-2H16V4h4V20H13V18Z"></path>
                    </svg>
                    <span>Concierge Management</span>
                    <span
                        class="ml-auto bg-yellow-300 rounded-md text-sm leading-6 font-bold text-red-600 text-center px-2 py-0.5">0</span>
                    <a href="#" class="absolute inset-0"></a>
                </li>
                <li class="flex items-center text-sm leading-9 relative">
                    <svg class="w-5 h-5 mx-2.5 my-0" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 32 32" fill="currentColor">
                        <defs></defs>
                        <title>product</title>
                        <rect x="8" y="18" width="6" height="2"></rect>
                        <rect x="8" y="22" width="10" height="2"></rect>
                        <path
                            d="M26,4H6A2.0025,2.0025,0,0,0,4,6V26a2.0025,2.0025,0,0,0,2,2H26a2.0025,2.0025,0,0,0,2-2V6A2.0025,2.0025,0,0,0,26,4ZM18,6v4H14V6ZM6,26V6h6v6h8V6h6l.0012,20Z">
                        </path>
                        <rect id="_Transparent_Rectangle_" data-name="<Transparent Rectangle>" class="cls-1" width="32"
                            height="32" style="fill:none"></rect>
                    </svg>
                    <span>Orders before April 1, 2023</span>
                    <a href="#" class="absolute inset-0"></a>
                </li>
                <li class="flex items-center text-sm leading-9">
                    <h3 class="text-[#0f91ee] font-semibold text-sm leading-10">Others</h3>
                </li>
                <li class="flex items-center text-sm leading-9 relative">
                    <svg class="w-5 h-5 mx-2.5 my-0" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path
                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                        </path>
                    </svg>
                    <span>Settings</span>
                    <svg class="w-8 h-8 relative translate-x-1 ml-auto" height="24" width="24"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <g>
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path d="M12 15l-4.243-4.243 1.415-1.414L12 12.172l2.828-2.829 1.415 1.414z"></path>
                        </g>
                    </svg>
                    <a href="#" class="absolute inset-0"></a>
                </li>
                <li class="flex items-center text-sm leading-9 relative">
                    <svg class="w-5 h-5 mx-2.5 my-0" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="currentColor">
                        <g>
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path
                                d="M20 22H4a1 1 0 0 1-1-1V8h18v13a1 1 0 0 1-1 1zm1-16H3V3a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v3zM7 11v4h4v-4H7zm0 6v2h10v-2H7zm6-5v2h4v-2h-4z">
                            </path>
                        </g>
                    </svg>
                    <span>Pages</span>
                    <a href="#" class="absolute inset-0"></a>
                </li>
                <li class="flex items-center text-sm leading-9 relative">
                    <svg class="w-5 h-5 mx-2.5 my-0" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
                        width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM7.194 6.766a1.688 1.688 0 0 0-.227-.272 1.467 1.467 0 0 0-.469-.324l-.008-.004A1.785 1.785 0 0 0 5.734 6C4.776 6 4 6.746 4 7.667c0 .92.776 1.666 1.734 1.666.343 0 .662-.095.931-.26-.137.389-.39.804-.81 1.22a.405.405 0 0 0 .011.59c.173.16.447.155.614-.01 1.334-1.329 1.37-2.758.941-3.706a2.461 2.461 0 0 0-.227-.4zM11 9.073c-.136.389-.39.804-.81 1.22a.405.405 0 0 0 .012.59c.172.16.446.155.613-.01 1.334-1.329 1.37-2.758.942-3.706a2.466 2.466 0 0 0-.228-.4 1.686 1.686 0 0 0-.227-.273 1.466 1.466 0 0 0-.469-.324l-.008-.004A1.785 1.785 0 0 0 10.07 6c-.957 0-1.734.746-1.734 1.667 0 .92.777 1.666 1.734 1.666.343 0 .662-.095.931-.26z">
                        </path>
                    </svg>
                    <span>Testimonials</span>
                    <a href="#" class="absolute inset-0"></a>
                </li>
                <li class="flex items-center text-sm leading-9 relative">
                    <svg class="w-5 h-5 mx-2.5 my-0" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="currentColor">
                        <path fill="none" stroke="currentColor" stroke-width="2"
                            d="M1,1 L19,1 L19,19 L1,19 L1,1 Z M5,19 L5,23 L23,23 L23,5.97061363 L18.9998921,5.97061363 M6,8 C6.55228475,8 7,7.55228475 7,7 C7,6.44771525 6.55228475,6 6,6 C5.44771525,6 5,6.44771525 5,7 C5,7.55228475 5.44771525,8 6,8 Z M2,18 L7,12 L10,15 L14,10 L19,16">
                        </path>
                    </svg>
                    <span>Gallery</span>
                    <svg class="w-8 h-8 relative translate-x-1 ml-auto" height="24" width="24"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <g>
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path d="M12 15l-4.243-4.243 1.415-1.414L12 12.172l2.828-2.829 1.415 1.414z"></path>
                        </g>
                    </svg>
                    <a href="#" class="absolute inset-0"></a>
                </li>
            </ul>
        </nav>
        <footer class="mt-6 font-semibold leading-9 bg-sky-500 rounded-md">
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <button name="logout" id="logout" class="flex items-center w-full">
                    <svg class="w-5 h-5 mx-2.5 my-0" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
                        enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="currentColor">
                        <g>
                            <path d="M0,0h24v24H0V0z" fill="none"></path>
                        </g>
                        <g>
                            <g>
                                <polygon points="5,5 12,5 12,3 3,3 3,21 12,21 12,19 5,19"></polygon>
                                <polygon points="21,12 17,8 17,11 9,11 9,13 17,13 17,16"></polygon>
                            </g>
                        </g>
                    </svg>
                    <span>Log Out</span>
                </button>
            </form>
        </footer>
    </aside>
    <main class="flex-1 bg-gray-100 overflow-x-hidden overflow-y-auto">
        <header class="flex justify-between items-center text-sm py-2.5 px-6">
            <?php
            $sql = "SELECT name, unique_name FROM `users` LEFT JOIN `user_img` ON `users`.`id` = `user_img`.`user_id` WHERE email='{$_SESSION['loginName']}'";
            $result = $conn->query($sql);
            if (!$result) {
                die("Error searching user: " . $conn->error);
            }
            $result = $result->fetch_assoc();
            $name = $result['name'];
            $image = $result['unique_name'];
            echo '<h3 class="text-lg font-medium">Welcome, ' . $name . '</h3>';
            ?>
            <div class="<?= $image === null ? 'hidden' : '' ?> w-10 h-10 rounded-full">
                <img src="<?= "../server/uploads/images/" . $image ?>" alt="<?= $name ?>"
                    class="h-full w-full object-cover border-2 border-black rounded-full">
            </div>
            <svg class="<?= $image !== null ? 'hidden' : '' ?> w-10 h-10" height="36" width="36"
                xmlns="http://www.w3.org/2000/svg" role="img" viewBox="0 0 24 24" aria-labelledby="userIconTitle"
                fill="none" stroke="currentColor">
                <title id="userIconTitle">User</title>
                <circle cx="12" cy="12" r="10" fill="#ffa000db"></circle>
                <path stroke-linecap="round" fill="#000"
                    d="M5.5,19.5 C7.83333333,18.5 9.33333333,17.6666667 10,17 C11,16 8,16 8,11 C8,7.66666667 9.33333333,6 12,6 C14.6666667,6 16,7.66666667 16,11 C16,16 13,16 14,17 C14.6666667,17.6666667 16.1666667,18.5 18.5,19.5">
                </path>
            </svg>
        </header>

        <section class="teamMembers">
            <header class="py-2.5 px-6">
                <h1 class="my-2.5 text-2xl font-medium text-center xl:text-left">Registered Users</h1>
                <div class="flex items-center gap-2">
                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
                        class="w-1/2 min-w-[453px] h-[35px] lg:mx-auto xl:mx-0 relative">
                        <input type="search" name="searchData" placeholder="Search by Username/Email/Phone Number"
                            class="w-full h-full px-2.5 py-4 rounded outline-indigo-600">
                        <button name="searchUser" id="searchUser"
                            class="absolute right-0 inset-y-0 bg-slate-200 px-2 rounded-r">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z">
                                </path>
                            </svg>
                        </button>
                    </form>
                    <span class="text-red-600 text-sm font-medium"><?= $searchErr ?? '' ?></span>
                </div>
            </header>

            <ul class="px-6 space-y-4">
                <?php
                $sql = "SELECT * FROM `users` LEFT JOIN `user_img` ON `users`.`id` = `user_img`.`user_id` ORDER BY id";
                $result = $conn->query($sql);
                if (!$result) {
                    die("Error searching users: " . $conn->error);
                }
                $borderColors = ['border-stone-600', 'border-red-500', 'border-red-700', 'border-orange-500', 'border-orange-700', 'border-amber-400', 'border-amber-700', 'border-yellow-400', 'border-yellow-600', 'border-lime-400', 'border-lime-600', 'border-green-500', 'border-green-700', 'border-teal-400', 'border-cyan-400', 'border-cyan-600', 'border-sky-500', 'border-sky-700', 'border-blue-600', 'border-blue-800', 'border-indigo-600', 'border-fuchsia-500', 'border-rose-500'];
                $textColors = ['text-stone-600', 'text-red-500', 'text-red-700', 'text-orange-500', 'text-orange-700', 'text-amber-400', 'text-amber-700', 'text-yellow-400', 'text-yellow-600', 'text-lime-400', 'text-lime-600', 'text-green-500', 'text-green-700', 'text-teal-400', 'text-cyan-400', 'text-cyan-600', 'text-sky-500', 'text-sky-700', 'text-blue-600', 'text-blue-800', 'text-indigo-600', 'text-fuchsia-500', 'text-rose-500'];
                foreach ($result->fetch_all(MYSQLI_ASSOC) as $userDetails):
                    ?>
                    <?php $isCurrentUser = ($_SESSION['loginName'] === $userDetails['email']) ?>
                    <li
                        class="<?= (isset($_POST['searchUser']) && (!$isSearchErr)) ? (($searchEmail === $userDetails['email']) ? 'flex' : 'hidden') : 'flex' ?> items-center gap-5 shadow-md bg-white py-2.5 px-6 rounded">
                        <div class="w-11 h-11 mt-1.5">
                            <img src="<?= "../server/uploads/images/" . $userDetails['unique_name'] ?>"
                                alt="<?= $userDetails['name'] ?>"
                                class="<?= $userDetails['unique_name'] === null ? 'hidden' : 'inline' ?> w-full h-full object-cover rounded-full border-2 <?= $borderColors[array_rand($borderColors)] ?>">
                            <svg class="<?= $userDetails['unique_name'] === null ? 'inline' : 'hidden' ?> w-full h-full object-cover <?= $textColors[array_rand($textColors)] ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="">
                            <h3 class="text-xl font-semibold"><?= $userDetails['name']; ?></h3>
                            <div class="flex gap-12 items-end">
                                <div>
                                    <p class="text-lg font-medium"><?= $userDetails['username']; ?></p>
                                    <dl>
                                        <div class="flex gap-2">
                                            <dt class="font-medium">Email Address:</dt>
                                            <dd>
                                                <a
                                                    href="mailto:<?= $isCurrentUser ? $userDetails['email'] : ""; ?>"><?= $isCurrentUser ? $userDetails['email'] : substr($userDetails['email'], 0, 2) . str_repeat("x", strlen($userDetails['email']) - 5) . substr($userDetails['email'], -3); ?></a>
                                            </dd>
                                        </div>
                                        <div class="flex gap-2">
                                            <dt class="font-medium">Phone Number:</dt>
                                            <dd>
                                                <a
                                                    href="tel:+<?= $isCurrentUser ? $userDetails['phone'] : ""; ?>"><?= $isCurrentUser ? $userDetails['phone'] : substr($userDetails['phone'], 0, 2) . str_repeat("x", 4) . substr($userDetails['phone'], -4); ?></a>
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                                <dl>
                                    <div class="<?= $isCurrentUser ? 'flex' : 'hidden'; ?> gap-2">
                                        <dt class="font-medium">Password:</dt>
                                        <dd><?= $isCurrentUser ? $userDetails['password'] : str_repeat("*", strlen($userDetails['password'])); ?>
                                        </dd>
                                    </div>
                                    <div class="flex gap-2">
                                        <dt class="font-medium">Account Created:</dt>
                                        <dd><?= date("d F Y, H:i:s", strtotime($userDetails['creation_date'])) ?></dd>
                                    </div>
                                    <div class="flex gap-2">
                                        <dt class="font-medium">Last Updated:</dt>
                                        <dd><?php
                                        if (empty($userDetails['modification_date']) && empty($userDetails['img_modification_date'])) {
                                            echo "Never";
                                        } elseif (!empty($userDetails['modification_date']) && empty($userDetails['img_modification_date'])) {
                                            echo date("d F Y, H:i:s", strtotime($userDetails['modification_date']));
                                        } elseif (empty($userDetails['modification_date']) && !empty($userDetails['img_modification_date'])) {
                                            date("d F Y, H:i:s", strtotime($userDetails['img_modification_date']));
                                        } else {
                                            echo $userDetails['modification_date'] > $userDetails['img_modification_date'] ? date("d F Y, H:i:s", strtotime($userDetails['modification_date'])) : date("d F Y, H:i:s", strtotime($userDetails['img_modification_date']));
                                        }
                                        ?></dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                        <div class="ml-auto h-24 flex flex-col justify-between">
                            <div class="flex items-center gap-12">
                                <span
                                    class="<?= $userDetails['active'] ? 'bg-green-400 text-green-700' : 'bg-red-400 text-red-700'; ?> rounded-full px-3 font-medium"><?= $userDetails['active'] ? 'Active' : 'Inactive' ?></span>
                                <dl class="flex gap-2">
                                    <dt class="font-medium">ID:</dt>
                                    <dd
                                        class="bg-yellow-300 rounded-md text-sm font-bold text-red-600 text-center px-2 py-0.5">
                                        <?= $userDetails['id']; ?></dd>
                                </dl>
                            </div>
                            <div class="flex items-center justify-end gap-12 text-sm text-center">
                                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $userDetails['id']; ?>">
                                    <button name="<?= $userDetails['active'] ? 'lockUser' : 'unlockUser'; ?>"
                                        id="lockUnlockUser">
                                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                            enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="currentColor">
                                            <rect fill="none" height="24" width="24"></rect>
                                            <path
                                                d="M13,3c-4.97,0-9,4.03-9,9c0,0.06,0.01,0.12,0.01,0.19l-1.84-1.84l-1.41,1.41L5,16l4.24-4.24l-1.41-1.41l-1.82,1.82 C6.01,12.11,6,12.06,6,12c0-3.86,3.14-7,7-7s7,3.14,7,7s-3.14,7-7,7c-1.9,0-3.62-0.76-4.88-1.99L6.7,18.42 C8.32,20.01,10.55,21,13,21c4.97,0,9-4.03,9-9S17.97,3,13,3z M15,11v-1c0-1.1-0.9-2-2-2s-2,0.9-2,2v1c-0.55,0-1,0.45-1,1v3 c0,0.55,0.45,1,1,1h4c0.55,0,1-0.45,1-1v-3C16,11.45,15.55,11,15,11z M14,11h-2v-1c0-0.55,0.45-1,1-1s1,0.45,1,1V11z">
                                            </path>
                                            <title><?= $userDetails['active'] ? 'Lock User' : 'Unlock User' ?></title>
                                        </svg>
                                    </button>
                                </form>
                                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $userDetails['id']; ?>">
                                    <button name="editData" <?= (!$userDetails['active'] && !$isCurrentUser) ? 'disabled' : '' ?> class="disabled:text-gray-400">
                                        <svg class="w-6 h-6 cursor-pointer" height="24" width="24"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z">
                                            </path>
                                            <title>Edit</title>
                                        </svg>
                                    </button>
                                </form>
                                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
                                    class=" <?= $isCurrentUser ? "block" : "hidden" ?>">
                                    <button name="deleteUser" id="deleteUser" <?= $isCurrentUser ? '' : 'disabled' ?>>
                                        <svg class="w-7 h-7 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M0 0h24v24H0V0z" fill="none"></path>
                                            <path
                                                d="M6 21h12V7H6v14zm2.46-9.12l1.41-1.41L12 12.59l2.12-2.12 1.41 1.41L13.41 14l2.12 2.12-1.41 1.41L12 15.41l-2.12 2.12-1.41-1.41L10.59 14l-2.13-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4h-3.5z">
                                            </path>
                                            <title>Delete Account</title>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>
</body>

</html>