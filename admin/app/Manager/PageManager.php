<?php

namespace App\Manager;

use App\Page;
use App\PageTranslation;
use App\Helpers\Helper;

class PageManager
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Page $page,PageTranslation $pageTranslation)
    {
        $this->page = $page;
        $this->pageTranslation = $pageTranslation;
    }

    /**
     * @return Page
     */
    public function page()
    {
        return $this->page;
    }

    /**
     * List of all static page
     * @param $request
     * @param $limit
     */
    function list($request, int $limit) {
        $page = $this->page->with('detail:page_id,title')->sortable()->orderBy('created_at', 'desc');
        if ($request->has('title')) {
            $name = $request->query('title');
            $page->whereHas('detail', function ($q) use ($name) {
                $q->where('title', 'LIKE', '%' . $name . '%');
            });
        }
        $data = $page->paginate($limit);
        return $data;
    }

    /**
     * Get first
     * @param $id
     */
    public function get($id)
    {
        return $this->page->findOrFail($id);
    }

    /**
     * @param $request
     */
    public function create($request)
    {

        $data = $this->page;
        if (!empty($request->get('id'))) {
            $data = $this->page->findOrFail($request->get('id'));
        }
        $translation = [];
        if ($data->save()) {
            foreach ($request->translation as $value) {
                $item = new PageTranslation();
                if (!empty($value['id'])) {
                    $item = $this->pageTranslation->findOrFail($value['id']);
                }
                $item->locale = $value['locale'];
                $item->title = $value['title'];
                $item->description = $value['description'];
                $item->meta_keyword = $value['meta_keyword'];
                $item->meta_title = $value['meta_title'];
                $item->meta_description = $value['meta_description'];
                $translation[] = $item;
            }
        }
        $data->translation()->saveMany($translation);
    }

    /**
     * update status
     * @param $id
     * @param $status
     */
    public function update($id, $status)
    {
        $this->page->where('id', $id)->update(['status' => $status]);
    }

    /**
     * @param $id
     * Hasman
     */
    public function getbyId($id)
    {
        $page = $this->page->with(['translation'])->findOrFail($id);
        $array = [];
        if (!empty($page)) {
            foreach ($page->translation as $key => $value) {
                $array[$value->locale]['id'] = $value->id;
                $array[$value->locale]['locale'] = $value->locale;
                $array[$value->locale]['title'] = $value->title;
                $array[$value->locale]['description'] = $value->description;
            }
            $page->translation = $array;
        }
        return $page;
    }



}
