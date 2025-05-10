<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link
        rel="stylesheet"
        as="style"
        onload="this.rel='stylesheet'"
        href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;700;900&family=Noto+Sans:wght@400;500;700;900&display=swap" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
</head>

<body class="bg-[#111418] text-white font-[Lexend,sans-serif]">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-80 min-h-screen bg-[#111418] flex flex-col justify-between p-4 border-r border-gray-700">
            <div class="flex flex-col gap-4">
                <!-- Navigation Links -->
                <nav class="flex flex-col gap-2">
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-xl bg-[#293038]">
                        <!-- Icon: Home -->
                        <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256">
                            <path d="M224,115.55V208a16..."></path>
                        </svg>
                        <span class="text-sm font-medium">Dashboard</span>
                    </a>

                    <!-- Repeat for each menu item -->
                    <a href="../MVC/view/nutrition_plan_view.php" class="flex items-center gap-3 px-3 py-2 hover:bg-[#293038] rounded-xl">
                        <!-- Icon: Users -->
                        <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256">
                            <path d="M117.25,157.92a60..."></path>
                        </svg>
                        <span class="text-sm font-medium">Plan de Nutricion</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-3 py-2 hover:bg-[#293038] rounded-xl">
                        <!-- Icon: User -->
                        <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256">
                            <path d="M230.92,212c-15..."></path>
                        </svg>
                        <span class="text-sm font-medium">Trainers</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-3 py-2 hover:bg-[#293038] rounded-xl">
                        <!-- Icon: Classes -->
                        <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256">
                            <path d="M244.8,150.4a8..."></path>
                        </svg>
                        <span class="text-sm font-medium">Classes</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-3 py-2 hover:bg-[#293038] rounded-xl">
                        <!-- Icon: Reports -->
                        <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256">
                            <path d="M213.66,82.34l-56-56..."></path>
                        </svg>
                        <span class="text-sm font-medium">Reports</span>
                    </a>
                </nav>
            </div>

            <!-- Bottom buttons -->
            <div class="flex flex-col gap-4">
                <button class="h-10 rounded-xl bg-[#1568c1] text-sm font-bold px-4">New member</button>

                <div class="flex flex-col gap-1">
                    <a href="#" class="flex items-center gap-3 px-3 py-2 hover:bg-[#293038] rounded-xl">
                        <!-- Icon: Gear -->
                        <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256">
                            <path d="M128,80a48,48..."></path>
                        </svg>
                        <span class="text-sm font-medium">Settings</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-3 py-2 hover:bg-[#293038] rounded-xl">
                        <!-- Icon: Help -->
                        <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256">
                            <path d="M140,180a12..."></path>
                        </svg>
                        <span class="text-sm font-medium">Help</span>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content (placeholder) -->
        <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
            <div class="flex flex-wrap justify-between gap-3 p-4"><p class="text-white tracking-light text-[32px] font-bold leading-tight min-w-72">Good morning, <?php echo htmlspecialchars($_SESSION["nombre"]); ?></p></div>
            <div class="flex flex-wrap gap-4 p-4">
                <div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-xl p-6 bg-[#293038]">
                    <p class="text-white text-base font-medium leading-normal">Days Left</p>
                    <p class="text-white tracking-light text-2xl font-bold leading-tight">45</p>
                    <p class="text-[#0bda5b] text-base font-medium leading-normal">+5%</p>
                </div>
                <div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-xl p-6 bg-[#293038]">
                    <p class="text-white text-base font-medium leading-normal">Classes Left</p>
                    <p class="text-white tracking-light text-2xl font-bold leading-tight">12</p>
                    <p class="text-[#fa6238] text-base font-medium leading-normal">-2%</p>
                </div>
                <div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-xl p-6 bg-[#293038]">
                    <p class="text-white text-base font-medium leading-normal">Sessions</p>
                    <p class="text-white tracking-light text-2xl font-bold leading-tight">30</p>
                    <p class="text-[#0bda5b] text-base font-medium leading-normal">+3%</p>
                </div>
                <div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-xl p-6 bg-[#293038]">
                    <p class="text-white text-base font-medium leading-normal">Spending Balance</p>
                    <p class="text-white tracking-light text-2xl font-bold leading-tight">$150</p>
                    <p class="text-[#0bda5b] text-base font-medium leading-normal">+1%</p>
                </div>
            </div>

        </div>
    </div>
</body>

</html>