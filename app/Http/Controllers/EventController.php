<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Tampilkan daftar event
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    // Tampilkan form tambah event
    public function create()
    {
        return view('events.create');
    }

    // Simpan event baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        return redirect()->route('events.index')->with('success', 'Event berhasil ditambahkan.');
    }

    // Tampilkan form edit
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    // Proses update event
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        return redirect()->route('events.index')->with('success', 'Event berhasil diperbarui.');
    }

    // Hapus event
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event berhasil dihapus.');
    }
}
