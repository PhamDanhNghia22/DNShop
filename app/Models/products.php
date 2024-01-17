<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey= 'id_prod';
    protected $fillable=['name_prod','price','img','soluotxem','description','noibat','status_prod','cate_id','brand_id','slug'];
}
