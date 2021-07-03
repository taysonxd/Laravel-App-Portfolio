<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Requests\SaveProjectRequest;

class ProjectsController extends Controller
{

    public function __construct() {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index() {
    	return view('projects.index', [
    		'projects' => Project::latest()->paginate()
    	]);
    }

    public function show(Project $project) {
    	return view('projects.show', [
    		'project' => $project
    	]);
    }

    public function create() {
    	return view('projects.create', [
    		'project' => new Project
    	]);
    }

    public function store(SaveProjectRequest $request) {

    	$project = new Project( $request->validated() );
        $project->image = $request->file('image')->store('images', 'public');        
        
        $project->save();

    	return redirect()->route('projects.index')->with('status', 'Proyecto creado correctamente.');
    }

    public function edit(Project $project) {
    	return view('projects.edit', compact('project'));
    }

    public function update(Project $project, SaveProjectRequest $request) {

    	$project->update($request->validated());

    	return redirect()->route('projects.show', $project)->with('status', 'Proyecto actualizado correctamente');
    }

    public function destroy(Project $project) {

    	$project->delete();

    	return redirect()->route('projects.index')->with('status', 'Proyecto eliminado correctamente');
    }
}
