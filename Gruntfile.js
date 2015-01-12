module.exports = function (grunt) {
    // load all grunt tasks
    
    grunt.initConfig({
        copy: {
            main: {
                cwd: 'node_modules/',
                expand: true,
                src: 'font-awesome/**',
                dest: 'fonts/', 
            },
        },
        less: {
            development: {
                options: {
                    compress: true,
                    yuicompress: true,
                    optimization: 2
                },
                files: {
                    // target.css file: source.less file
                    "css/simple-grey.css": "less/simple-grey.less",
                    "css/editor.css": "less/editor.less"
                }
            }
        },

        watch: {
           styles: {
                files: ['less/**/*.less'], // which files to watch
                tasks: ['less'],
                options: {
                    nospawn: true
                }
            }
        }
        
    });
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // the default task (running "grunt" in console) is "watch"
    grunt.registerTask('default', ['watch']);
};