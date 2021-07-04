<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    
    public function show(Category $category) {
    	return view('projects.index', [
    		'category' => $category->name,
    		'projects' => $category->projects()->with('category')->latest()->paginate(),
    	]);
    }
}
