<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Resources\Api\Auth\RegisterResource;
use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request){
        // return $request; 
        DB::beginTransaction();
        try {
             
            // Crear un nuevo usuario
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->country = $request->country;
            $user->city = $request->city;
            $user->phone = $request->phone;
            $user->birthdate = $request->birthdate;

            $user->gender_id = $request->gender_id;
            $user->document_type_id = $request->document_type_id;
            $user->user_type_id = $request->user_type_id;
            $user->document_number = $request->document_number;

            $user->institution_name = $request->institution_name ?? null; // Estudiante 
            $user->academic_program = $request->academic_program ?? null; // Estudiante
            $user->modality_id = $request->modality_id ?? null; // Modalidad del Estudiante
            $user->university = $request->university ?? null; // Campos específicos para Docentes

            $user->company_name = $request->company_name ?? null; // Institución (Trabajador/Funcionario)
            $user->company_position = $request->company_position ?? null; // Institución (Trabajador/Funcionario)
            $user->company_address = $request->company_address ?? null; // Institución (Trabajador/Funcionario)

            $user->entrepreneur_name = $request->entrepreneur_name ?? null;  // Emprendedor
            $user->product_type = $request->product_type ?? null; // Emprendedor

            $user->occupation = $request->occupation ?? null; // Independiente

            $user->status = $request->status ?? true; // Por defecto activo
            $user->accepted_terms = $request->accepted_terms;
            $user->password = Hash::make($request->password);
            $user->save();

            $user->load('modality'); // relaciones con la modalidad 

            Mail::to($user)->send(new WelcomeEmail($user));

            // Revocar tokens previos (por seguridad)
            $user->tokens()->delete();

            // Crear token nuevo
            $token = $user->createToken($user->uuid)->plainTextToken;

            DB::commit();

            // return response()->json(['message' => 'Usuario registrado con éxito', 'user'  => new RegisterResource($user),], 201);
            // Respuesta unificada con LoginController
            return response()->json([
                'user'       => new RegisterResource($user),
                'token'      => $token,
                'token_type' => 'Bearer',
                'message'    => 'Usuario registrado con éxito.',
                'success'    => true,
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error en registro: '.$e->getMessage());
            return response()->json(['message' => 'Error al registrar al usuario'], 500);
        }
     }
}
