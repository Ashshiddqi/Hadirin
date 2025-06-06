<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Presence;
use App\Models\Event;
use Carbon\Carbon;

class ScanController extends Controller
{
    public function showScanner()
    {
        $activeEvent = Event::where('is_active', true)->first();
        return view('scan.index', compact('activeEvent'));
    }

    public function handleScanAjax(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string',
            'event_id' => 'nullable|exists:events,id'
        ]);

        $result = $this->processScan($request->user_id, $request->event_id);

        if ($result['status'] === 'error') {
            return response()->json(['status' => 'error', 'message' => $result['message']]);
        }

        return response()->json(['status' => 'success']);
    }

    public function handleScan(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string',
            'event_id' => 'nullable|exists:events,id'
        ]);

        $result = $this->processScan($request->user_id, $request->event_id);

        if ($result['status'] === 'error') {
            return redirect()->route('scan.error')->with('message', $result['message']);
        }

        return redirect()->route('scan.success')->with([
            'user' => $result['user'],
            'time' => $result['time']->format('H:i:s')
        ]);
    }

    private function processScan($userId, $eventId)
    {
        $user = User::where('user_id', $userId)->first();
        if (!$user) {
            return ['status' => 'error', 'message' => 'ID anggota tidak ditemukan'];
        }

        $now = now();
        $alreadyScanned = Presence::where('user_id', $user->id)
            ->when($eventId, fn($q) => $q->where('event_id', $eventId))
            ->where('scan_time', '>', $now->subMinutes(5))
            ->exists();

        if ($alreadyScanned) {
            return ['status' => 'error', 'message' => 'Anda sudah melakukan presensi dalam 5 menit terakhir'];
        }

        Presence::create([
            'user_id' => $user->id,
            'event_id' => $eventId,
            'scan_time' => $now
        ]);

        return ['status' => 'success', 'user' => $user, 'time' => $now];
    }

    public function scanSuccess()
    {
        if (!session()->has('user')) {
            return redirect()->route('scan.show');
        }

        return view('scan.success', [
            'user' => session('user'),
            'time' => session('time')
        ]);
    }

    public function scanError()
    {
        return view('scan.error', [
            'message' => session('message', 'Terjadi kesalahan saat memproses presensi')
        ]);
    }

    

    
}
