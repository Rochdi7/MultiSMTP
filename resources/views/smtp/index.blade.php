@extends('layouts.base')

@section('content')
<div class="container">
    <h2 class="mb-4">My SMTP Accounts</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('smtp.create') }}" class="btn btn-primary mb-3">➕ Add New SMTP</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Email (Username)</th>
                <th>Host</th>
                <th>Port</th>
                <th>Encryption</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($smtpAccounts as $account)
            <tr>
                <td>{{ $account->name }}</td>
                <td>{{ $account->username }}</td>
                <td>{{ $account->host }}</td>
                <td>{{ $account->port }}</td>
                <td>{{ $account->encryption ?? 'None' }}</td>
                <td>
                    <a href="{{ route('smtp.edit', $account->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('smtp.destroy', $account->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this SMTP account?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No SMTP accounts found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
