<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Constants\Constant;

class Page extends Model
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
        return $this->hasOne('App\PageTranslation')->where('locale', $this->language);
    }

    /**
     * Get the PageTranslation record associated with the page.
     * @bind hasMany
     */
    public function translation()
    {
        return $this->hasMany('App\PageTranslation');
    }

    /**
     * order by title
     */
    public function titleSortable($query, $direction)
    {
        return $query->join('page_translations', 'pages.id', '=', 'page_translations.page_id')
            ->orderBy('title', $direction)
            ->where('page_translations.locale', '=', $this->language)
            ->select('pages.*');
    }

    /**
     * order by created_at
     */
    public function createdAtSortable($query, $direction)
    {
        return $query->join('page_translations', 'pages.id', '=', 'page_translations.page_id')
            ->orderBy('created_at', $direction)
            ->where('page_translations.locale', '=', $this->language)
            ->select('pages.*');
    }

}
