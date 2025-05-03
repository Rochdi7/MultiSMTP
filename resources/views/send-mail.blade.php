@extends('layouts.base')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h2 class="mb-4 text-center">📤 Send Email</h2>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('send.email') }}" method="POST" class="card p-4 shadow-sm border-0">
            @csrf

            {{-- From (SMTP Account) --}}
            <div class="mb-3">
                <label for="smtp_account_id" class="form-label">From:</label>
                <select name="smtp_account_id" id="smtp_account_id" class="form-select @error('smtp_account_id') is-invalid @enderror" required>
                    <option value="" disabled selected>-- Select SMTP Account --</option>
                    @foreach($smtpAccounts as $account)
                        <option value="{{ $account->id }}" {{ old('smtp_account_id') == $account->id ? 'selected' : '' }}>
                            {{ $account->name }} ({{ $account->username }})
                        </option>
                    @endforeach
                </select>
                @error('smtp_account_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- To --}}
            <div class="mb-3">
                <label for="to" class="form-label">To:</label>
                <input type="email" name="to" id="to" value="{{ old('to') }}" class="form-control @error('to') is-invalid @enderror" placeholder="recipient@example.com" required>
                @error('to')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Subject --}}
            <div class="mb-3">
                <label for="subject" class="form-label">Subject:</label>
                <input type="text" name="subject" id="subject" value="{{ old('subject') }}" class="form-control @error('subject') is-invalid @enderror" placeholder="Subject line" required>
                @error('subject')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Message --}}
            <div class="mb-3">
                <label for="message" class="form-label">Message:</label>
                <textarea name="message" id="message" rows="6" class="form-control @error('message') is-invalid @enderror" placeholder="Type your message..." required>{{ old('message') }}</textarea>
                @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="btn btn-primary w-100">Send Email</button>
        </form>
    </div>
</div>
@endsection
