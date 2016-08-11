var gulp    =   require('gulp'),
    Elixir  =   require('laravel-elixir'),
    Task    =   Elixir.Task,
    url     =   require('gulp-css-url-adjuster')
    ;

Elixir.extend('url',function(file, old_path, new_path){

    new Task('url',function(){

        console.log(file);
        return gulp.src(file).
            pipe(url({
                replace:  [old_path, new_path]
            }))
            .pipe(gulp.dest(function(x) {
                return x.base;
            }));
    });

});