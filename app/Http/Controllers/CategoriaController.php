<?php

namespace App\Http\Controllers;

use App\Exceptions\SomethingWentWrong;
use App\Http\Resources\CategoriasResource;
use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    /**
     * @OA\Get(
     *     tags={"Categorias"},
     *     path="/api/categorias",
     *    summary="Obtener todas las categorias",
     *     description="Obtener todas las categorias",
     *     operationId="index_categoria",
     * @OA\Response(
     *    response=200,
     *    description="Successful Response",
     *    @OA\JsonContent(@OA\Property(property="data", type="Json", example="[...]"),
     *        )
     * ),
     *  @OA\Response(
     *    response=401,
     *    description="Bad Request",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthenticated")
     *        )
     *     ),
     * )
     */
    public function index()
    {
       try{

        $categoria = Categorias::factory()->count(10)->create();
        return CategoriasResource::collection($categoria);

        $categoria = Categorias::all();
        return CategoriasResource::collection($categoria);

       }catch(\Throwable $th){
           throw new SomethingWentWrong($th);
       }


    }



    /**
     * @OA\Post(
     *        tags={"Categorias"},
     *        path="/api/categorias",
     *        summary="Crear una categoria",
     *        operationId="store_categoria",
     *  @OA\RequestBody(
     *      required=true,
     *      description="Datos de la categoria",
     *  @OA\JsonContent(
     *      required={"nombre","descripcion"},
     *          @OA\Property(property="nombre", type="string", example="Categoria 1"),
     *          @OA\Property(property="descripcion", type="string", example="Categoria 1"),
     *      )
     *  ),
     *  @OA\Response(
     *    response=201,
     *    description="Successful Response",
     *    @OA\JsonContent(@OA\Property(property="data", type="Json", example="{...}"),
     *        )
     * ),
     *  @OA\Response(
     *    response=401,
     *    description="Bad Request",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthenticated")
     *        )
     *     ),
     * )
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|unique:categorias,nombre',
            'descripcion' => 'required',
        ]);

        try {
            $categoria = new Categorias();
            $categoria->nombre = $request->nombre;
            $categoria->descripcion = $request->descripcion;
            $categoria->save();

            return new CategoriasResource($categoria);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }

    }



    /**
     * @OA\delete(
     *     tags={"Categorias"},
     *     path="/api/categorias/{categoria}",
     *    summary="Obtener una categoria",
     *     description="Obtener una categoria",
     *     operationId="show_categoria",
     * @OA\Parameter(
     *    description="ID de la categoria",
     *    in="path",
     *    name="categoria",
     *    required=true,
     *    example="1",
     *    @OA\Schema(
     *       type="integer",
     *       format="int64"
     *    )
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Successful Response",
     *    @OA\JsonContent(@OA\Property(property="data", type="Json", example="{...}"),
     *        )
     * ),
     *  @OA\Response(
     *    response=401,
     *    description="Bad Request",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthenticated")
     *        )
     *     ),
     * )
     */
    public function destroy(Categorias $categoria)
    {
        try {
            $categoria->productos()->detach();
            $categoria->delete();
            return response()->json(['message' => 'Categoria eliminada correctamente'], 200);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

}
