<?php

namespace App\Http\Controllers;

use App\Exceptions\SomethingWentWrong;
use App\Http\Resources\ProductosResource;
use App\Models\categoria_productos;
use App\Models\CategoriaProducto;
use App\Models\Productos;
use Illuminate\Http\Request;


class ProductoController extends Controller
{

    /**
     * @OA\Get(
     *     tags={"Productos"},
     *     path="/api/productos",
     *    summary="Obtener todos los productos",
     *     description="Obtener todos los productos",
     *     operationId="index_producto",
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
        try {
            $productos = Productos::all();
            return ProductosResource::collection($productos);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * @OA\Post(
     *        tags={"Productos"},
     *        path="/api/productos",
     *        summary="Crear un producto",
     *        operationId="store_producto",
     *  @OA\RequestBody(
     *      required=true,
     *      description="Datos del producto",
     *  @OA\JsonContent(
     *      required={"nombre","precio","cantidad"},
     *          @OA\Property(property="nombre", type="string", example="Producto 1"),
     *          @OA\Property(property="descripcion", type="string", example="Producto 1"),
     *          @OA\Property(property="precio", type="double", example="100.00"),
     *          @OA\Property(property="categorias", type="array", @OA\Items(type="integer"), example="[1, 2, 3]")
     *
     *
     *
     *
     *
     *
     *       ),
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Successful Response",
     *      @OA\JsonContent(
     *      @OA\Property(property="data", type="Json", example="[...]"),
     *     ),
     *  ),
     *  @OA\Response(
     *      response=401,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="message", type="string", example="Unauthenticated")
     *      ),
     *   ),
     * )
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string',
            'precio' => 'required|numeric',
            'descripcion' => 'required|string'

        ]);
        try {
            $producto = new Productos();
            $producto->nombre = $request->nombre;
            $producto->precio = $request->precio;
            $producto->descripcion = $request->descripcion;
            $producto->save();

            if ($request->categorias) {
                foreach ($request->categorias as $categoria) {
                    $producto->categoria()->attach($categoria);
                }
            }


            return new ProductosResource($producto);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }


    /**
     * @OA\Get(
     *     tags={"Productos"},
     *     path="/api/productos/{producto}",
     *    summary="Obtener un producto",
     *     description="Obtener un producto",
     *     operationId="show_producto",
     * @OA\Parameter(
     *    description="ID del producto",
     *    in="path",
     *    name="producto",
     *    required=true,
     *    example="1",
     *    @OA\Schema(
     *       type="integer",
     *    )
     * ),
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
    public function show(Productos $producto)
    {
        try {
            return new ProductosResource($producto);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * @OA\Put(
     *        tags={"Productos"},
     *        path="/api/productos/{producto}",
     *        summary="Actualizar un producto",
     *        operationId="update_producto",
     *  @OA\Parameter(
     *    description="ID del producto",
     *    in="path",
     *    name="producto",
     *    required=true,
     *    example="1",
     *    @OA\Schema(
     *       type="integer",
     *    )
     * ),
     *  @OA\RequestBody(
     *      required=true,
     *      description="Datos del producto",
     *  @OA\JsonContent(
     *      required={"nombre","precio","cantidad"},
     *          @OA\Property(property="nombre", type="string", example="Producto 1"),
     *          @OA\Property(property="descripcion", type="string", example="Producto 1"),
     *          @OA\Property(property="precio", type="double", example="100.00"),
     *          @OA\Property(property="categorias", type="array", @OA\Items(type="integer"), example="[1, 2, 3]")
     *       ),
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Successful Response",
     *      @OA\JsonContent(
     *      @OA\Property(property="data", type="Json", example="[...]"),
     *     ),
     *  ),
     *  @OA\Response(
     *      response=401,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="message", type="string", example="Unauthenticated")
     *      ),
     *   ),
     * )
     */
    public function update(Request $request, Productos $producto)
    {
        $this->validate($request, [
            'nombre' => 'required|string',
            'precio' => 'required|numeric',
            'descripcion' => 'required|string'
        ]);
        try {
            $producto->nombre = $request->nombre;
            $producto->precio = $request->precio;
            $producto->descripcion = $request->descripcion;
            $producto->save();

            if ($request->categorias) {
                $producto->categoria()->detach();
                foreach ($request->categorias as $categoria) {
                    $producto->categoria()->attach($categoria);
                }
            }



            return new ProductosResource($producto);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * @OA\Delete(
     *     tags={"Productos"},
     *     path="/api/productos/{producto}",
     *    summary="Eliminar un producto",
     *     description="Eliminar un producto",
     *     operationId="destroy_producto",
     * @OA\Parameter(
     *    description="ID del producto",
     *    in="path",
     *    name="producto",
     *    required=true,
     *    example="1",
     *    @OA\Schema(
     *       type="integer",
     *    )
     * ),
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
    public function destroy(Productos $producto)
    {
        try {
            $producto->delete();
            return new ProductosResource($producto);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }
}
