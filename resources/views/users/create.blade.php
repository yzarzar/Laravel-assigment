<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col h-screen">
    <nav class="fixed top-0 right-0 left-0 bg-white shadow">
        <div class="container flex justify-between px-4 py-2 mx-auto">
            <a href="/" class="text-2xl font-bold">Laravel Exercises</a>
            <ul class="flex gap-4 items-center">
                <li><a href="{{ route('categories.index') }}" class="hover:text-blue-500">Categories</a></li>
                <li><a href="{{ route('products.index') }}" class="hover:text-blue-500">Products</a></li>
                <li class="relative" id="user-menu">
                    <button
                        class="flex gap-2 items-center px-4 py-2 w-full text-sm font-medium text-gray-700 bg-white rounded-md border border-gray-300 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100"
                        type="button" aria-expanded="false" aria-haspopup="true" onclick="toggleDropdown(event)">
                        <span
                            class="inline-flex justify-center items-center w-8 h-8 text-base font-semibold text-white bg-gray-700 rounded-full">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </span>
                        <span class="ml-2">{{ auth()->user()->name }}</span>
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <ul id="dropdown-menu" class="hidden absolute right-0 py-1 w-48 bg-white rounded-md shadow-lg"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                        <a href="{{ route('user.show', ['id' => auth()->user()->id]) }}">
                            <li class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                Profile
                            </li>
                        </a>
                        <a href="#">
                            <li class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                Settings
                            </li>
                        </a>
                        <a href="{{ route('users.index') }}">
                            <li class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                See All Users
                            </li>
                        </a>
                        <a href="{{ route('users.create') }}">
                            <li class="block px-4 py-2 text-sm text-gray-700 border-t hover:bg-gray-100"
                                role="menuitem">
                                + Create New User
                            </li>
                        </a>
                        <li class="block px-4 py-2 text-sm text-gray-700 border-t hover:bg-gray-100" role="menuitem">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container flex justify-center items-center px-4 mx-auto min-h-screen sm:px-6 lg:px-8">
        <div class="w-full max-w-sm">
            <h1 class="mb-6 text-3xl font-semibold text-center text-gray-700">Create New User</h1>

            <form action="{{ route('users.store') }}" method="POST" class="flex flex-col gap-6">
                @csrf
                @method('POST')
                <input type="text" name="name" placeholder="Name"
                    class="px-4 py-2 text-gray-700 rounded-md border border-gray-300 input-field focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    required>

                <input type="email" name="email" placeholder="Email"
                    class="px-4 py-2 text-gray-700 rounded-md border border-gray-300 input-field focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    required>

                <input type="password" name="password" placeholder="Password"
                    class="px-4 py-2 text-gray-700 rounded-md border border-gray-300 input-field focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    required>

                <button type="submit"
                    class="px-4 py-2 w-full text-sm font-bold text-white bg-blue-500 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Create User
                </button>
            </form>
        </div>
    </div>

    <script>
        function toggleDropdown(event) {
            const dropdownMenu = document.getElementById('dropdown-menu');
            dropdownMenu.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        window.addEventListener('click', function(event) {
            const userMenu = document.getElementById('user-menu');
            const dropdownMenu = document.getElementById('dropdown-menu');

            if (!userMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
</body>

</html>
