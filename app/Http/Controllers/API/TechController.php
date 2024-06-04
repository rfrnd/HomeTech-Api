<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Tech;

class TechController extends Controller
{
    /** 
     * Display a listing of the item.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tech::get();
    }

    /**
     * Store a newly created item in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $tech = new Tech;
            $tech->fill($request->validated())->save();

            return $tech;

        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data - {Exception->getMessage}");
        }
    }

    /**
     * Display the specified item.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tech = Tech::findOrfail($id);

        return $tech;
    }

    /** 
     * Update the specified item in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @Param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$id) {
            throw new HttpException(400, "invalid id");
        }

        try {
            $tech = Tech::find($id);
            $tech->fill($request->validated())->save();

            return $tech;

        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage}");
        }
    }
    /**
     * Remove the specified item from storage.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tech = Tech::findOrfail($id);
        $tech->delete();

        return response()->json(null, 204);
    }
}