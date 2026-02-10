<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Sistem Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow h-screen">
        <div class="p-6 font-bold text-xl border-b">Siswa</div>

        <nav class="mt-6">
            <a href="{{ route('siswa.dashboard') }}" class="block px-6 py-3 text-gray-700 hover:bg-gray-200 rounded @if(request()->is('siswa')) bg-gray-200 @endif">Dashboard</a>
            <a href="{{ route('siswa.laporan.index') }}" class="block px-6 py-3 text-gray-700 hover:bg-gray-200 rounded @if(request()->is('siswa/laporan')) bg-gray-200 @endif">Daftar Laporan</a>
            <a href="{{ route('siswa.laporan.create') }}" class="block px-6 py-3 text-gray-700 hover:bg-gray-200 rounded @if(request()->is('siswa/laporan/create')) bg-gray-200 @endif">Buat Laporan</a>
        </nav>
    </aside>

    {{-- Main content --}}
    <div class="flex-1">
        {{-- Topbar --}}
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <div>
                <h1 class="text-xl font-bold">@yield('title')</h1>
            </div>
            <div>
                <span class="mr-4">{{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-500 hover:underline">Logout</button>
                </form>
            </div>
        </header>

        {{-- Page content --}}
        <main class="p-6">
            @yield('content')
        </main>
    </div>

</body>
</html>
