var elixir = require('laravel-elixir');
require('./elixir-extensions');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */


elixir.config.sourcemaps = false;



elixir(function(mix){
   mix.styles([
       '../bower_components/angular/angular-csp.css',
       '../template/fonts/ionicons/css/ionicons.min.css',
       '../template/fonts/font-awesome/css/font-awesome.css',
       '../template/styles/plugins/c3.css',
       //'../template/styles/plugins/waves.css',
       '../template/styles/plugins/perfect-scrollbar.css',
       '../template/styles/plugins/select2.css',
       '../template/styles/bootstrap.min.css',
       '../template/styles/main.min.css',
       'google/css.css',


   ],'public/css') ;
});

elixir(function(mix) {
    mix.sass([
        'app.scss',
        'other.scss'
    ]);
});

elixir(function(mix){
    mix.copy('resources/assets/css/google/fonts', 'public/css/fonts');
    mix.copy('resources/assets/template/fonts/font-awesome/fonts', 'public/css/fonts');
    mix.copy('resources/assets/template/fonts/ionicons/fonts', 'public/css/fonts');
});

elixir(function(mix){
    mix.url('public/css/all.css', '../fonts/', 'fonts/');
});



elixir(function(mix) {
    mix.scripts([
        '../template/scripts/ie/matchMedia.js',
        '../template/scripts/vendors.js',
        '../template/scripts/plugins/d3.min.js',
        '../template/scripts/plugins/c3.min.js',
        '../bower_components/angular/angular.js',
        '../bower_components/angular-bootstrap/ui-bootstrap.min.js',
        '../bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js',
        '../bower_components/bootbox.js/bootbox.js',
        '../bower_components/numeral/numeral.js',
        '../bower_components/jquery-ui/jquery-ui.js',
        '../template/scripts/plugins/jquery.dataTables.min.js',
        '../template/scripts/plugins/screenfull.js',
        '../template/scripts/plugins/perfect-scrollbar.min.js',
        //'../template/scripts/plugins/waves.min.js',
        '../template/scripts/plugins/jquery.sparkline.min.js',
        '../template/scripts/plugins/jquery.easypiechart.min.js',
        '../template/scripts/plugins/bootstrap-rating.min.js',
        '../template/scripts/plugins/bootstrap-datepicker.min.js',
        '../template/scripts/plugins/select2.min.js',
        '../template/scripts/app.js',
        '../template/scripts/tables.init.js',
        '../template/scripts/index.init.js',

        'laravel.js',
        'main.js',
        'company.js',

        'config.js',
        'quiz.js',
        'group.js',
        'directives.js',

        'report.js'
    ]);

});

//elixir(function(mix) {
//    mix.version('css/all.css');
//});