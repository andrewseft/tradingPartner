<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Constants\Constant;

class Banner extends Model
{
    use Sortable,Cachable;
    protected $fillable = [ 'id', 'status'];
    public $sortable  = ['id', 'status', 'created_at', 'updated_at','start_date_time','end_date_time','layout_place'];
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
        return $this->hasOne('App\BannerTranslation')->where('locale', $this->language);
    }

    /**
     * Get the BannerTranslation record associated with the page.
     * @bind hasMany
     */
    public function translation()
    {
        return $this->hasMany('App\BannerTranslation');
    }

    /**
     * order by title
     */
    public function titleSortable($query, $direction)
    {
        return $query->join('banner_translations', 'banners.id', '=', 'banner_translations.banner_id')
            ->orderBy('title', $direction)
            ->where('banner_translations.locale', '=', $this->language)
            ->select('banners.*');
    }
}
