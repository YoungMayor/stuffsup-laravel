<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class HTMLServiceProvider extends ServiceProvider
{
    protected $cssPATH = "assets/css";
    protected $jsPATH = "assets/js";
    protected $VueComponentsPATH = "assets/vue/components";
    protected $imgPATH = "assets/img";

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive("BS_CSS", function ($expression) {
            return "<link rel='stylesheet' href='{{ asset('assets/bootstrap/css/bootstrap.min.css') }}'>";
        });


        Blade::directive("FAW_ALL", function ($expression) {
            return <<<_HTML_
<link rel='stylesheet' href='{{ asset('assets/fonts/fontawesome-all.min.css') }}'>
<link rel='stylesheet' href='{{ asset('assets/fonts/font-awesome.min.css') }}'>
<link rel='stylesheet' href='{{ asset('assets/fonts/fontawesome5-overrides.min.css') }}'>
_HTML_;
        });


        Blade::directive("Font_ALL", function ($expression) {
            return <<<_HTML_
<link rel='stylesheet' href='{{ asset('assets/fonts/fontawesome-all.min.css') }}'>
<link rel='stylesheet' href='{{ asset('assets/fonts/font-awesome.min.css') }}'>
<link rel='stylesheet' href='{{ asset('assets/fonts/fontawesome5-overrides.min.css') }}'>
<link rel='stylesheet' href='{{ asset('assets/fonts/ionicons.min.css') }}'>
<link rel='stylesheet' href='{{ asset('assets/fonts/simple-line-icons.min.css') }}'>
<link rel='stylesheet' href='{{ asset('assets/fonts/material-icons.min.css') }}'>
_HTML_;
        });


        Blade::directive("JQUERY", function ($expression) {
            return <<<HTML_
            <script src='{{ asset('assets/js/jquery.min.js') }}'></script>
            <script src='{{ asset('assets/js/jquery.easing.js') }}'></script>
            <script src='{{ asset('assets/js/jquery.zoom.min.js') }}'></script>
            <script src='{{ asset('assets/js/jquery.lazy.min.js') }}'></script>
HTML_;
        });

        Blade::directive("BS_JS", function ($expression) {
            return <<<HTML_
            <script src='{{ asset('assets/bootstrap/js/bootstrap.min.js') }}'></script>
            <script src='{{ asset('assets/bootstrap/js/bootstrap-notify.min.js') }}'></script>
HTML_;
        });


        Blade::directive("axios_JS", function ($expression) {
            return "<script src='{{ asset('assets/js/axios.min.js') }}'></script>";
        });


        Blade::directive("js", function ($expression) {
            $this->assetVersion($expression, $file, $version);

            $path = asset("$this->jsPATH/$file.js?v=$version");

            return "<script src='$path'></script>";
        });

        Blade::directive("js_m", function ($expression) {
            $this->assetVersion($expression, $file, $version);

            $path = asset("$this->jsPATH/$file.js?v=$version");

            return "<script type='module' src='$path'></script>";
        });


        Blade::directive("css", function ($expression) {
            $this->assetVersion($expression, $file, $version);

            $path = asset("$this->cssPATH/$file.css?v=$version");

            return "<link rel='stylesheet' href='$path'>";
        });


        /* Blade::directive("icons", function ($expression) {
            return <<<HTML_
            <link rel="icon" type="image/png" sizes="46x46" href="{{ asset("assets/img/layout-icons/devcomm_favicon.png") }}">
            <link rel="icon" type="image/png" sizes="1182x1184" href="{{ asset("assets/img/layout-icons/background.png") }}">
HTML_;
        }); */


        Blade::directive("imgURL", function ($expression) {
            return asset("$this->imgPATH/$expression");
        });

        Blade::directive("brline", function($expression){
            return "<?php echo nl2br(htmlspecialchars($expression)); ?>";
        });
    }

    protected function assetVersion($str, &$fileName = "", &$version = 1)
    {
        $lis = explode(",", $str);

        $fileName = isset($lis[0])  ? trim($lis[0]) : "general";
        $version = isset($lis[1]) ? trim($lis[1]) : "1";
    }
}
