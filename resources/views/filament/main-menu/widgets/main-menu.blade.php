<x-filament-widgets::widget>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4 mb-12">
        @php
            $user = Auth::user();
            $totalJobs = 0; // Variabel untuk menghitung jumlah total card yang ditampilkan
        @endphp

        <!-- Card 1: Electrostatic Discharge -->
        @if ($user->isAdminEsd() || $user->isSuperAdmin() || $user->isUser() || $user->isAdminHr() || $user->isAdminHr() || $user->isAdminGa() || $user->isAdminUtility())
            @php $totalJobs++; @endphp
            <x-filament::card class="max-w-sm">
                <div class="relative">
                    <img class="w-full h-48 object-cover aspect-square" src="{{ url('images/ticket.png') }}" alt="ESD Portal" />
                </div>
                <div class="space-y-2">
                    <h5 class="text-lg font-bold">Ticketing</h5>
                    <p class="text-gray-600">
                        Make & take a ticket for work operational problem or request
                    </p>
                    <x-filament::button 
                        tag="a" 
                        href="http://127.0.0.1:8000/ticket" 
                        class="mt-4"
                    >
                        More Info
                    </x-filament::button>
                </div>
            </x-filament::card>
        @endif

        <!-- Card 2: Human Resource -->
        @if ($user->isAdminEsd() || $user->isSuperAdmin() || $user->isUser() || $user->isAdminHr() || $user->isAdminHr() || $user->isAdminGa() || $user->isAdminUtility())
            @php $totalJobs++; @endphp
            <x-filament::card class="max-w-sm">
                <div class="relative">
                    <img class="w-full h-48 object-cover aspect-square" src="{{ url('images/jobs.png') }}" alt="HR Portal" />
                </div>
                <div class="space-y-2">
                    <h5 class="text-lg font-bold">Jobs Access</h5>
                    <p class="text-gray-600">
                        Explore Your Job Access for more
                    </p>
                    <x-filament::button 
                        tag="a" 
                        href="http://127.0.0.1:8000/jobs" 
                        class="mt-4"
                    >
                        More Info
                    </x-filament::button>
                </div>
            </x-filament::card>
        @endif  

        @php
            // Simpan total jobs ke dalam sesi
            session(['total_jobs' => $totalJobs]);
        @endphp
    </div>
</x-filament-widgets::widget>
