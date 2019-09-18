module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    uglify: {
      options: {
        compress: true
      },
      build: {
        src: ['node_modules/angular/angular.js'],
        dest: 'build/admin/bundle.min.js'
      }
    },
    cssmin : {
      options: {
            keepSpecialComments: 0
      },
      combine : {
        files: {
            'build/admin/bundle.css': ['build/admin/bundle.css', 'css/aos.css', 'flaticon.css']
        }
      }
    },
    concat_css: {
      options: {
        // Task-specific options go here.
      },
      all: {
        src: ['build/admin/bundle.css', 'css/aos.css', 'flaticon.css'],
        dest: "build/admin/bundle.css"
      }
    }
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-cssmin');

  // Default task(s).
  grunt.registerTask('default', ['uglify', 'cssmin']);

};