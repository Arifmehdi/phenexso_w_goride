<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Menu;
use App\Models\MenuPage;
use App\Models\Page;
use App\Models\PageItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenuPageController extends Controller
{
   
    public function menusAll()
    {
        
        menuSubmenu('menupage', 'menusAll');
        $data['menus'] = Menu::orderBy('drag_id')->latest()->paginate(30);
        return view('admin.menus.menusAll', $data);
    }



    
    public function menuStore(Request $request)
    {

        // Set menu active submenu
        menuSubmenu('menupage', 'menusAll');

      
        // Validate request data
        $request->validate([
            'name_en' => 'string|required',
            'type' => 'string|required',
            'slug' => 'string',
        ]);

        // Create new menu instance
        $menu = new Menu();

        // Assign values from request
        $menu->name_en = $request->name_en;
        $menu->name_bn = $request->name_bn;

        // Generate slug or use given one
        $menu->slug = getSlug($request->slug, $menu, boolval($request->slug));

        // Assign type and link (nullable)
        $menu->type = $request->type;
        $menu->link = $request->link ?: null;

        // Assign current user as creator
        $menu->addedby_id = Auth::id();

        // Save menu to database
        $menu->save();

        // Clear cache after menu update
        cache()->flush();

        // Show success message
        toast('Menu successfully Created', 'success');

        // Redirect back to form/page
        return redirect()->back();
    }



   
    public function menuEdit(Menu $menu)
    {
        // Set active submenu for menu management
        menuSubmenu('menupage', 'menusAll');

        // Pass the menu data to the view
        $data['menu'] = $menu;

        // Return edit view with menu data
        return view('admin.menus.menuEdit', $data);
    }


   
    public function menuShow(Menu $menu)
    {
        // Set active submenu for menu management
        menuSubmenu('menupage', 'menusAll');

        // Pass the menu data to the view
        $data['menu'] = $menu;

        // Return show view with menu data
        return view('admin.menus.menuShow', $data);
    }



    
    public function menuUpdate(Request $request, Menu $menu)
    {
        // Set active submenu for menu management
        menuSubmenu('menupage', 'menusAll');


        // Validate incoming request data
        $request->validate([
            'name_en' => 'string|required',
            'type'    => 'string|required',
            'slug'    => 'string',
        ]);

        // Update menu properties
        $menu->name_en     = $request->name_en;
        $menu->name_bn     = $request->name_bn;
        $menu->slug        = getSlug($request->slug, $menu, boolval($request->slug));
        $menu->type        = $request->type;
        $menu->active      = $request->active ? 1 : 0;
        $menu->link        = $request->link ?? null;
        $menu->editedby_id = Auth::id();

        // Save changes
        $menu->save();

        // Clear cache
        cache()->flush();

        // Show success toast notification
        toast('Menu successfully Updated', 'success');

        // Redirect back to previous page
        return redirect()->back();
    }


   
    public function menuDelete(Menu $menu)
    {
        // Set active submenu for menu management
        menuSubmenu('menupage', 'menusAll');

        // Delete the menu
        $menu->delete();

        // Clear cache
        cache()->flush();

        // Show success toast notification
        toast('Menu successfully deleted', 'success');

        // Redirect back to previous page
        return redirect()->back();
    }



 
    public function menuSort(Request $request)
    {
        foreach ($request->sorted_data as $key => $id) {
            DB::table('menus')->where('id', $id)->update(['drag_id' => $key + 1]);
        }

        return response()->json([
            'success' => true,
        ]);
    }





    public function pagesAll()
    {
        menuSubmenu('menupage', 'pagesAll');
        $data['menus'] = Menu::latest()->get();
        $data['pages'] = Page::orderBy('drag_id')->latest()->paginate(20);
        return view('admin.pages.pagesAll', $data);
    }



  


    public function pageStore(Request $request)
    {
        // Set active submenu for UI
        menuSubmenu('menupage', 'pagesAll');

        // Validate request inputs
        $request->validate([
            'name_en' => 'string|required',
            'slug' => 'nullable|string|unique:pages,slug',
        ]);

        // Create new Page instance
        $page = new Page();
        $page->name_en = $request->name_en;
        $page->name_bn = $request->name_bn;
        $page->type = Str::slug($request->name_en, '_');

        // Generate slug (auto or custom)
        $page->slug = getSlug($request->slug, $page, boolval($request->slug));

        // Set excerpts
        $page->excerpt_en = $request->excerpt_en;
        $page->excerpt_bn = $request->excerpt_bn;

        // Set active status (1 or 0)
        $page->active = $request->active ? 1 : 0;

        // Set the user who added this page
        $page->addedby_id = Auth::id();

        // Save the page
        $page->save();

        // Attach menus with addedby_id for pivot
        $page->menus()->attach($request->menus, ['addedby_id' => Auth::id()]);

        // Show success toast message
        toast('Page successfully created', 'success');

        // Clear cache to refresh menus/pages
        cache()->flush();

        // Redirect back to previous page
        return redirect()->back();
    }



  
    public function pageEdit(Page $page)
    {
        // Set active submenu for UI
        menuSubmenu('menupage', 'pagesAll');

        // Pass the page and all menus to the view
        $data['page'] = $page;
        $data['menus'] = Menu::latest()->get();

        // Return edit view with data
        return view('admin.pages.pageEdit', $data);
    }




  
    public function pageUpdate(Request $request, Page $page)
    {
        // Set active submenu for UI
        menuSubmenu('menupage', 'pagesAll');


        // Validate incoming request data
        $request->validate([
            'name_en' => 'string|required',
            'slug' => 'nullable|string|unique:pages,slug,' . $page->id,
        ]);

        // Update page properties
        $page->name_en = $request->name_en;
        $page->name_bn = $request->name_bn;
        $page->type = Str::slug($request->name_en, '_');
        $page->slug = getSlug($request->slug, $page, boolval($request->slug));
        $page->excerpt_en = $request->excerpt_en;
        $page->excerpt_bn = $request->excerpt_bn;
        $page->active = $request->active ? 1 : 0;
   
        $page->editedby_id = Auth::id();

        // Save the updated page
        $page->save();

        // Sync the menus relationship with new data, including editedby_id pivot data
        $page->menus()->detach($page->menus);
        $page->menus()->attach($request->menus, ['editedby_id' => Auth::id()]);

        // Clear cache to reflect changes
        cache()->flush();

        // Notify success
        toast('Page successfully Updated', 'success');

        // Redirect back to previous page
        return redirect()->back();
    }


    public function pageDelete(Page $page)
    {
        // Set submenu for UI highlight
        menuSubmenu('menupage', 'pagesAll');


        // Delete the page record
        $page->delete();

        // Clear cache after deletion
        cache()->flush();

        // Show success message
        toast('Page successfully deleted', 'success');

        // Redirect back to the previous page
        return redirect()->back();
    }



   
    public function pageSort(Request $request)
    {
        // Loop through sorted data and update drag_id accordingly
        foreach ($request->sorted_data as $key => $pageId) {
            DB::table('pages')->where('id', $pageId)->update(['drag_id' => $key + 1]);
        }

        // Return JSON response indicating success
        return response()->json([
            'success' => true,
        ]);
    }



    public function pageItemCreate($page_id)
    {
        // Find the page by ID
        $data['page'] = Page::find($page_id);

        // Get latest media items with pagination
        $data['medias'] = Media::latest()->paginate(20);

        // Return the view with data
        return view('admin.pageItems.pageItemCreate', $data);
    }




 
    public function pageItemStore(Request $request)
    {

        // Validate required fields
        $request->validate([
            'name_en' => 'required',
            'description_en' => 'required',
        ]);

        // Create new PageItem instance
        $pageItem = new PageItem();
        $pageItem->page_id        = $request->page_id;
        $pageItem->name_en        = $request->name_en;
        $pageItem->name_bn        = $request->name_bn;
        $pageItem->description_en = $request->description_en;
        $pageItem->description_bn = $request->description_bn;
        $pageItem->editor         = $request->editor ? 1 : 0;
        $pageItem->active         = $request->active ? 1 : 0;
        $pageItem->addedby_id     = Auth::id();
        
        // Save to database
        $pageItem->save();

        // Show success message
        toast('PageItem successfully created', 'success');

        // Redirect back
        return redirect()->back();
    }




   
    public function pageItemEdit(PageItem $pageItem)
    {
        // Get all PageItems for the same page
        $data['pageItems'] = PageItem::where('page_id', $pageItem->page_id)->get();

        // Current PageItem to edit
        $data['pageItem'] = $pageItem;

        // Get latest medias for possible media selection
        $data['medias'] = Media::latest()->paginate(20);

        // Return edit view with data
        return view('admin.pageItems.pageItemEdit', $data);
    }



  
    public function pageItemUpdate(Request $request, PageItem $pageItem)
    {



        // Validate required fields
        $request->validate([
            'name_en' => 'required',
            'description_en' => 'required',
        ]);

        // Assign updated values
        $pageItem->page_id        = $request->page_id;
        $pageItem->name_en        = $request->name_en;
        $pageItem->name_bn        = $request->name_bn;
        $pageItem->description_en = $request->description_en;
        $pageItem->description_bn = $request->description_bn;
        $pageItem->editor         = $request->editor ? 1 : 0;
        $pageItem->active         = $request->active ? 1 : 0;
        $pageItem->editedby_id    = Auth::id();

        // Save changes
        $pageItem->save();

        // Success notification
        toast('PageItem successfully updated', 'success');

        // Redirect back
        return redirect()->back();
    }



  
    public function pageItemDelete(PageItem $pageItem)
    {

        // Delete the PageItem
        $pageItem->delete();

        // Show success message
        toast('PageItem successfully deleted', 'success');

        // Redirect back
        return redirect()->back();
    }



    public function menupageSearch(Request $request)
    {
        $type = $request->type;
        $q = $request->q;

        if ($type == 'menu') {
            // Search menus by name or id
            $menus = Menu::where(function ($qq) use ($q) {
                $qq->orWhere('name', 'like', "%{$q}%")
                ->orWhere('id', 'like', "%{$q}%");
            })
            ->orderBy('name')
            ->paginate(100);

            $menus->appends($request->all());

            $page = view('admin.menus.searchData', ['menus' => $menus])->render();

            return response()->json([
                'success' => true,
                'page' => $page,
            ]);
        } else {
            // Add logic for other types if needed
            return response()->json([
                'success' => false,
                'message' => 'Invalid search type.',
            ]);
        }
    }
}
