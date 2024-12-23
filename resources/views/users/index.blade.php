<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 20px;
        }
    </style>
</head>

<body class="flex flex-col bg-gray-100">
    <nav class="bg-white shadow">
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
                            <li class="block px-4 py-2 text-sm text-gray-700 border-t hover:bg-gray-100" role="menuitem">
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

    <div class="container p-4 mx-auto">
        <h1 class="mb-4 text-3xl font-bold">All Users</h1>
        <ul class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($users as $user)
                <li class="flex flex-col justify-between items-center p-4 bg-white rounded-md shadow-md">
                    <span class="text-2xl font-bold">
                        {{ $user->name }}
                        @if(auth()->user()->id === $user->id)
                            <span class="text-sm font-normal text-blue-500">(You)</span>
                        @endif
                    </span>
                    <span class="text-sm text-gray-600">{{ $user->email }}</span>
                    <div class="flex gap-2 mt-4">
                        @if(auth()->user()->id !== $user->id)
                            <button onclick="openEditModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}')"
                                class="px-4 py-2 font-bold text-white bg-blue-500 rounded-md hover:bg-blue-700">
                                Edit
                            </button>
                        @else
                            <a href="{{ route('user.show', ['id' => $user->id]) }}"
                                class="px-4 py-2 font-bold text-white bg-blue-500 rounded-md hover:bg-blue-700">
                                View Profile
                            </a>
                        @endif
                        @if(auth()->user()->id !== $user->id)
                            <form action="{{ route('users.destroy', ['id' => $user->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 font-bold text-white bg-red-500 rounded-md hover:bg-red-700">
                                    Delete
                                </button>
                            </form>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Edit User Modal -->
    <div id="editModal" class="flex hidden fixed inset-0 z-50 justify-center items-center bg-black bg-opacity-50">
        <div class="p-8 w-96 bg-white rounded-lg shadow-lg">
            <h2 class="mb-4 text-2xl font-bold">Edit User</h2>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="editId">
                <div class="mb-4">
                    <label for="name" class="block mb-2 text-sm font-bold text-gray-700">Name</label>
                    <input type="text" name="name" id="editName"
                        class="px-3 py-2 w-full rounded-md border focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="email" class="block mb-2 text-sm font-bold text-gray-700">Email</label>
                    <input type="email" name="email" id="editEmail"
                        class="px-3 py-2 w-full rounded-md border focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex gap-2 justify-end">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 text-gray-600 hover:text-gray-800">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-700">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleDropdown(event) {
            const menu = document.getElementById('dropdown-menu');
            menu.classList.toggle('hidden');
            event.stopPropagation();
        }

        document.addEventListener('click', function(event) {
            const menu = document.getElementById('dropdown-menu');
            if (!menu.contains(event.target) && !event.target.closest('#user-menu')) {
                menu.classList.add('hidden');
            }
        });

        function openEditModal(userId, userName, userEmail) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');
            const nameInput = document.getElementById('editName');
            const emailInput = document.getElementById('editEmail');

            form.action = `/users/${userId}/update-another-user`;
            nameInput.value = userName;
            emailInput.value = userEmail;
            modal.classList.remove('hidden');
        }

        function closeEditModal() {
            const modal = document.getElementById('editModal');
            modal.classList.add('hidden');
        }
    </script>
</body>

</html>
