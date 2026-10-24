<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>DevCraft Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 flex">
    <aside class="w-64 bg-slate-900 h-screen text-white p-6">
        <h1 class="text-2xl font-bold text-indigo-400 mb-8">DevCraft Admin</h1>
        <nav class="space-y-4">
            <a href="{{ route('dashboard') }}" class="block py-2 px-4 hover:bg-slate-800 rounded">Dashboard</a>
            <a href="{{ route('desain.index') }}" class="block py-2 px-4 hover:bg-slate-800 rounded">Kelola Desain</a>
        </nav>
    </aside>
    <div class="flex-1 flex flex-col h-screen overflow-y-auto">
        <header class="bg-white shadow p-4 flex justify-between">
            <h2 class="font-semibold text-gray-800">Admin Panel</h2>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-600 font-semibold">Logout</button>
            </form>
        </header>
        <main class="p-6">
            {{ $slot }}
        </main>
    </div>
</body>
</html>