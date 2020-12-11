<?php

namespace App\Http\Controllers;

use App\Recurso;
use App\RegistroPrestamo;
use Illuminate\Http\Request;

class RegistroPrestamoController extends Controller
{
    public function index(){
        $recursos = Recurso::all();
        $historial= RegistroPrestamo::paginate(10);
        return view("historial_prestamos.historial_index")
            ->with("historiales",$historial)->with("recursos",$recursos);
    }
    public function buscar(Request $request){
        $recursos = Recurso::all();
        $historial =
            RegistroPrestamo::where("nombre","like","%".
                $request->input("busqueda")."%")
        ->orWhere("numero_cuenta","like","%".$request->input("busqueda")."%")
        ->paginate(10);

        return view("historial_prestamos.historial_index")
            ->with("historiales",$historial)
            ->with("recursos",$recursos);
    }

    public function store(Request $request){
        $this->validate($request,[
            "nombre"=>"required",
            "numero_cuenta"=>"required",
            "fecha"=>"required",
            "cantidad"=>"required",
            "id_recurso"=>"required"
        ],[
            "nombre.required"=>"Se requiere el nombre",
            "numero_cuenta.required"=>"Se requiere que ingrese el numero de cuenta.",
            "fecha.required"=>"Se requiere la fecha de creacion",
            "cantidad.required"=>"Se requiere ingresar la cantidad",
            "id_recurso.required"=>"Se requiere seleccionar el recurso a prestar."
        ]);

        $registro = new RegistroPrestamo();
        $registro->nombre=$request->input("nombre");
        $registro->numero_cuenta= $request->input("numero_cuenta");
        $registro->fecha= $request->input("fecha");
        $registro->cantidad= $request->input("cantidad");
        $registro->id_recurso= $request->input("id_recurso");
        $registro->save();

        return redirect()->route("index.historial")->with("exito","Se creo exitosamente el registro");

    }

    public function update(Request $request){
        $this->validate($request,[
            "nombre"=>"required",
            "numero_cuenta"=>"required",
            "fecha"=>"required",
            "cantidad"=>"required",
            "id_recurso"=>"required"
        ],[
            "nombre.required"=>"Se requiere el nombre",
            "numero_cuenta.required"=>"Se requiere que ingrese el numero de cuenta.",
            "fecha.required"=>"Se requiere la fecha de creacion",
            "cantidad.required"=>"Se requiere ingresar la cantidad",
            "id_recurso.required"=>"Se requiere seleccionar el recurso a prestar."
        ]);
        $registro = RegistroPrestamo::findOrFail($request->input("id"));
        $registro->nombre=$request->input("nombre");
        $registro->numero_cuenta= $request->input("numero_cuenta");
        $registro->fecha= $request->input("fecha");
        $registro->cantidad= $request->input("cantidad");
        $registro->id_recurso= $request->input("id_recurso");
        $registro->save();

        return redirect()->route("index.historial")->with("exito","Se edito exitosamente el registro");

    }

    public function destroy(Request $request){
        $registro = RegistroPrestamo::findOrFail($request->input("id"));
        $registro->delete();

        return redirect()->route("index.historial")
            ->with("exito","Se elimino exitosamente el registro");

    }
}
