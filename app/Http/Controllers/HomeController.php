<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\Modul;
use App\Models\Gallery;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\QuizQuestion;
use App\Models\PlateItem;
use App\Models\NutritionGuess;

class HomeController extends Controller
{
    public function index()
    {
        // Load all settings as key-value array
        $rawSettings = SiteSetting::all();
        $settings = [];
        foreach ($rawSettings as $s) {
            $settings[$s->key] = $s->value;
        }

        $moduls = Modul::latest()->get();
        $galleries = Gallery::latest()->get();
        $teams = Team::orderBy('order', 'asc')->get();
        $testimonials = Testimonial::latest()->get();
        $quizzes = QuizQuestion::all();
        $plateItems = PlateItem::all();
        $guesses = NutritionGuess::all();

        return view('home', compact('settings', 'moduls', 'galleries', 'teams', 'testimonials', 'quizzes', 'plateItems', 'guesses'));
    }

    public function storeTestimonial(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'avatar' => 'nullable|string',
            'avatar_upload' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('avatar_upload')) {
            $path = $request->file('avatar_upload')->store('avatars', 'public');
            $validated['avatar'] = '/storage/' . $path;
        } elseif (empty($validated['avatar'])) {
            $validated['avatar'] = 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=200&q=80';
        }

        Testimonial::create($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Terima kasih! Testimoni & rating Anda berhasil diterbitkan.'
            ]);
        }

        return redirect()->back()->with('success', 'Terima kasih! Testimoni & rating Anda berhasil dikirim.');
    }
}
