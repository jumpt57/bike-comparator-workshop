var gulp = require('gulp'),
    gp_concat = require('gulp-concat'),
    gp_rename = require('gulp-rename'),
    gp_uglify = require('gulp-uglify'),
    gp_watch = require('gulp-watch');

var repSortie = './src/assets/js/build';

var files = [ 'src/assets/bower_components/jquery/dist/jquery.js',
            'src/assets/bower_components/materialize/dist/js/materialize.js',
            'src/assets/bower_components/angular/angular.js',
            'src/assets/bower_components/angular-route/angular-route.js',
            'src/assets/bower_components/angular-resource/angular-resource.js',

            'src/app/**/*.module.js',
            'src/app/**/app.*.js',
            'src/app/**/*.controller.js',
            'src/app/**/*.service.js',
            'src/app/**/*.component.js'];

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