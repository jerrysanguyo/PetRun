<div x-data="{
        total: {{ $totalParticipants }},
        scanned: 0,
        notScanned: 0,
        fetchCount() {
            fetch('{{ route(Auth::user()->getRoleNames()->first() . '.owner.count') }}')
                .then(res => res.json())
                .then(data => {
                    this.total = data.count;
                    // Mock values — replace when backend is ready
                    this.scanned = Math.floor(data.count * 0.6);
                    this.notScanned = data.count - this.scanned;
                });
        },
        init() {
            this.fetchCount();
            setInterval(() => this.fetchCount(), 5000);
        }
    }" x-init="init()" class="grid grid-cols-1 md:grid-cols-3 gap-6 my-6">
    <div class="bg-white border border-pink-200 shadow-xl rounded-xl p-6 text-center">
        <div class="text-4xl mb-2">🐾</div>
        <h3 class="text-lg font-semibold text-gray-700">Total Participants</h3>
        <p class="text-4xl font-bold text-pink-600 mt-1" x-text="total"></p>
        <p class="text-sm text-gray-400 mt-1">Includes all registered pet owners</p>
    </div>
    
    <div class="bg-white border border-green-200 shadow-xl rounded-xl p-6 text-center">
        <div class="text-4xl mb-2">✅</div>
        <h3 class="text-lg font-semibold text-gray-700">Scanned</h3>
        <p class="text-4xl font-bold text-green-600 mt-1" x-text="scanned"></p>
        <p class="text-sm text-gray-400 mt-1">QR scanned during event check-in</p>
    </div>
    
    <div class="bg-white border border-yellow-200 shadow-xl rounded-xl p-6 text-center">
        <div class="text-4xl mb-2">⏳</div>
        <h3 class="text-lg font-semibold text-gray-700">Not Yet Scanned</h3>
        <p class="text-4xl font-bold text-yellow-500 mt-1" x-text="notScanned"></p>
        <p class="text-sm text-gray-400 mt-1">Awaiting participant check-in</p>
    </div>
</div>