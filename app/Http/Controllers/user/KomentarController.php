<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class KomentarController extends Controller
{
    public function index(){
        $komentars = Komentar::all();
        return view('user.komentar.index' ,compact('komentars'));
    }

    public function store(Request $request){
          $request->validate([
        'isi' => 'required|string|max:1000',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    Komentar::create([
        'user_id' => Auth::id(),
        'isi' => $request->isi,
        'rating' => $request->rating,
    ]);

    return redirect()->back()->with('success', 'Komentar & rating berhasil dikirim.');
    }
}
