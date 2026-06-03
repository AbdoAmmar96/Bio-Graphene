<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Material extends Model
{
    protected $fillable = ['slug','title','short','body','file_url','sort'];
}
