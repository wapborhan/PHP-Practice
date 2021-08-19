<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\PageTranslation;
use App\AdminContainer;
use App\AdminTheme;
use Harimayco\Menu\Facades\Menu;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;


class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.website_settings.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if (env('DEMO_MODE') == 'On') {
          flash(translate('This action is disabled in demo mode'))->error();
          return back();
      }
        $page = new Page;
        $page->title = $request->title;
        if (Page::where('slug', preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug)))->first() == null) {
            $page->slug             = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            $page->type             = "custom_page";
            $page->content          = $request->content;
            $page->meta_title       = $request->meta_title;
            $page->meta_description = $request->meta_description;
            $page->keywords         = $request->keywords;
            $page->meta_image       = $request->meta_image;
            $page->save();

            $page_translation           = PageTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'page_id' => $page->id]);
            $page_translation->title    = $request->title;
            $page_translation->content  = $request->content;
            $page_translation->save();

            flash(translate('New page has been created successfully'))->success();
            return redirect()->route('website.pages');
        }

        flash(translate('Slug has been used already'))->warning();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function edit(Request $request, $id)
   {
        $lang = $request->lang;
        $page_name = $request->page;
        $page = Page::where('slug', $id)->first();
        if($page != null){
          if ($page_name == 'home') {
            return view('backend.website_settings.pages.home_page_edit', compact('page','lang'));
          }
          else{
            return view('backend.website_settings.pages.edit', compact('page','lang'));
          }
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      if (env('DEMO_MODE') == 'On') {
          flash(translate('This action is disabled in demo mode'))->error();
          return back();
      }
        $page = Page::findOrFail($id);
        if (Page::where('id','!=', $id)->where('slug', preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug)))->first() == null) {
            if($page->type == 'custom_page'){
              $page->slug           = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            }
            if($request->lang == env("DEFAULT_LANGUAGE")){
              $page->title          = $request->title;
              $page->content        = $request->content;
            }
            $page->meta_title       = $request->meta_title;
            $page->meta_description = $request->meta_description;
            $page->keywords         = $request->keywords;
            $page->meta_image       = $request->meta_image;
            $page->save();

            $page_translation           = PageTranslation::firstOrNew(['lang' => $request->lang, 'page_id' => $page->id]);
            $page_translation->title    = $request->title;
            $page_translation->content  = $request->content;
            $page_translation->save();

            flash(translate('Page has been updated successfully'))->success();
            return redirect()->route('website.pages');
        }

      flash(translate('Slug has been used already'))->warning();
      return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if (env('DEMO_MODE') == 'On') {
          flash(translate('This action is disabled in demo mode'))->error();
          return back();
      }
        $page = Page::findOrFail($id);
        foreach ($page->page_translations as $key => $page_translation) {
            $page_translation->delete();
        }
        if(Page::destroy($id)){
            flash(translate('Page has been deleted successfully'))->success();
            return redirect()->back();
        }
        return back();
    }

    public function show_custom_page($slug){
        $page = Page::where('slug', $slug)->first();


        $active_theme = AdminTheme::where('active','=',1)->get()->first();
        $footer_containers = AdminContainer::where('type','=','footer')->where('theme_name','=',$active_theme->name)->get();
        // return $footer_containers;
        $second_footer = AdminContainer::where('name','=','second_footer')->where('theme_name','=',$active_theme->name)->get()->first();
        $home_page_first_sidebar = AdminContainer::where('name','=','home_page_first_sidebar')->where('theme_name','=',$active_theme->name)->get()->first();
        $home_page_second_sidebar = AdminContainer::where('name','=','home_page_second_sidebar')->where('theme_name','=',$active_theme->name)->get()->first();
        // $main_menu = Menu::getByName('main_menu'); //return array
        // $side_menu = Menu::getByName('side_menu'); //return array
        $navbar_menu = Menus::find( setting()->get($active_theme->name.'_navbar_menu_'.app()->getLocale()) ); //return array
        $sidebar_menu = Menus::find( setting()->get($active_theme->name.'_sidebar_menu_'.app()->getLocale()) ); //return array
        $footer_menu = Menus::find( setting()->get($active_theme->name.'_footer_menu_'.app()->getLocale()) ); //return array
        
        $data = [
            'page'=>$page,
            'footer_containers'=>$footer_containers,
            'second_footer'=>$second_footer,
            'home_page_first_sidebar'=>$home_page_first_sidebar,
            'home_page_second_sidebar'=>$home_page_second_sidebar,
            // 'main_menu'=>$main_menu,
            // 'side_menu'=>$side_menu,
            'navbar_menu'=>$navbar_menu,
            'sidebar_menu'=>$sidebar_menu,
            'footer_menu'=>$footer_menu
        ];


        if($page != null){
          return view('frontend.custom_page',$data);
        }
        abort(404);
    }
}
