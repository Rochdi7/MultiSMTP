@extends('layouts.base')

@section('content')
<div class="container">
    <h2 class="mb-4">Add New SMTP Account</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Validation Error:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('smtp.store') }}" method="POST" class="card p-4 shadow-sm border-0">
        @csrf

        <!-- Provider Select -->
        <div class="mb-3">
            <label for="provider" class="form-label">Provider</label>
            <select id="provider" name="provider" class="form-select @error('provider') is-invalid @enderror" required>
                <option value="">-- Select Provider --</option>
                <option value="gmail" {{ old('provider') == 'gmail' ? 'selected' : '' }}>Gmail</option>
                <option value="outlook" {{ old('provider') == 'outlook' ? 'selected' : '' }}>Outlook</option>
            </select>
            @error('provider')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Account Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="e.g. Gmail 1" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Host -->
        <div class="mb-3">
            <label for="host" class="form-label">SMTP Host</label>
            <input type="text" name="host" id="host" class="form-control @error('host') is-invalid @enderror" placeholder="smtp.example.com" value="{{ old('host') }}" required>
            @error('host')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Port -->
        <div class="mb-3">
            <label for="port" class="form-label">Port</label>
            <input type="number" name="port" id="port" class="form-control @error('port') is-invalid @enderror" placeholder="587" value="{{ old('port') }}" required>
            @error('port')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Encryption -->
        <div class="mb-3">
            <label for="encryption" class="form-label">Encryption</label>
            <select name="encryption" id="encryption" class="form-select @error('encryption') is-invalid @enderror">
                <option value="">None</option>
                <option value="ssl" {{ old('encryption') == 'ssl' ? 'selected' : '' }}>SSL</option>
                <option value="tls" {{ old('encryption') == 'tls' ? 'selected' : '' }}>TLS</option>
            </select>
            @error('encryption')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Username -->
        <div class="mb-3">
            <label for="username" class="form-label">Email Address (Username)</label>
            <input type="email" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required>
            @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">SMTP Password / App Password</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Save SMTP Account</button>
    </form>
</div>

<script>
    document.getElementById('provider').addEventListener('change', function () {
        const provider = this.value;

        const hostInput = document.getElementById('host');
        const portInput = document.getElementById('port');
        const encryptionInput = document.getElementById('encryption');
        const nameInput = document.getElementById('name');

        if (provider === 'gmail') {
            if (!hostInput.value) hostInput.value = 'smtp.gmail.com';
            if (!portInput.value) portInput.value = 587;
            if (!encryptionInput.value) encryptionInput.value = 'tls';
            if (!nameInput.value) nameInput.value = 'Gmail';
        } else if (provider === 'outlook') {
            if (!hostInput.value) hostInput.value = 'smtp.office365.com';
            if (!portInput.value) portInput.value = 587;
            if (!encryptionInput.value) encryptionInput.value = 'tls';
            if (!nameInput.value) nameInput.value = 'Outlook';
        } else {
            hostInput.value = '';
            portInput.value = '';
            encryptionInput.value = '';
            nameInput.value = '';
        }
    });
</script>
@endsection
