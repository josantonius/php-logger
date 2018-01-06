/**
 * Php library to create logs easily and store them in JSON format.
 * 
 * @author     Josantonius - hello@josantonius.com
 * @copyright  Copyright (c)
 * @license    https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link       https://github.com/Josantonius/PHP-Logger
 * @since      1.1.2
 */

// Dependencies

var gulp         = require('gulp'),
    concat       = require('gulp-concat'),
    uglify       = require('gulp-uglify'),
    sass         = require('gulp-sass'),
    plumber      = require('gulp-plumber'),
    rename       = require('gulp-rename'),
    cleanCSS     = require('gulp-clean-css'),
    notify       = require('gulp-notify'),
    sourcemaps   = require('gulp-sourcemaps'),
    autoprefixer = require('gulp-autoprefixer');

// Tasks

gulp.task('js', function () {

    var file = 'src/public/js/source/logger.js',
        min  = 'logger.min.js',
        dest = 'src/public/js/',

        notifyOptions = { 

            message: 'Scripts task complete' 
        };

    gulp.src(file)
        .pipe(concat(min))
        .pipe(uglify())
        .pipe(gulp.dest(dest))
        .pipe(notify(notifyOptions));
});

gulp.task('css', function () {

    var main   = 'src/public/sass/logger.sass',
        files  = 'src/public/sass/**/*.sass',
        source = 'src/public/css/source/',
        dest   = 'src/public/css/',

        sourcemapsOption = { 

            content: { 

                includeContent: false 
            }, 

            init: {

                loadMaps: true 
            } 
        },

        sassOptions = {

            errLogToConsole: true, 
            outputStyle:     'expanded' 
        },

        autoprefixerOptions = { 

            browsers: ['last 2 versions'], 
            cascade:  true 
        },

        notifyOptions = {

            message: 'Styles task complete'
        },

        cssOptions = {

            compatibility: 'ie8' 
        };

        renameOptions = {

            suffix: '.min'
        };

    gulp.src(main)
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(sass(sassOptions).on('error', sass.logError))
        .pipe(sourcemaps.write(sourcemapsOption.content))
        .pipe(sourcemaps.init(sourcemapsOption.init))
        .pipe(autoprefixer(autoprefixerOptions))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(source))
        .pipe(rename(renameOptions))
        .pipe(cleanCSS(cssOptions))
        .pipe(gulp.dest(dest))
        .pipe(notify(notifyOptions));

});

gulp.task('watch', function () {

    var sassFiles = [
            'src/public/sass/**/*.sass',
            'src/public/sass/logger.sass'
        ],

        jsFiles  = [
            'src/public/js/source/logger.js'
        ];

    gulp.watch(jsFiles, ['js']);

    gulp.watch(sassFiles, ['css']);

});

gulp.task('default', ['js', 'css']);
