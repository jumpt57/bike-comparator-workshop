var gulp = require('gulp'),
    gp_concat = require('gulp-concat'),
    gp_rename = require('gulp-rename'),
    gp_uglify = require('gulp-uglify'),
    gp_watch = require('gulp-watch');

var repSortie = './src/assets/js/build';

var files = [       
                /**Templates modules */
                'src/assets/plugins/products-comparison-table/js/modernizr.js',                       
                'src/assets/plugins/jquery/jquery-2.2.0.min.js',               
                'src/assets/plugins/materialize/js/materialize.js',
                'src/assets/plugins/material-preloader/js/materialPreloader.js',
                'src/assets/plugins/jquery-blockui/jquery.blockui.js',
                'src/assets/js/alpha.js', 
                /**Bower Module */
                'src/assets/bower_components/angular/angular.js',
                'src/assets/bower_components/angular-route/angular-route.js',
                'src/assets/bower_components/angular-resource/angular-resource.js',              
                /**Angular modules */
                'src/app/**/*.module.js',
                'src/app/**/app.*.js',
                'src/app/**/*.controller.js',
                'src/app/**/*.service.js',
                'src/app/**/*.component.js',
            ];

gulp.task('watch-js', function () {
    return gp_watch('src/app/**/*.js', function () {
        gulp.src(files)
            .pipe(gp_concat('app.js'))
            .pipe(gulp.dest(repSortie));
    });
});

gulp.task('js', function () {   
    return gulp.src(files)      
        .pipe(gp_concat('app.js'))
        .pipe(gulp.dest(repSortie))   
        .pipe(gp_rename('app.min.js'))
        .pipe(gp_uglify())
        .pipe(gulp.dest(repSortie));   
});

gulp.task('default', ['js', 'watch-js'], function () { });