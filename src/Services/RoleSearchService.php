<?php

namespace Sentgine\Authzone\Services;

use Spatie\Permission\Models\Role as Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Sentgine\Authzone\Base\Search;

class RoleSearchService extends Search
{
    /**
     * The search function for user search.
     * 
     * @return LengthAwarePaginator
     */
    public function search(): LengthAwarePaginator
    {
        // Initialize query
        $query = Model::query();

        // If the request search field is not empty, then search
        if ($this->request->has($this->inputName)) {
            $search = $this->request->input($this->inputName);
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query->paginate($this->perPage);
    }
}
