// ...existing code...

<form method="POST" action="{{ route('logout') }}" class="w-full">
    @csrf
    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
        <i class="bi bi-box-arrow-right mr-2"></i> Logout
    </button>
</form>

// ...existing code...
