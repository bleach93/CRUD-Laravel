<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['empleados']=Empleados::paginate(5); // Paginación de datos de 5 en 5.
        return view('empleados.index',$datos); // Retorno de vista empleados/index
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empleados.create'); // Se retorna la vista de creación de empleados
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        //Validación 
        $campos=[
            'nombre' => 'required|string|max:191',
            'apePat' => 'required|string|max:191',
            'apeMat' => 'required|string|max:191',
            'correo' => 'required|email',
            'foto' => 'required|max:10000|mimes:jpeg, png, jpg'
        ];

        $mensaje=["required"=>'El :attribute es requerido'];

        $this->validate($request,$campos,$mensaje);

        $datosEmpleado = request()->except('_token'); // Recepción de información exceptuando _token 

        if($request->hasFile('foto')){ // Se valida el campo foto 

            $datosEmpleado['foto']=$request->file('foto')->store('uploads','public'); // Modificar foto y almacenarlo en uploads

        }

        Empleados::insert($datosEmpleado);

       // return response()->json($datosEmpleado); // Prueba.

       return redirect('empleados')->with('mensaje','Empleado agregado con exito'); // Se redirecciona a empleados y se agrega el valor de empleado agregado con éxito
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function show(Empleados $empleados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $empleados = Empleados::findOrFail($id); // Se consulta para obtener la información antigua

        return view('empleados.edit',compact('empleados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $campos=[
            'nombre' => 'required|string|max:191',
            'apePat' => 'required|string|max:191',
            'apeMat' => 'required|string|max:191',
            'correo' => 'required|email',
        ];

        if($request->hasFile('foto')){ // Se valida si se tiene una fotografía
            $campos+=['foto' => 'required|max:10000|mimes:jpeg,png,jpg'];
        }

        $mensaje=["required"=>'El :attribute es requerido'];

        $this->validate($request,$campos,$mensaje);

        $datosEmpleado = request()->except(['_token', '_method']); // Recepción de información exceptuando _token y _method.

        if($request->hasFile('foto')){ // Se pregunta si hay foto, si la hay hacer la carga 

            $empleados = Empleados::findOrFail($id); // Se consulta primero para obtener la información antigua

            Storage::delete('public/'.$empleados->foto); // Se borra la antigua foto.

            $datosEmpleado['foto']=$request->file('foto')->store('uploads','public'); // Modificar foto y almacenarlo en uploads

        }

        Empleados::where('id','=',$id)->update($datosEmpleado); // Se ejecuta la sentancia SQL buscando el id del empleado.

        //$empleados = Empleados::findOrFail($id); // Se consulta segundo para obtener la información nueva

        //return view('empleados.edit',compact('empleados'));
        return redirect('empleados')->with('mensaje','Empleado modificado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $empleados = Empleados::findOrFail($id);

        if(Storage::delete('public/'.$empleados->foto)){
            Empleados::destroy($id);
        }

        return redirect('empleados')->with('mesaje','Empleado eliminado con exito'); //Retorna a empleados después de borrar el id del empleado
    }
}
