'use strict';

module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        less: {
            development: {
                options: {
                    paths: ["/"]
                },
                files: {
                    "web/css/style.css": "src/NerdLab/BlogBundle/Resources/assets/less/nerdlab.less"
                }
            },
            production: {
                options: {
                    paths: ["assets/css"],
                    cleancss: true
                },
                files: {
                    "web/css/style.css": "src/NerdLab/BlogBundle/Resources/assets/less/nerdlab.less"
                }
            }
        },
        uglify: {
            bootstrapjs: {
                files: {
                    'web/js/bootstrap.min.js': [
                        'src/NerdLab/BlogBundle/Resources/assets/vendor/bootstrap/js/*.js'
                    ]
                }
            },
            cookies: {
                files: {
                    'web/js/cookies.min.js': [
                        'src/NerdLab/BlogBundle/Resources/assets/js/cookies.js'
                    ]
                }
            }
        },
        watch: {
            less: {
                files: ['src/NerdLab/BlogBundle/Resources/assets/less/*.less',
                    'src/NerdLab/BlogBundle/Resources/assets/vendor/bootstrap/less/*.less'],
                tasks: ['less:development']
            },
            uglify: {
                files: ['src/NerdLab/BlogBundle/Resources/assets/vendor/bootstrap/js/*.js'],
                tasks: ['uglify:bootstrapjs']
            },
            cookies: {
                files: ['src/NerdLab/BlogBundle/Resources/assets/js/cookies.js'],
                tasks: ['uglify:cookies']
            }
        },
        copy: {
            main: {
                src: "src/NerdLab/BlogBundle/Resources/assets/vendor/jquery/jquery.min.js",
                dest: "web/js/jquery.min.js"
            }
        }
    });
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.registerTask('dist', ['less:production', 'uglify','copy']);
    grunt.registerTask('update', ['less:development', 'uglify','copy']);
};


