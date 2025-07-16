<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rsvp;
use Illuminate\Support\Facades\Mail;
use App\Mail\RsvpNotification;

class RsvpController extends Controller
{
    /**
     * Display a listing of RSVPs (admin only)
     */
    public function index()
    {
        $rsvps = Rsvp::latest()->paginate(20);
        return view('admin.rsvp.index', compact('rsvps'));
    }

    /**
     * Store a new RSVP
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:10',
            'guests' => 'required|integer|min:1|max:10',
            'message' => 'nullable|string|max:500'
        ]);

        $rsvp = Rsvp::create($validated);

        // Send email notification
        Mail::to('joelale_18@outlook.com')->send(new RsvpNotification($rsvp));
        
        // Optionally send to multiple recipients
        // Mail::to(['email1@example.com', 'email2@example.com'])->send(new RsvpNotification($rsvp));

        return redirect()->route('rsvp.thank-you')->with('success', '¡Gracias por confirmar tu asistencia!');
    }

    /**
     * Display thank you page after RSVP
     */
    public function thankYou()
    {
        return view('invitation.thank-you');
    }

    /**
     * Remove the specified RSVP (admin only)
     */
    public function destroy($id)
    {
        $rsvp = Rsvp::findOrFail($id);
        $rsvp->delete();

        return redirect()->route('admin.rsvp.index')->with('success', 'RSVP eliminado correctamente.');
    }
}