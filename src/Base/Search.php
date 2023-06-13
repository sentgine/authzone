<?php

namespace Sentgine\Authzone\Base;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class Search
{
    protected Request $request;
    protected $inputName;
    protected $perPage;

    /**
     * The search class constructor.
     * 
     * @param Request $request
     * @param string $inputName
     * @param int $perPage
     */
    public function __construct(Request $request, string $inputName = 'search', int $perPage = 10)
    {
        $this->request = $request;
        $this->inputName = $inputName;
        $this->perPage = $perPage;
    }

    /**
     * Returns the paginated data set for specific models.
     * 
     * @return LengthAwarePaginator
     */
    abstract public function search(): LengthAwarePaginator;
}
