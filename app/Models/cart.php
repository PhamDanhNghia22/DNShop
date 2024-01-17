<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
    protected $table = "cart";
    protected $primaryKey = "id";
    protected $fillable = ["orderID","prodID","prod_name","quantity","price","img"];
}
