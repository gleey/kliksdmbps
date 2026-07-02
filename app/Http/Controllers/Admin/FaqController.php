<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqBelum    = Faq::where('is_answered', false)->orderByDesc('created_at')->get();
        $faqTerjawab = Faq::where('is_answered', true)->orderByDesc('answered_at')->get();
        return view('admin.faq.index', compact('faqBelum', 'faqTerjawab'));
    }

    public function answer(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'answer' => 'required|string|max:2000',
        ]);
        $faq->update(['answer' => $data['answer']]);
        return back()->with('success', 'Jawaban berhasil disimpan.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return back()->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
