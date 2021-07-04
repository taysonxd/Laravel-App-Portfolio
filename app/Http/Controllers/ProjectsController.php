<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Events\ProjectSaved;
use App\Http\Requests\SaveProjectRequest;
use App\Models\Project;
use App\Models\Category;

class ProjectsController extends Controller
{

    public function __construct() {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index() {
    	return view('projects.index', [
    		'projects' => Project::with('category')->latest()->paginate()
    	]);
    }

    public function show(Project $project) {
    	return view('projects.show', [
    		'project' => $project
    	]);
    }

    public function create() {
    	return view('projects.create', [
    		'project' => new Project,
            'categories' => Category::pluck('name', 'id'),
    	]);
    }

    public function store(SaveProjectRequest $request) {

    	$project = new Project( $request->validated() );
        $project->image = $request->file('image')->store('images', 'public');
        
        $project->save();

        ProjectSaved::dispatch($project);

    	return redirect()->route('projects.index')->with('status', 'Proyecto creado correctamente.');
    }

    public function edit(Project $project) {
    	return view('projects.edit', [
            'project' => $project,
            'categories' => Category::pluck('name', 'id'),
        ]);
    }

    public function update(Project $project, SaveProjectRequest $request) {

        if($request->hasFile('image')){

            Storage::delete("public/$project->image");
            
            $project->fill($request->validated());
            $project->image = $request->file('image')->store('images', 'public');

            $project->save();

            ProjectSaved::dispatch($project);
            
        } else {
            $project->update( array_filter( $request->validated() ) );
        }    	

    	return redirect()->route('projects.show', $project)->with('status', 'Proyecto actualizado correctamente');
    }

    public function destroy(Project $project) {

        Storage::delete("public/$project->image");

    	$project->delete();

    	return redirect()->route('projects.index')->with('status', 'Proyecto eliminado correctamente');
    }
}
