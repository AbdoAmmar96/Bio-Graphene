<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GalleryFolder extends Model
{
    protected $fillable = ['title','slug','sort'];

    public function images(): HasMany
    {
        return $this->hasMany(GalleryImage::class, 'folder_id')->orderBy('sort');
    }
}
