<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;


class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       $recipes = Recipe::with(['category', 'tags'])->latest()->get();
        return view('recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
        //
    return view('recipes.create', [
        'categories' => Category::all(),
        'tags' => Tag::all()
    ]);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'ingredients' => ['required', 'string'],
            'instructions' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'tags' => ['array'],
            'tags.*' => ['exists:tags,id']
        ]);
        $tags = $data['tags'] ?? [];
        unset($data['tags']);
        $recipe = Recipe::create($data);
        $recipe->tags()->attach($tags);
        return redirect()->route('recipes.show', $recipe)->with('success', "Recipe Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        //
        $recipe->load(['category', 'tags']);
        return view('recipes.show', compact('recipe'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        //
        return view('recipes.edit', [
            'recipe' => $recipe,
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        //
         $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'ingredients' => ['required', 'string'],
            'instructions' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'tags' => ['array'],
            'tags.*' => ['exists:tags,id']
        ]);
        $recipe->update($data);
        $recipe->tags()->sync($data['tags'] ?? []);
        return redirect()->route('recipes.show', $recipe)->with('success', "Recipe Updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        //
        $recipe->delete();
                return redirect()->route('recipes.index')->with('success', "Recipe deleted");

    }
    
   
}
