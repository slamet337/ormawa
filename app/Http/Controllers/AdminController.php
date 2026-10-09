<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\Modul;
use App\Models\Gallery;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\Message;
use App\Models\QuizQuestion;
use App\Models\QuizSubmission;
use App\Models\PlateItem;
use App\Models\NutritionGuess;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'moduls' => Modul::count(),
            'galleries' => Gallery::count(),
            'teams' => Team::count(),
            'testimonials' => Testimonial::count(),
            'messages' => Message::count(),
            'unread_messages' => Message::where('is_read', false)->count(),
            'quizzes' => QuizQuestion::count(),
        ];

        $recent_messages = Message::latest()->take(5)->get();
        $recent_moduls = Modul::latest()->take(4)->get();

        return view('admin.dashboard', compact('stats', 'recent_messages', 'recent_moduls'));
    }

    // Site Settings
    public function settings()
    {
        $settings = SiteSetting::all()->pluck('value', 'key')->toArray();
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $data = $request->except('_token');
        foreach ($data as $key => $val) {
            SiteSetting::set($key, $val);
        }

        return redirect()->back()->with('success', 'Pengaturan situs berhasil diperbarui!');
    }

    // Moduls CMS
    public function moduls()
    {
        $moduls = Modul::latest()->get();
        $dbCategories = Modul::select('category')->whereNotNull('category')->distinct()->pluck('category')->toArray();
        $defaultCategories = ['Kimia & Nutrisi', 'Resep & MP-ASI', 'Panduan Kader', 'Kesehatan Lingkungan'];
        $categories = array_values(array_unique(array_merge($defaultCategories, $dbCategories)));

        return view('admin.moduls', compact('moduls', 'categories'));
    }

    public function storeModul(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'badge' => 'nullable|string|max:50',
            'cover_image' => 'nullable|string',
            'cover_image_upload' => 'nullable|image|max:10240',
            'file_url' => 'nullable|string',
            'file_upload' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip,rar,xls,xlsx,mp4,avi,mkv|max:524288',
        ]);

        if ($request->hasFile('cover_image_upload')) {
            $path = $request->file('cover_image_upload')->store('covers', 'public');
            $validated['cover_image'] = '/storage/' . $path;
        } elseif (empty($validated['cover_image'])) {
            $validated['cover_image'] = 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?auto=format&fit=crop&w=600&q=80';
        }

        if ($request->hasFile('file_upload')) {
            $path = $request->file('file_upload')->store('moduls', 'public');
            $validated['file_path'] = $path;
        }

        Modul::create($validated);

        return redirect()->back()->with('success', 'Modul edukasi baru berhasil ditambahkan!');
    }

    public function updateModul(Request $request, $id)
    {
        $modul = Modul::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'badge' => 'nullable|string|max:50',
            'cover_image' => 'nullable|string',
            'cover_image_upload' => 'nullable|image|max:10240',
            'file_url' => 'nullable|string',
            'file_upload' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip,rar,xls,xlsx,mp4,avi,mkv|max:524288',
        ]);

        if ($request->hasFile('cover_image_upload')) {
            $path = $request->file('cover_image_upload')->store('covers', 'public');
            $validated['cover_image'] = '/storage/' . $path;
        }

        if ($request->hasFile('file_upload')) {
            if ($modul->file_path) {
                Storage::disk('public')->delete($modul->file_path);
            }
            $validated['file_path'] = $request->file('file_upload')->store('moduls', 'public');
        }

        $modul->update($validated);

        return redirect()->back()->with('success', 'Modul berhasil diperbarui!');
    }

    public function deleteModul($id)
    {
        $modul = Modul::findOrFail($id);
        if ($modul->file_path) {
            Storage::disk('public')->delete($modul->file_path);
        }
        $modul->delete();

        return redirect()->back()->with('success', 'Modul berhasil dihapus!');
    }

    // Gallery CMS
    public function galleries()
    {
        $galleries = Gallery::latest()->get();
        $dbCategories = Gallery::select('category')->whereNotNull('category')->distinct()->pluck('category')->toArray();
        $defaultCategories = ['Sosialisasi', 'Pelatihan', 'Demo Masak', 'Posyandu', 'Game Edukasi', 'Kerja Tim'];
        $categories = array_values(array_unique(array_merge($defaultCategories, $dbCategories)));

        return view('admin.galleries', compact('galleries', 'categories'));
    }

    public function storeGallery(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'caption' => 'nullable|string',
            'event_date' => 'nullable|date',
            'image_path' => 'nullable|string',
            'image_upload' => 'nullable|image|max:10240',
        ]);

        if ($request->hasFile('image_upload')) {
            $path = $request->file('image_upload')->store('gallery', 'public');
            $validated['image_path'] = '/storage/' . $path;
        } elseif (empty($validated['image_path'])) {
            $validated['image_path'] = 'https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?auto=format&fit=crop&w=800&q=80';
        }

        Gallery::create($validated);

        return redirect()->back()->with('success', 'Foto galeri berhasil ditambahkan!');
    }

    public function updateGallery(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'caption' => 'nullable|string',
            'event_date' => 'nullable|date',
            'image_path' => 'nullable|string',
            'image_upload' => 'nullable|image|max:10240',
        ]);

        if ($request->hasFile('image_upload')) {
            $path = $request->file('image_upload')->store('gallery', 'public');
            $validated['image_path'] = '/storage/' . $path;
        }

        $gallery->update($validated);

        return redirect()->back()->with('success', 'Foto galeri berhasil diperbarui!');
    }

    public function deleteGallery($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();
        return redirect()->back()->with('success', 'Foto galeri berhasil dihapus!');
    }

    // Teams CMS
    public function teams()
    {
        $teams = Team::orderBy('order', 'asc')->get();
        return view('admin.teams', compact('teams'));
    }

    public function storeTeam(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'division' => 'required|string|max:255',
            'photo' => 'nullable|string',
            'photo_upload' => 'nullable|image|max:5120',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('photo_upload')) {
            $path = $request->file('photo_upload')->store('teams', 'public');
            $validated['photo'] = '/storage/' . $path;
        }

        Team::create($validated);

        return redirect()->back()->with('success', 'Anggota tim berhasil ditambahkan!');
    }

    public function updateTeam(Request $request, $id)
    {
        $team = Team::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'division' => 'required|string|max:255',
            'photo' => 'nullable|string',
            'photo_upload' => 'nullable|image|max:5120',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('photo_upload')) {
            if ($team->photo && str_starts_with($team->photo, '/storage/')) {
                $oldPath = str_replace('/storage/', '', $team->photo);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('photo_upload')->store('teams', 'public');
            $validated['photo'] = '/storage/' . $path;
        }

        $team->update($validated);

        return redirect()->back()->with('success', 'Data anggota tim berhasil diperbarui!');
    }

    public function deleteTeam($id)
    {
        $team = Team::findOrFail($id);
        if ($team->photo && str_starts_with($team->photo, '/storage/')) {
            $oldPath = str_replace('/storage/', '', $team->photo);
            Storage::disk('public')->delete($oldPath);
        }
        $team->delete();
        return redirect()->back()->with('success', 'Anggota tim berhasil dihapus!');
    }

    // Testimonials CMS
    public function testimonials()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonials', compact('testimonials'));
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

        return redirect()->back()->with('success', 'Testimoni berhasil ditambahkan!');
    }

    public function updateTestimonial(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
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
        }

        $testimonial->update($validated);

        return redirect()->back()->with('success', 'Testimoni berhasil diperbarui!');
    }

    public function deleteTestimonial($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();
        return redirect()->back()->with('success', 'Testimoni berhasil dihapus!');
    }

    // Messages Inbox
    public function messages()
    {
        $messages = Message::latest()->get();
        Message::where('is_read', false)->update(['is_read' => true]);
        return view('admin.messages', compact('messages'));
    }

    public function deleteMessage($id)
    {
        $msg = Message::findOrFail($id);
        $msg->delete();
        return redirect()->back()->with('success', 'Pesan berhasil dihapus!');
    }

    // Quizzes CMS
    public function quizzes()
    {
        $quizzes = QuizQuestion::latest()->get();
        $submissions = QuizSubmission::latest()->get();
        return view('admin.quizzes', compact('quizzes', 'submissions'));
    }

    public function deleteQuizSubmission($id)
    {
        $submission = QuizSubmission::findOrFail($id);
        $submission->delete();
        return redirect()->back()->with('success', 'Riwayat hasil kuis pengunjung berhasil dihapus!');
    }

    public function storeQuiz(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_option' => 'required|in:a,b,c,d',
            'explanation' => 'nullable|string',
        ]);

        QuizQuestion::create($validated);

        return redirect()->back()->with('success', 'Pertanyaan kuis baru berhasil ditambahkan!');
    }

    public function updateQuiz(Request $request, $id)
    {
        $quiz = QuizQuestion::findOrFail($id);
        $validated = $request->validate([
            'question' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_option' => 'required|in:a,b,c,d',
            'explanation' => 'nullable|string',
        ]);

        $quiz->update($validated);

        return redirect()->back()->with('success', 'Pertanyaan kuis berhasil diperbarui!');
    }

    public function deleteQuiz($id)
    {
        $quiz = QuizQuestion::findOrFail($id);
        $quiz->delete();
        return redirect()->back()->with('success', 'Pertanyaan kuis berhasil dihapus!');
    }

    // Plate Items CMS (Susun Piring Sehat)
    public function plateItems()
    {
        $items = PlateItem::all();
        return view('admin.plate_items', compact('items'));
    }

    public function storePlateItem(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:50',
            'category' => 'required|in:karbohidrat,protein,sayuran,buah',
        ]);

        PlateItem::create($validated);

        return redirect()->back()->with('success', 'Item makanan Susun Piring berhasil ditambahkan!');
    }

    public function updatePlateItem(Request $request, $id)
    {
        $item = PlateItem::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:50',
            'category' => 'required|in:karbohidrat,protein,sayuran,buah',
        ]);

        $item->update($validated);

        return redirect()->back()->with('success', 'Item makanan Susun Piring berhasil diperbarui!');
    }

    public function deletePlateItem($id)
    {
        $item = PlateItem::findOrFail($id);
        $item->delete();
        return redirect()->back()->with('success', 'Item makanan Susun Piring berhasil dihapus!');
    }

    // Nutrition Guesses CMS (Tebak Nutrisi)
    public function guesses()
    {
        $guesses = NutritionGuess::latest()->get();
        return view('admin.guesses', compact('guesses'));
    }

    public function storeGuess(Request $request)
    {
        $validated = $request->validate([
            'food_name' => 'required|string|max:255',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_option' => 'required|in:a,b,c,d',
            'explanation' => 'nullable|string',
        ]);

        NutritionGuess::create($validated);

        return redirect()->back()->with('success', 'Soal Tebak Nutrisi baru berhasil ditambahkan!');
    }

    public function updateGuess(Request $request, $id)
    {
        $guess = NutritionGuess::findOrFail($id);
        $validated = $request->validate([
            'food_name' => 'required|string|max:255',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_option' => 'required|in:a,b,c,d',
            'explanation' => 'nullable|string',
        ]);

        $guess->update($validated);

        return redirect()->back()->with('success', 'Soal Tebak Nutrisi berhasil diperbarui!');
    }

    public function deleteGuess($id)
    {
        $guess = NutritionGuess::findOrFail($id);
        $guess->delete();
        return redirect()->back()->with('success', 'Soal Tebak Nutrisi berhasil dihapus!');
    }
}
