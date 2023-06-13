<?php

namespace Sentgine\Authzone\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Sentgine\Authzone\Base\Search;
use Sentgine\Authzone\Traits\Config;

class UserSearchService extends Search
{

    /**
     * The search function for user search.
     * 
     * @return LengthAwarePaginator
     */
    public function search(): LengthAwarePaginator
    {
        // Initialize query
        $query = authzone_user_model()->query();

        // If the request search field is not empty, then search
        if ($this->request->has($this->inputName)) {
            $search = $this->request->input($this->inputName);
            $query->where('email', 'like', '%' . $search . '%');
        }

        return $query->paginate($this->perPage);
    }
}
