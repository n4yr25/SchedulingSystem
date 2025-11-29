@extends('layouts.admin')
@section('main-content')

<!-- Tailwind CSS CDN (only for this page) -->
<script src="https://cdn.tailwindcss.com"></script>

<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-5xl font-extrabold text-gray-800">Dashboard</h2>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-10">
        <!-- Rooms -->
        <div class="p-10 bg-blue-600 rounded-2xl shadow text-white flex items-center justify-between">
           <div>
                <h6 class="text-2xl font-semibold opacity-90">Rooms</h6>
                <div class="flex items-baseline gap-2 mt-4">
                    <span class="text-6xl font-extrabold">{{ $availableRooms }}</span>
                    <span class="text-2xl opacity-80">/{{ $totalRooms }}</span>
                </div>
                <p class="mt-5 text-xl font-medium opacity-90">Total Available</p>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 2v6m0 0h4m-4 0H7m4 0v6m0-6h4" />
                </svg>
            </div>
        </div>

        <!-- Sections -->
        <div class="p-10 bg-green-600 rounded-2xl shadow text-white flex items-center justify-between">
            <div>
                <h6 class="text-2xl font-semibold opacity-90">Sections</h6>
                <h3 class="mt-4 text-6xl font-extrabold">{{ $totalSections }}</h3>
                <p class="mt-5 text-xl font-medium opacity-90">Active Sections</p>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                </svg>
            </div>
        </div>

        <!-- Instructors -->
        <div class="p-10 bg-purple-600 rounded-2xl shadow text-white flex items-center justify-between">
            <div>
                <h6 class="text-2xl font-semibold opacity-90">Instructors</h6>
                <h3 class="mt-4 text-6xl font-extrabold">{{ $teachingInstructorsCount }}</h3>
                <p class="mt-5 text-xl font-medium opacity-90">Faculty Workload</p>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 110-8 4 4 0 010 8z" />
                </svg>
            </div>
        </div>

        <!-- Current Date -->
        <div class="p-10 bg-orange-600 rounded-2xl shadow text-white flex items-center justify-between">
            <div>
                <h6 class="text-2xl font-semibold opacity-90">Current Date</h6>
                <h3 class="mt-4 text-3xl font-extrabold">
                    {{ \Carbon\Carbon::now()->format('F d, Y') }}
                </h3>
                <p class="mt-5 text-xl font-medium opacity-90">
                    {{ \Carbon\Carbon::now()->format('l') }}
                </p>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Two Column Layout (Tables) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Academic Programs Table -->
        <div class="bg-white shadow rounded-2xl overflow-hidden">
            <div class="px-6 py-5 border-b">
                <h3 class="text-3xl font-bold text-gray-800">Academic Programs</h3>
            </div>
            <div class="overflow-y-auto max-h-[500px]">
                <table class="min-w-full text-left text-lg text-gray-700">
                    <thead class="bg-gray-100 text-gray-800 uppercase text-md font-semibold sticky top-0 z-10">
                        <tr>
                            <th class="px-6 py-4">Program Code</th>
                            <th class="px-6 py-4">Program Name</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-gray-700">
                        @foreach ($programs as $program)
                        <tr>
                            <td class="px-6 py-5 font-bold">{{ $program->program_code }}</td>
                            <td class="px-6 py-5">{{ $program->program_name }}</td>
                        </tr>
                        @endforeach    
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Instructors Table -->
        <div class="bg-white shadow rounded-2xl overflow-hidden">
            <div class="px-6 py-5 border-b">
                <h3 class="text-3xl font-bold text-gray-800">Instructors</h3>
            </div>
            <div class="overflow-y-auto max-h-[500px]">
                <table class="min-w-full text-left text-lg text-gray-700">
                    <thead class="bg-gray-100 text-gray-800 uppercase text-md font-semibold sticky top-0 z-10">
                        <tr>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Department</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-gray-700">
                        @foreach ($teachingInstructors as $instructors)
                        <tr>
                            <td class="px-6 py-5 font-bold">{{ $instructors->name }} {{ $instructors->lastname }}</td>
                            <td class="px-6 py-5">{{  $instructors->college }}</td>
                            {{-- <td class="px-6 py-5"><span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">{{  $instructors->employee_type }}</span></td> --}}
                            <td class="px-6 py-5">{{  $instructors->employee_type }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
