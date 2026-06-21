<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //mostrar tabla con todos los alumnos
        $alumnos = Alumno::paginate(5); // Paginación de 5 alumnos por página
        return view('alumnos.index', compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //solo mandar a la vista el formulario para crear un nuevo alumno
        return view('alumnos.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    //Guardar el nuevo alumno en la base de datos
    public function store(Request $request)
    {
        //validamos los datos del formulario
        $validated = $request->validate([
            'nombre'    => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'unique:alumnos,email'],
            //rule vale para los enums
            'nivel'     => ['required', Rule::in(['basico', 'intermedio', 'avanzado'])],
            'es_becado' => ['sometimes', 'boolean'],
        ]);
        //si el checkbox de es_becado no está marcado, se le asigna el valor false
        $validated['es_becado'] = $request->has('es_becado'); // Checkbox logic
        // creamos el nuevo alumno con los datos validados
        Alumno::create($validated);
        // redirigimos a la vista de la lista de alumnos
        return redirect()->route('alumnos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumno $alumno)
    {
        //mostrar
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alumno $alumno)
    {
        //redirigimos a la vista del formulario de edición, pasando el alumno a editar
        return view('alumnos.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     */

    //RECIBE DEL EDIT el request con los datos y actualiza el alumno
    public function update(Request $request, Alumno $alumno)
    {
        //validamos los datos del formulario
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            // para el email, además de ser requerido, debe ser un email válido y único en la tabla de alumnos, pero ignorando el email del alumno que se está editando
            'email' => ['required', 'email', Rule::unique('alumnos', 'email')->ignore($alumno->id)],
            'nivel' => ['required', Rule::in(['basico', 'intermedio', 'avanzado'])],
        ]);
        //actualizamos el alumno con los datos validados
        $alumno->update($validated);
        //redirigimos a la vista de la lista de alumnos
        return redirect()->route('alumnos.index');
    }

    public function destroy(Alumno $alumno)
    {
        //borra el alumno de la base de datos
        $alumno->delete();
        return redirect()->route('alumnos.index')->with('success', 'Alumno eliminado correctamente.');
    }
}
