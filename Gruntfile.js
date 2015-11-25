module.exports = function(grunt) {
    grunt.initConfig({
        copy : {
            main : {
                expand : true,
                cwd : 'bower_components',
                src : [ 'jquery/dist/*.js',
                        'bootstrap/dist/css/bootstrap.min.css',
                        'bootstrap/dist/js/bootstrap.min.js',
                        'bootstrap/dist/fonts/**', ],
                dest : 'public/assets/vendor/',
            },
        },
        clean : {
            clean : [ "public/assets/vendor" ]
        }
    });
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-clean');
};
