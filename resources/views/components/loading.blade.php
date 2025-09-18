<div x-cloak x-show="isSubmitting" x-transition.opacity
    class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-black bg-opacity-90 text-center"
    style="background-color: rgba(0,0,0,0.9);" aria-hidden="true">
    <img src="{{ asset('images/dog.gif') }}" alt="Submitting…" class="w-48 h-48 object-contain mb-6"
        onerror="this.style.display='none';">
    <p class="text-lg font-semibold text-white">Submitting your registration… please wait 🐶💨</p>
</div>