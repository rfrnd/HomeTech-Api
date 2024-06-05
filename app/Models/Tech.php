<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use OpenApi\Annotations as OA;

/**
 * class Tech.  
 * 
 * @author Rafael <rafael.422023026@civitas.ukrida.ac.id>
 * 
 * @OA\Schema(
 *     description="Tech model",
 *     title="Tech model",
 *     required={"nama", "Brand"},
 *     @OA\Xml(
 *         name="Tech"
 *      )
 * )
 */
class Tech extends Model
{
    // use HasFactory;
    use SoftDeletes;
    protected $table = 'tech';
    protected $fillable = [
        'title',
        'cover',
        'price',
        'description',
        'category',
        'brand',
        'model',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    public function data_adder(){
        return $this-> belongsTo(User::class, 'created_by', 'id');
    }
}
