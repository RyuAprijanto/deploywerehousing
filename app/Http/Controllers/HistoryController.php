<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class HistoryController extends Controller
{
    public function showHistory()
    {
        $history = History::with('user')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);;
            
        return view('history', compact('history'));
    }
    
}
