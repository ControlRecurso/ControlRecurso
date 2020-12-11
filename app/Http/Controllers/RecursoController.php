<?php

namespace App\Http\Controllers;

use App\Recurso;
use Illuminate\Http\Request;

class RecursoController extends Controller
{
    public function index()
    {
        $recursos = Recurso::paginate(10);
        return view("recurso.recursos_index")->with("recursos", $recursos);
    }

    public function buscar(Request $request)
    {
        $recursos = Recurso::where("nombre", "like", "%" . $request->input('busqueda') . "%")
            ->orWhere("cantidad", "like", "%" . $request->input("busqueda") . "%")
            ->paginate(10);
        return view("recurso.recursos_index")->with("recursos", $recursos);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "nombre" => "required",

        ], ["nombre.required" => "Se requiere que ingrese el nombre"]);

        $nuevoRecurso = new Recurso();
        $nuevoRecurso->nombre = $request->input("nombre");
        $nuevoRecurso->cantidad = $request->input("cantidad");
        $nuevoRecurso->save();


        return redirect()->route("recursos.index")->with("exito", "Se creo exitosamente.");

    }

    public function update(Request $request){
        $this->validate($request, [
            "nombre" => "required",

        ], ["nombre.required" => "Se requiere que ingrese el nombre"]);

        $editarRecurso= Recurso::findOrFail($request->input("id"));
        $editarRecurso->nombre= $request->input("nombre");
        $editarRecurso->cantidad= $request->input("cantidad");

        $editarRecurso->save();

        return redirect()->route("recursos.index")
            ->with("exito", "Se edito exitosamente.");
    }

    public function destroy(Request $request)
    {
        $recurso = Recurso::findOrFail($request->input("id"));
        $recurso->delete();

        return redirect()->route("recursos.index")
            ->with("exito", "Se elimino exitosamente.");

    }
}
