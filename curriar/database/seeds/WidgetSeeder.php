<?php

use Illuminate\Database\Seeder;
use App\AdminWidget;
use App\AdminContainer;

class WidgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Start  container for main theme
            // $container = new AdminContainer();
            // $container->title = "Footer";
            // $container->name = "footer_1";
            // $container->theme_name = "main";
            // $container->type = "footer";
            // $container->save();
        // End  container for main theme

        // Start  container for news theme
            // $container = new AdminContainer();
            // $container->title = "Dashboard";
            // $container->name = "dashboard";
            // $container->theme_name = "news";
            // $container->save();

            // $container = new AdminContainer();
            // $container->title = "First Footer";
            // $container->name = "footer_1";
            // $container->theme_name = "news";
            // $container->type = "footer";
            // $container->save();

            $container = new AdminContainer();
            $container->title = "Second Footer";
            $container->name = "second_footer";
            $container->theme_name = "news";
            $container->type = "bottom_footer";
            $container->save();

            $container = new AdminContainer();
            $container->title = "Home Page - First Sidebar";
            $container->name = "home_page_first_sidebar";
            $container->theme_name = "news";
            $container->type = "sidebar";
            $container->save();

            $container = new AdminContainer();
            $container->title = "Home Page - Second Sidebar";
            $container->name = "home_page_second_sidebar";
            $container->theme_name = "news";
            $container->type = "sidebar";
            $container->save();
        // End  container for news theme
        
        // Start About
            $value = [
                "logo" => "",
                "description" => "",
            ];

            $widget = new AdminWidget();
            $widget->title = "About";
            $widget->name = "about";
            $widget->value = json_encode($value);
            $widget->type = "query";
            $widget->widget_frontend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.frontend.about","function"=>"about_view_frontend"]);
            $widget->widget_backend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.backend.widget.about","function"=>"about_view_backend"]);
            $widget->container_widget_backend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.backend.container_widget.about","function"=>"about_view_backend"]);
            $widget->update = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","function"=>"widget_update_about"]);
            $widget->save();
        // End About

        // Start About
            $value = [
                "logo" => "",
            ];

            $widget = new AdminWidget();
            $widget->title = "Image";
            $widget->name = "image";
            $widget->value = json_encode($value);
            $widget->type = "query";
            $widget->widget_frontend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.frontend.image","function"=>"image_view_frontend"]);
            $widget->widget_backend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.backend.widget.image","function"=>"image_view_backend"]);
            $widget->container_widget_backend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.backend.container_widget.image","function"=>"image_view_backend"]);
            $widget->update = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","function"=>"widget_update_image"]);
            $widget->save();
        // End About
        /*
            // Start Contact Info
                $value = [
                    "address" => "",
                    "phone" => "",
                    "email" => "",
                ];

                $widget = new AdminWidget();
                $widget->title = "Contact Info";
                $widget->name = "contact_info";
                $widget->value = json_encode($value);
                $widget->type = "query";
                $widget->widget_frontend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.frontend.contact_info","function"=>"contact_info_view_frontend"]);
                $widget->widget_backend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.backend.widget.contact_info","function"=>"contact_info_view_backend"]);
                $widget->container_widget_backend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.backend.container_widget.contact_info","function"=>"contact_info_view_backend"]);
                $widget->update = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","function"=>"widget_update_contact_info"]);
                $widget->save();
            // End Contact Info

            // Start HTML
                $value = [
                    "html" => "",
                ];

                $widget = new AdminWidget();
                $widget->title = "HTML";
                $widget->name = "html";
                $widget->value = json_encode($value);
                $widget->type = "query";
                $widget->widget_frontend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.frontend.html","function"=>"html_view_frontend"]);
                $widget->widget_backend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.backend.widget.html","function"=>"html_view_backend"]);
                $widget->container_widget_backend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.backend.container_widget.html","function"=>"html_view_backend"]);
                $widget->update = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","function"=>"widget_update_html"]);
                $widget->save();
            // End HTML

            // Start Text
                $value = [
                    "title" => "",
                    "description" => "",
                ];

                $widget = new AdminWidget();
                $widget->title = "Text";
                $widget->name = "text";
                $widget->value = json_encode($value);
                $widget->type = "query";
                $widget->widget_frontend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.frontend.text","function"=>"text_view_frontend"]);
                $widget->widget_backend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.backend.widget.text","function"=>"text_view_backend"]);
                $widget->container_widget_backend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.backend.container_widget.text","function"=>"text_view_backend"]);
                $widget->update = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","function"=>"widget_update_text"]);
                $widget->save();
            // End Text

            // Start Menu widget
                $value = [
                    "id"=>"",
                ];

                $widget = new AdminWidget();
                $widget->title = "Menu";
                $widget->name = "menu";
                $widget->value = json_encode($value);
                $widget->type = "query";
                $widget->widget_frontend = json_encode(["controller"=>"App\Http\Controllers\MenuController","view"=>"widgets.frontend.menu","function"=>"widget_view_frontend"]);;
                $widget->widget_backend = json_encode(["controller"=>"App\Http\Controllers\MenuController","view"=>"widgets.backend.widget.menu","function"=>"widget_view_backend"]);
                $widget->container_widget_backend = json_encode(["controller"=>"App\Http\Controllers\MenuController","view"=>"widgets.backend.container_widget.menu","function"=>"widget_view_backend"]);
                $widget->update = json_encode(["controller"=>"App\Http\Controllers\MenuController","function"=>"widget_update"]);
                $widget->save();

            // End Menu widget

            // Start Social media links widget
                $value = [
                    "front_title"=> "Social media links"
                ];

                $widget = new AdminWidget();
                $widget->title = "Social media links";
                $widget->name = "social_media_links";
                $widget->value = json_encode($value);
                $widget->type = "query";
                $widget->widget_frontend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.frontend.social_media","function"=>"social_view_frontend"]);
                $widget->widget_backend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.backend.widget.social_media","function"=>"social_view_backend"]);
                $widget->container_widget_backend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.backend.container_widget.social_media","function"=>"social_view_backend"]);
                $widget->update = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","function"=>"widget_update_social"]);
                $widget->save();
            // End Social media links widget

            // Start Sign up widget
                $value = [
                    "title" => "Get Even More",
                    "subtitle" => "Subscribe to our mailing list to get the new updates!",
                    "description" => "Lorem ipsum dolor sit amet, consectetur.",
                    "hits" => "Don't worry, we don't spam.",
                ];

                $widget = new AdminWidget();
                $widget->title = "Sign up";
                $widget->name = "sign_up";
                $widget->value = json_encode($value);
                $widget->type = "query";
                $widget->widget_frontend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.frontend.sign_up","function"=>"sign_up_view_frontend"]);
                $widget->widget_backend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.backend.widget.sign_up","function"=>"sign_up_view_backend"]);
                $widget->container_widget_backend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.backend.container_widget.sign_up","function"=>"sign_up_view_backend"]);
                $widget->update = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","function"=>"widget_update_sign_up"]);
                $widget->save();
            // End Sign up widget
        */

        // Start Business Hours widget
            $value = [
                "title" => "Business Hours",
                "description" => "Lorem ipsum dolor sit amet, consectetur.",
                "labe_1" => "Monday-Saturday",
                "value_1" => "8:00 - 16:00",
            ];
            $widget = new AdminWidget();
            $widget->title = "Business Hours";
            $widget->name = "business_hours";
            $widget->value = json_encode($value);
            $widget->type = "query";
            $widget->widget_frontend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.frontend.business_hours","function"=>"business_view_frontend"]);
            $widget->widget_backend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.backend.widget.business_hours","function"=>"business_view_backend"]);
            $widget->container_widget_backend = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","view"=>"widgets.backend.container_widget.business_hours","function"=>"business_view_backend"]);
            $widget->update = json_encode(["controller"=>"App\Http\Controllers\AdminContainerWidgetController","function"=>"widget_update_business"]);
            $widget->save();
        // End Business Hours widget
    }
}
