<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Constants\Constant;

class Faq extends Model
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
        return $this->hasOne('App\FaqTranslation')->where('locale', $this->language);
    }

    /**
     * Get the FaqTranslation record associated with the page.
     * @bind hasMany
     */
    public function translation()
    {
        return $this->hasMany('App\FaqTranslation');
    }

    /**
     * order by title
     */
    public function titleSortable($query, $direction)
    {
        return $query->join('faq_translations', 'faqs.id', '=', 'faq_translations.faq_id')
            ->orderBy('title', $direction)
            ->where('faq_translations.locale', '=', $this->language)
            ->select('faqs.*');
    }

    

}
