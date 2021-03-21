<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Constants\Constant;

class Email extends Model
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
        return $this->hasOne('App\EmailTranslation')->where('locale', $this->language);
    }

    /**
     * Get the EmailTranslation record associated with the page.
     * @bind hasMany
     */
    public function translation()
    {
        return $this->hasMany('App\EmailTranslation');
    }

    /**
     * order by title
     */
    public function titleSortable($query, $direction)
    {
        return $query->join('email_translations', 'emails.id', '=', 'email_translations.email_id')
            ->orderBy('title', $direction)
            ->where('email_translations.locale', '=', $this->language)
            ->select('emails.*');
    }

    /**
     * order by subject
     */
    public function subjectSortable($query, $direction)
    {
        return $query->join('email_translations', 'emails.id', '=', 'email_translations.email_id')
            ->orderBy('subject', $direction)
            ->where('email_translations.locale', '=', $this->language)
            ->select('emails.*');
    }

    /**
     * order by created_at
     */
    public function createdAtSortable($query, $direction)
    {
        return $query->join('email_translations', 'emails.id', '=', 'email_translations.email_id')
            ->orderBy('created_at', $direction)
            ->where('email_translations.locale', '=', $this->language)
            ->select('emails.*');
    }
}
