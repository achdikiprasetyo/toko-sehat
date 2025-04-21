<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['user', 'checkout'])->latest()->get();
        return view('admin.ulasan.index', compact('reviews'));
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil dihapus.');
    }
}
