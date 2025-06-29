<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SessionModel;

class SessionController extends Controller
{
    // Display all sessions
    public function index()
    {
        $sessions = SessionModel::all();
        return view('sessions.index', compact('sessions'));
    }
    public function paymentSession()
    {
        $sessions = SessionModel::all();
        return view('payment.session', compact('sessions'));
    }
    // Store a new session
    public function store(Request $request)
    {
        $request->validate([
            'session' => 'required|string|max:255',
            'year' => 'required|max:255',
            'batch' => 'required|string|max:255',
        ]);

        SessionModel::create($request->only('session', 'batch','year'));

        return redirect()->route('sessions.index')->with('success', 'Session created successfully.');
    }
    // Update a session
    public function update(Request $request, $id)
    {
        $request->validate([
            'session' => 'required|string|max:255',
            'batch' => 'required|string|max:255',
                 'year' => 'required|max:255',
        ]);

        $session = SessionModel::findOrFail($id);
        $session->update($request->only('session', 'batch', 'year'));

        return redirect()->route('sessions.index')->with('success', 'Session updated successfully.');
    }

    // Delete a session
    public function destroy($id)
    {
        $session = SessionModel::findOrFail($id);
        $session->delete();

        return redirect()->route('sessions.index')->with('success', 'Session deleted successfully.');
    }
}
