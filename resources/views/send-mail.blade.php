@extends('layouts.base')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4">📤 Send Email</h2>

            <form action="{{ route('send.email') }}" method="POST" class="card p-4 shadow-sm border-0">
                @csrf

                <!-- From -->
                <div class="mb-3">
                    <label for="smtp_account_id" class="form-label">From:</label>
                    <select name="smtp_account_id" id="smtp_account_id" class="form-select" required>
                        @foreach($smtpAccounts as $account)
                            <option value="{{ $account->id }}">{{ $account->name }} ({{ $account->username }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- To -->
                <div class="mb-3">
                    <label for="to" class="form-label">To:</label>
                    <input type="email" name="to" id="to" class="form-control" placeholder="example@example.com" required>
                </div>

                <!-- Subject -->
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject:</label>
                    <input type="text" name="subject" id="subject" class="form-control" placeholder="Email subject" required>
                </div>

                <!-- Message -->
                <div class="mb-3">
                    <label for="message" class="form-label">Message:</label>
                    <textarea name="message" id="message" rows="6" class="form-control" placeholder="Type your message here..." required></textarea>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary w-100">Send Email</button>
            </form>
        </div>
    </div>
@endsection
