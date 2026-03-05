<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\AdoptionRequest;
use App\Models\Animal;
use App\Models\Category;
use App\Services\AnimalService;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    protected $animalService;

    public function __construct(AnimalService $animalService)
    {
        $this->animalService = $animalService;
    }

    public function index()
    {
        $user = auth()->user();

        $pendingCount = $user->adoptions()->where('status', 'pending')->count();

        $approvedCount = $user->adoptions()->where('status', 'approved')->count();

        $rejectedCount = $user->adoptions()
            ->whereIn('status', ['rejected', 'auto_rejected'])
            ->count();

        $adoptions = $user->adoptionRequests()
            ->with('animal.images')
            ->latest()
            ->take(3) //menampilkan preview
            ->get();

        $favorites = $user->favorites()
            ->with(['category', 'images'])
            ->latest()
            ->take(3) //menampilkan preview
            ->get();

        $myPosts = Animal::where('created_by', auth()->id())
            ->with(['category', 'images'])
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.profile.index', compact(
            'user',
            'adoptions',
            'favorites',
            'pendingCount',
            'approvedCount',
            'rejectedCount',
            'myPosts'
        ));
    }

    public function myAdoptions()
    {
        $user = auth()->user();

        $adoptions = $user->adoptions()
            ->with(['animal.images'])
            ->latest()
            ->paginate(5);

        return view('frontend.profile.history', compact('user', 'adoptions'));
    }

    public function myFavorites()
    {
        $user = auth()->user();

        $favorites = $user->favorites()
            ->with(['images'])
            ->latest()
            ->paginate(6);

        return view('frontend.profile.favorites', compact('user', 'favorites'));
    }

    public function myPosts()
    {
        $animals = $this->animalService->getUserPosts(auth()->id());

        return view('frontend.profile.my-posts', compact('animals'));
    }

    public function updatePost(Request $request, Animal $animal)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'age_in_months' => 'required|integer|min:0',
            'gender' => 'required',
            'description' => 'required'
        ]);

        $this->animalService->updateUserPost(
            $animal,
            $request->only([
                'name',
                'category_id',
                'age_in_months',
                'gender',
                'description'
            ]),
            auth()->id()
        );

        return redirect()
            ->route('profile.my-posts')
            ->with('success', 'Post updated successfully');
    }

    public function deletePost(Animal $animal)
    {
        $this->animalService->deleteUserPost($animal, auth()->id());

        return redirect()
            ->route('profile.my-posts')
            ->with('success', 'Post deleted');
    }

    public function editPost(Animal $animal)
    {
        $animal = $this->animalService->getUserPostById(
            $animal,
            auth()->id()
        );

        $categories = Category::all();

        return view('frontend.profile.edit-post', compact('animal', 'categories'));
    }
}
