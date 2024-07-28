<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            
            <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
                <!-- Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16 ">
                        <div class="flex ">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('dashboard') }}">
                                    <x-application-mark class="block h-9 w-auto" />
                                </a>
                            </div>
                            
                        </div>
                        <div class="flex w-screen  place-content-center p-0">
                            <div >
                                <div class="text-center font-header text-4xl font-semibold text-gray-900 leading-none">CADUCEUS</div>
                                <div class="mb-6 text-sm font-light text-true-gray-500 text-center">System for Credential and Document Upload Checklist for Eligible Users</div>
                            </div>
                        </div>
                    </div>
                </div>               
            </nav>        

            <!-- Page Content -->
            <main>
                 
                @livewire('upload-reference') 
                   
            </main>
        </div>
        
        @livewireScripts
    </body>
</html>
                    
                 
               
