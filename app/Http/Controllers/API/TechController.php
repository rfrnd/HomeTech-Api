<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Tech;
use OpenApi\Annotations as OA;

/**
 * Class TechController.
 * 
 * @author Rafael <rafael.422023026@civitas.ukrida.ac.id>
 */
class TechController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/tech",
     *      tags={"HomeTech"},
     *      summary="Display a listing of items",
     *      operationId="index",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent()
     *      ),
     * @OA\Parameter(
     *      name="_page",
     *      in="query",
     *      description="current page",
     *      required=true,
     *      @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1 
     *        )
     *     ),
     * @OA\Parameter(
     *      name="_limit",
     *      in="query",
     *      description="max item in a page",
     *      required=true,
     *      @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=10
     *        )
     *     ),
     * @OA\Parameter(
     *      name="_search",
     *      in="query",
     *      description="word to search",
     *      required=false,
     *      @OA\Schema(
     *         type="string",
     *        )
     *     ),
     * @OA\Parameter(
     *      name="_publisher",
     *      in="query",
     *      description="search by publisher like name",
     *      required=false,
     *      @OA\Schema(
     *         type="string",
     *        )
     *     ),
     * @OA\Parameter(
     *      name="_sort_by",
     *      in="query",
     *      description="word to search",
     *      required=false,
     *      @OA\Schema(
     *         type="string",
     *         example="latest" 
     *        )
     *     ),
     * )
     */
    public function index(Request $request)
    {
        try {
            $data['filter']     = $request->all();
            $page               = ($data['filter']['_page'] ? intval($data['filter']['_page']) : 1);
            $limit              = ($data['filter']['_limit'] ? intval($data['filter']['_limit']) : 1000);
            $offset             = ($page?($page-1)*$limit:0);
            $data['products']   = Tech::whereRaw('1 = 1');
        
            if ($request->get('_search')) {
                $data['products'] = $data['products']->whereRaw('(LOWER(title) LIKE "%'.strtolower($request->get('_search')).'%" OR LOWER(author) LIKE "%'.strtolower($request->get('_search')).'%")');
            }
        
            if ($request->get('_publisher')) {
                $data['products'] = $data['products']->whereRaw('LOWER(publisher) = "'.strtolower($request->get('_publisher')).'"');
            }
            if ($request->get('_sort_by')) {
                switch ($request->get('_sort_by')) {
                    default:
                    case 'latest_publication':
                        $data['products'] = $data['products']->orderBy('publication_year', 'DESC');
                        break;
                    case 'latest_added':
                        $data['products'] = $data['products']->orderBy('created_at', 'DESC');
                        break;
                    case 'title_asc':
                        $data['products'] = $data['products']->orderBy('title', 'ASC');
                        break;
                    case 'title_desc':
                        $data['products'] = $data['products']->orderBy('title', 'DESC');
                        break;
                    case 'price_asc':
                        $data['products'] = $data['products']->orderBy('price', 'ASC');
                        break;
                    case 'price_desc':
                        $data['products'] = $data['products']->orderBy('price', 'DESC');
                        break;
                }
            }
            $data['products_count_total']   = $data['products']->count();
            $data['products']               = ($limit==0 && $offset==0)?$data['products']:$data['products']->limit($limit)->offset($offset); 
            // $data['products_raw_sql']    = $data['products']->tosql();
            $data['products']               = $data['products']->get();
            $data['products_count_start']   = ($data['products_count_total'] == 0 ? 0 : (($page-1)*$limit)+1);
            $data['products_count_end']     = ($data['products_count_total'] == 0 ? 0 : (($page-1)*$limit)+sizeof($data['products']));
            return response()->json($data, 200);
        
        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data : {$exception->getMessage()}");
        }
    }

    /**
     * @OA\Post(
     *      path="/api/tech",
     *      tags={"HomeTech"},
     *      summary="Store a newly created item",
     *      operationId="store",
     *       @OA\Response(
     *           response=400,
     *           description="invalid input",
     *           @OA\JsonContent()
     *      ),
     *       @OA\Response(
     *           response=201,
     *           description="successful",
     *           @OA\JsonContent()
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="Request body description",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/Tech",
     *              example={ 
     *                  "title": "Mesin Cuci LG Front Loading 8kg, Inverter Direct Drive™ dengan Smart Diagnosis™", 
     *                  "cover": "https://www.lg.com/content/dam/channel/wcms/id/images/mesin-cuci/fm1208n3w_abwpein_eain_id_c/FM1208N3W_Mesin_Cuci_Front_Loading_thumbnail_450.jpg", 
     *                  "price": 4449000, 
     *                  "description": "Pencucian optimal untuk kain dengan 6 Motion DD (Pilih program mencuci, dan teknologi 6 Motion Direct Drive akan menggerakkan tabung cuci ke beberapa arah, membersihkan kain dan menjadikan pakaian super bersih.)", 
     *                  "category": "Mesin Cuci", 
     *                  "brand": "LG", 
     *                  "model": "FM1208N3W"}
     *          ),
     *      ),
     *      security={{"passport_token_ready":{}, "passport":{}}}
     * )
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|unique:tech',
                'brand' => 'required|max:100',
            ]);
            if ($validator->fails()){
                throw new HttpException(400, $validator->messages()->first());
            }
            $tech = new Tech;
            $tech->fill($request->all())->save();
            return $tech;
    
        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data : {$exception->getMessage()}");
        }
    }

    /**
     * @OA\Get(
     *      path="/api/tech/{id}",
     *      tags={"HomeTech"},
     *      summary="Display the specified item",
     *      operationId="show",
     *      @OA\Response(
     *          response=404,
     *          description="Item not found",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="invalid input",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent()
     *       ),
     *       @OA\Parameter(
     *            name="id",
     *            in="path",
     *            description="ID of item that needs to be displayed",
     *            required=true,
     *            @OA\Schema(
     *                type="integer",
     *                format="int64"
     *          )
     *      ),
     * )
     */
    public function show($id)
    {
        $tech = Tech::find($id);
        if(!$tech){
            throw new HttpException(404, 'Item not found');
        }
        return $tech;
    }

    /** 
     * @OA\Put(
     *      path="/api/tech/{id}",
     *      tags={"HomeTech"},
     *      summary="Update the specified item",
     *      operationId="update",
     *      @OA\Response(
     *          response=404,
     *          description="item not found",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="invalid input",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID item that needs to be updated",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="Request body description",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/Tech",
     *              example={ 
     *                  "title": "Mesin Cuci LG Front Loading 8kg, Inverter Direct Drive™ dengan Smart Diagnosis™", 
     *                  "cover": "https://www.lg.com/content/dam/channel/wcms/id/images/mesin-cuci/fm1208n3w_abwpein_eain_id_c/FM1208N3W_Mesin_Cuci_Front_Loading_thumbnail_450.jpg", 
     *                  "price": 4449000, 
     *                  "description": "Pencucian optimal untuk kain dengan 6 Motion DD (Pilih program mencuci, dan teknologi 6 Motion Direct Drive akan menggerakkan tabung cuci ke beberapa arah, membersihkan kain dan menjadikan pakaian super bersih.)", 
     *                  "category": "Mesin Cuci", 
     *                  "brand": "LG", 
     *                  "model": "FM1208N3W"}                     
     *          ),
     *      ),
     *      security={{"passport_token_ready":{}, "passport":{}}}
     * )
     */
    public function update(Request $request, $id)
    {
        $tech = Tech::find($id);
        if (!$tech) {
            throw new HttpException(404, "item not found");
        }

        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required||unique:tech',
                'brand' => 'required|mac:100',
            ]);
            if ($validator->fails()) {
                throw new HttpException(400, $validator->messages()->first());
            }
           $tech->fill($request->all())->save();
           return response()->json(array('message'=> 'Updated successfuly'), 200);

        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data : {$exception->getMessage}");
        }
    }
    /**
     * @OA\Delete(
     *     path="/api/tech/{id}",
     *     tags={"HomeTech"},
     *     summary="Remove the specified item",
     *     operationId="destroy",
     *      @OA\Response(
     *          response=404,
     *          description="item not found",
     *          @OA\JsonContent()
     *      ),
     *       @OA\Response(
     *          response=400,
     *          description="invalid input",
     *          @OA\JsonContent()
     *      ),
     *       @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID item that needs to be removed",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      security={{"passport_token_ready":{}, "passport":{}}}
     * )
     */
    public function destroy($id)
    {
        $tech = Tech::find($id);
        if(!$tech){
            throw new HttpException(404, 'item not found');
        }

        try {
            $tech->delete();
            return response()->json(array('message'=>'Deleted successfully'), 200);
            
        } catch(\Exception $Exception) {
            throw new HttpException(400, "Invalid data : {$Exception->getMessage()}");
        }
    }
}