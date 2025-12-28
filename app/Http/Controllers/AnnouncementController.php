<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the announcements.
     */
    public function index()
    {
        $allAnnouncements = Announcement::where('status', 'published')->latest('date')->paginate(10);
        return view('announcements.index', compact('allAnnouncements'));
    }
}
