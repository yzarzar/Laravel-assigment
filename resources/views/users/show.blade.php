<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .name {
            font-family: 'Lobster', cursive;
            font-size: 9rem;
        }

        .email {
            font-family: 'Comfortaa', cursive;
            font-size: 5rem;
        }

        body {
            background-color: #4267B2;
        }

        /* Ensure input fields match original text appearance */
        .input-field {
            font-family: 'Lobster', cursive;
            font-size: 9rem;
            text-align: center;
            color: white;
            background: transparent;
            border: 2px solid #ccc;
            width: 100%;
            padding: 1rem;
        }

        .email-input {
            font-family: 'Comfortaa', cursive;
            font-size: 5rem;
        }

        /* Hide input fields initially */
        .editable {
            display: none;
        }
    </style>
</head>

<body class="flex flex-col justify-center h-screen">
    <nav class="fixed top-0 z-10 w-full bg-white shadow">
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
    <div class="container flex flex-col justify-center p-12 mx-auto mt-16 min-h-screen text-center">
        <form action="{{ route('users.update', auth()->user()) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Display name and email text initially -->
            <p id="name" class="text-white name">
                {{ auth()->user()->name }}
            </p>
            <p id="email" class="text-white email">
                {{ auth()->user()->email }}
            </p>

            <!-- Editable input fields for name and email (hidden initially) -->
            <div id="name-edit" class="editable">
                <input type="text" name="name" value="{{ auth()->user()->name }}" class="mb-4 input-field">
            </div>
            <div id="email-edit" class="editable">
                <input type="email" name="email" value="{{ auth()->user()->email }}" class="input-field email-input">
            </div>

            <div class="my-8"></div>

            <!-- Edit button that toggles form visibility -->
            <button id="editBtn" type="button"
                onclick="toggleEdit()"
                class="px-6 py-4 mt-12 text-2xl font-bold text-white bg-blue-500 rounded">
                Edit
            </button>

            <!-- Save button (hidden initially) -->
            <button id="saveBtn" type="submit"
                class="hidden px-6 py-4 mt-12 text-2xl font-bold text-white bg-blue-500 rounded">
                Save
            </button>
        </form>
    </div>

    <script>
        // Function to toggle edit mode
        function toggleEdit() {
            const nameElement = document.getElementById('name');
            const emailElement = document.getElementById('email');
            const nameEdit = document.getElementById('name-edit');
            const emailEdit = document.getElementById('email-edit');
            const editBtn = document.getElementById('editBtn');
            const saveBtn = document.getElementById('saveBtn');

            // Check if we are in edit mode or view mode
            const isEditing = nameEdit.style.display === 'block';

            if (isEditing) {
                // If in edit mode, switch back to view mode
                nameElement.style.display = 'block';
                emailElement.style.display = 'block';
                nameEdit.style.display = 'none';
                emailEdit.style.display = 'none';
                editBtn.innerText = 'Edit';
                saveBtn.classList.add('hidden');
            } else {
                // If in view mode, switch to edit mode
                nameElement.style.display = 'none';
                emailElement.style.display = 'none';
                nameEdit.style.display = 'block';
                emailEdit.style.display = 'block';
                editBtn.innerText = 'Cancel';
                saveBtn.classList.remove('hidden');
            }
        }

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
