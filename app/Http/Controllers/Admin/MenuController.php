<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Repositories\MenuRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function __construct(
        protected MenuRepository $menuRepository
    ) {}

    /**
     * Display a listing of menus.
     */
    public function index(Request $request): View
    {
        $query = Menu::with('category')->latest();

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $menus = $query->paginate(15);
        $categories = Category::where('status', 'aktif')->orderBy('name')->get();

        return view('admin.menus.index', [
            'menus' => $menus,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new menu.
     */
    public function create(): View
    {
        $categories = Category::where('status', 'aktif')->orderBy('name')->get();

        return view('admin.menus.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created menu.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:tersedia,habis'],
        ]);

        Menu::create($validated);

        $this->menuRepository->clearCache();

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu created successfully.');
    }

    /**
     * Show the form for editing the specified menu.
     */
    public function edit(Menu $menu): View
    {
        $categories = Category::where('status', 'aktif')->orderBy('name')->get();

        return view('admin.menus.edit', [
            'menu' => $menu,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified menu.
     */
    public function update(Request $request, Menu $menu): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:tersedia,habis'],
        ]);

        $menu->update($validated);

        $this->menuRepository->clearCache();
        $this->menuRepository->clearMenuCache($menu->id);

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu updated successfully.');
    }

    /**
     * Remove the specified menu.
     */
    public function destroy(Menu $menu): RedirectResponse
    {
        // Check if menu has orders
        if ($menu->orderItems()->count() > 0) {
            return back()->with('error', 'Cannot delete menu with existing orders.');
        }

        $menu->delete();

        $this->menuRepository->clearCache();
        $this->menuRepository->clearMenuCache($menu->id);

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu deleted successfully.');
    }
}