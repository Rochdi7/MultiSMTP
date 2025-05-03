<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\SmtpAccount;
use App\Mail\MultiSmtpMail;

class MailController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'smtp_account_id' => 'required|exists:smtp_accounts,id',
            'to' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        $account = SmtpAccount::findOrFail($request->smtp_account_id);

        config([
            'mail.mailers.smtp.transport' => $account->driver,
            'mail.mailers.smtp.host' => $account->host,
            'mail.mailers.smtp.port' => $account->port,
            'mail.mailers.smtp.encryption' => $account->encryption,
            'mail.mailers.smtp.username' => $account->username,
            'mail.mailers.smtp.password' => decrypt($account->password),
            'mail.from.address' => $account->username,
            'mail.from.name' => $account->name,
        ]);

        Mail::mailer('smtp')->to($request->to)->send(
            new MultiSmtpMail($request->subject, $request->message)
        );

        return back()->with('success', 'Email sent successfully!');
    }

    public function showForm()
    {
        $smtpAccounts = SmtpAccount::all();
        return view('send-mail', compact('smtpAccounts'));
    }

    public function dashboard()
    {
        return view('dashboard', ['logs' => []]);
    }

    public function index()
    {
        $smtpAccounts = SmtpAccount::all();
        return view('smtp.index', compact('smtpAccounts'));
    }

    public function create()
    {
        return view('smtp.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'host' => 'required|string',
            'port' => 'required|numeric',
            'encryption' => 'nullable|string',
            'username' => 'required|email',
            'password' => 'required|string',
        ]);

        SmtpAccount::create([
            'name' => $request->name,
            'driver' => 'smtp',
            'host' => $request->host,
            'port' => $request->port,
            'encryption' => $request->encryption,
            'username' => $request->username,
            'password' => encrypt($request->password),
        ]);

        return redirect()->route('smtp.index')->with('success', 'SMTP account added!');
    }

    public function edit($id)
    {
        $smtp = SmtpAccount::findOrFail($id);
        return view('smtp.edit', compact('smtp'));
    }

    public function update(Request $request, $id)
    {
        $smtp = SmtpAccount::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'host' => 'required|string',
            'port' => 'required|numeric',
            'encryption' => 'nullable|string',
            'username' => 'required|email',
            'password' => 'nullable|string',
        ]);

        $smtp->update([
            'name' => $request->name,
            'host' => $request->host,
            'port' => $request->port,
            'encryption' => $request->encryption,
            'username' => $request->username,
            'password' => $request->password ? encrypt($request->password) : $smtp->password,
        ]);

        return redirect()->route('smtp.index')->with('success', 'SMTP account updated!');
    }

    public function destroy($id)
    {
        $smtp = SmtpAccount::findOrFail($id);
        $smtp->delete();

        return redirect()->route('smtp.index')->with('success', 'SMTP account deleted!');
    }
}
