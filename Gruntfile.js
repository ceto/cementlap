'use strict';
module.exports = function(grunt) {

  grunt.initConfig({
    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      all: [
        'Gruntfile.js',
        'assets/js/*.js',
        '!assets/js/scripts.min.js'
      ]
    },
    uglify: {
      dist: {
        options: {
          beautify: true,
          mangle: false,
          compress: false
        },
        files: {
          'assets/js/scripts.min.js': [
            'bower_components/owlcarousel/owl-carousel/owl.carousel.js',
            'bower_components/photoswipe/dist/photoswipe.js',
            'bower_components/photoswipe/dist/photoswipe-ui-default.js',
            'assets/js/plugins/*.js',
            'assets/js/_*.js'
          ]
        }
      }
    },
    version: {
      options: {
        file: 'lib/scripts.php',
        css: 'assets/css/main.min.css',
        cssHandle: 'roots_main',
        js: 'assets/js/scripts.min.js',
        jsHandle: 'roots_scripts'
      }
    },
    sass: {
      dist: {
        options: {
         outputStyle: 'nested',
         sourceMap: true,
        },
        files: {
          'assets/css/main.css': 'assets/scss/styles.scss'
        }
      }
    },
    autoprefixer: {
      dist: {
        options: {
            map: true
        },
        src: 'assets/css/main.css',
        dest: 'assets/css/main.min.css'
      }
    },
    watch: {
      sass: {
        files: [
          'assets/scss/*.scss'
        ],
        tasks: ['sass', 'autoprefixer', 'version']
      },
      js: {
        files: [
          '<%= jshint.all %>'
        ],
        tasks: ['jshint', 'uglify', 'version']
      },
      livereload: {
        options: {
          livereload: true
        },
        files: [
          'assets/css/main.min.css',
          'assets/js/scripts.min.js',
          'templates/*.php',
          '*.php',
          '!lib/scripts.php'
        ]
      }
    },
    clean: {
      dist: [
        'assets/css/main.min.css',
        'assets/js/scripts.min.js'
      ]
    }
  });

  // Load tasks
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-wp-version');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-autoprefixer');


  // Register tasks
  grunt.registerTask('default', [
    'clean',
    'sass',
    'uglify',
    'version',
    'autoprefixer'
  ]);
  grunt.registerTask('dev', [
    'watch'
  ]);

};
