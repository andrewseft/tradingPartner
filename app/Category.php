<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Constants\Constant;

class Category extends Model
{
    use Sortable,Cachable;
    protected $fillable = [ 'id', 'status' ];
    public $sortable  = ['id', 'status', 'created_at', 'updated_at'];
    protected  $primaryKey = 'id';
    protected $cacheCooldownSeconds = Constant::REDIS_CACHE_TIME; // 5 minutes
    private $language;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->language = \App::getLocale();
    }

    /**
     * @bind hasOne
     * @param locale
     */
    public function detail(string $locale = null)
    {
        return $this->hasOne('App\CategoryTranslation')->where('locale', $this->language);
    }

    /**
     * Get the CategoryTranslation record associated with the page.
     * @bind hasMany
     */
    public function translation()
    {
        return $this->hasMany('App\CategoryTranslation');
    }

    /**
     * order by title
     */
    public function titleSortable($query, $direction)
    {
        return $query->join('category_translations', 'categories.id', '=', 'category_translations.category_id')
            ->orderBy('title', $direction)
            ->where('category_translations.locale', '=', $this->language)
            ->select('categories.*');
    }

    /**
     * order by created_at
     */
    public function createdAtSortable($query, $direction)
    {
        return $query->join('category_translations', 'categories.id', '=', 'category_translations.category_id')
            ->orderBy('created_at', $direction)
            ->where('category_translations.locale', '=', $this->language)
            ->select('categories.*');
    }



    public function categories()
    {
        return $this->hasMany(Category::class)->with(['detail:category_id,name']);
    }

    public function childrenCategories()
    {
        return $this->hasMany(Category::class)->with(['categories','detail:category_id,name']);
    }

    public function attribute()
    {
    	return $this->belongsToMany('App\Attribute');
    }
}
