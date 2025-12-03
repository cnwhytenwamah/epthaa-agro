{{-- Success Message --}}
@if ($message = Session::get('success'))
<div class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-800 px-4 py-3 relative" role="alert">
    <span class="font-semibold">Success:</span> {{ $message }}
    <button type="button" class="absolute top-2 right-3 text-green-700 hover:text-green-900" onclick="this.parentElement.remove()">
        &times;
    </button>
</div>
@endif

{{-- Error Message --}}
@if ($message = Session::get('error'))
<div class="mb-4 rounded-lg bg-red-100 border border-red-300 text-red-800 px-4 py-3 relative" role="alert">
    <span class="font-semibold">Error:</span> {{ $message }}
    <button type="button" class="absolute top-2 right-3 text-red-700 hover:text-red-900" onclick="this.parentElement.remove()">
        &times;
    </button>
</div>
@endif

{{-- Warning Message --}}
@if ($message = Session::get('warning'))
<div class="mb-4 rounded-lg bg-yellow-100 border border-yellow-300 text-yellow-800 px-4 py-3 relative" role="alert">
    <span class="font-semibold">Warning:</span> {{ $message }}
    <button type="button" class="absolute top-2 right-3 text-yellow-700 hover:text-yellow-900" onclick="this.parentElement.remove()">
        &times;
    </button>
</div>
@endif

{{-- Info Message --}}
@if ($message = Session::get('info'))
<div class="mb-4 rounded-lg bg-blue-100 border border-blue-300 text-blue-800 px-4 py-3 relative" role="alert">
    <span class="font-semibold">Info:</span> {{ $message }}
    <button type="button" class="absolute top-2 right-3 text-blue-700 hover:text-blue-900" onclick="this.parentElement.remove()">
        &times;
    </button>
</div>
@endif

{{-- Validation Errors --}}
@if ($errors->any())
<div class="mb-4 rounded-lg bg-red-50 border border-red-300 text-red-800 px-4 py-3 relative" role="alert">
    <p class="font-semibold mb-2">Please correct the following errors to proceed:</p>
    <ul class="list-disc list-inside text-sm space-y-1">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="absolute top-2 right-3 text-red-700 hover:text-red-900" onclick="this.parentElement.remove()">
        &times;
    </button>
</div>
@endif
