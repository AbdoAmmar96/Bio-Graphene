<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Application extends Model
{
    protected $fillable = ['slug','name','symbol','icon','short','body','file_url','is_overview','sort'];
    protected $casts = ['is_overview' => 'boolean'];
    public function scopeCards($q){ return $q->where('is_overview',false)->orderBy('sort'); }
}
