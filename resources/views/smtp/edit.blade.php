@extends('layouts.base')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit SMTP Account</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('smtp.update', $smtp->id) }}" method="POST" class="card p-4 shadow-sm border-0">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $smtp->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Host</label>
            <input type="text" name="host" class="form-control" value="{{ $smtp->host }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Port</label>
            <input type="number" name="port" class="form-control" value="{{ $smtp->port }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Encryption</label>
            <select name="encryption" class="form-select">
                <option value="">None</option>
                <option value="ssl" {{ $smtp->encryption == 'ssl' ? 'selected' : '' }}>SSL</option>
                <option value="tls" {{ $smtp->encryption == 'tls' ? 'selected' : '' }}>TLS</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Username (Email)</label>
            <input type="email" name="username" class="form-control" value="{{ $smtp->username }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">New Password <small>(leave blank to keep current)</small></label>
            <input type="text" name="password" class="form-control">
        </div>

        <button class="btn btn-success w-100">Update SMTP Account</button>
    </form>
</div>
@endsection
