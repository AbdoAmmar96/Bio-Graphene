<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class VisionDoc extends Model
{
    protected $fillable = ['slug','title','subtitle','body','file_url','sort'];
}
