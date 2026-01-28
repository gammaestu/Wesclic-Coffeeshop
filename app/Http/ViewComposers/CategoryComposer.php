<?php

namespace App\Http\ViewComposers;

use App\Repositories\CategoryRepository;
use Illuminate\View\View;

class CategoryComposer
{
    public function __construct(
        protected CategoryRepository $categoryRepository
    ) {}

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('categories', $this->categoryRepository->getActive());
    }
}