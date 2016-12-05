/**
 * Handcrafted with ♥ Beebit Solutions
 * Real coffee was used in this project development
 * Licensed under MIT License
 * contacto@beebit.es
 */

var gulp = require('gulp');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');
var nano = require('gulp-cssnano');

gulp.task('scripts', function () {
    return gulp.src('./resources/assets/js/**/*.js')
        .pipe(sourcemaps.init())
        .pipe(concat('ddsi.min.js'))
        .pipe(uglify())
        .pipe(sourcemaps.write('./maps/'))
        .pipe(gulp.dest('./public/js'));
});
gulp.task('styles', function () {
    gulp.src('./resources/assets/sass/**.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(concat('style.min.css'))
        .pipe(nano())
        .pipe(sourcemaps.write('./maps/'))
        .pipe(gulp.dest('./public/css'));
});

gulp.task('default', ['production'], function () {
});

gulp.task('production', ['scripts', 'styles'], function () {
});

gulp.task('watch', function () {
    gulp.watch('resources/assets/js/**/*.js', ['scripts']);
    gulp.watch('resources/assets/sass/**.scss', ['styles']);
});
