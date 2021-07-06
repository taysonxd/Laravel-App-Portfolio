<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Events\ProjectSaved;
use App\Http\Requests\SaveProjectRequest;
use App\Models\Project;
use App\Models\Category;
//Se puede verificar la politica de acceso mediante el facade Gate
//o directamente desde la instancia del controlador "$this->authorize(Gate)"
use Illuminate\Support\Facades\Gate;

class ProjectsController extends Controller
{

    public function __construct() {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index() {
    	return view('projects.index', [
            'newProject' => new Project,
    		'projects' => Project::with('category')->latest()->paginate(),
            'deletedProjects' => Project::onlyTrashed()->get()->isEmpty() ? null : Project::onlyTrashed()->latest()->get()
    	]);
    }

    public function show(Project $project) {
    	return view('projects.show', [
    		'project' => $project
    	]);
    }

    public function create() {
        // Forma 1 : Usando la definicion de una puerta de acceso(facade GATE) con el alias de 'create-projects' que llama al policy del modelo project en el metodo create
        // usando el metodo authorize de la instancia Controller
        $this->authorize('create-projects');

    	return view('projects.create', [
    		'project' => new Project,
            'categories' => Category::pluck('name', 'id'),
    	]);

    }

    public function store(SaveProjectRequest $request) {
        // Forma 2 : Aborta la peticion dependiendo del resultado devuelto por el GATE 'create-projects'
        abort_unless(Gate::allows('create-projects'), 403);

    	$project = new Project( $request->validated() );
        $project->image = $request->file('image')->store('images', 'public');
        
        $project->save();

        ProjectSaved::dispatch($project);

    	return redirect()->route('projects.index')->with('status', 'Proyecto creado correctamente.');

    }

    public function edit(Project $project) {
        //Usando Policy del modelo Project para la accion de 'update' a traves del metodo authorize
        //de la instancia Controller
        $this->authorize('update', $project);

    	return view('projects.edit', [
            'project' => $project,
            'categories' => Category::pluck('name', 'id'),
        ]);
    }

    public function update(Project $project, SaveProjectRequest $request) {

        //Usando Policy del modelo Project
        $this->authorize('update', $project);

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

        $this->authorize('forceDelete', $project);

    	$project->delete();

    	return redirect()->route('projects.index')->with('status', 'Proyecto eliminado correctamente');
    }

    public function restore($projectUrl) {

        $project = Project::onlyTrashed()->where('slug', $projectUrl)->firstOrFail();

        $this->authorize('restore', $project);

        $project->restore();

        return redirect()->route('projects.index')->with('status', 'Proyecto restaurado correctamente');

    }

    public function forceDelete($projectUrl) {

        $project = Project::onlyTrashed()->where('slug', $projectUrl)->firstOrFail();

        $this->authorize('forceDelete', $project);
        
        Storage::delete('public/$project->image');
        $project->forceDelete();

        return redirect()->route('projects.index')->with('status', 'El proyecto ha sido eliminado permanentemente');

    }

}
