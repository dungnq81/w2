let mix = require('laravel-mix');
mix.webpackConfig({
    resolve: {
        // options for resolving module requests
        // (does not apply to resolving of loaders)
        modules: [__dirname, 'node_modules']
    },
    stats: {
        children: false,
        warningsFilter: [
            /\-\-underline\-color/,
        ]
    },
    devtool: 'source-map'
});

mix.disableNotifications()
    .options({
        processCssUrls: false,
        postCss: [
            require('autoprefixer')({
                // Browserslist’s default browsers (> 0.5%, last 2 versions, Firefox ESR, not dead).
                //browsers: ['defaults'],
                grid: true
            })
        ]
    });

mix.copyDirectory('resources/img', 'assets/img')
    .copyDirectory('resources/fonts', 'assets/fonts')
    .copyDirectory('resources/js/plugins', 'assets/js/plugins');

mix.setPublicPath('assets')
    .sourceMaps()

    //.js('resources/js/login.js', 'js')
    //.js('resources/js/admin.js', 'js')
    //.js('resources/js/app.js', 'js')

    .sass('resources/sass/awe.scss', 'css')
    .sass('resources/sass/admin.scss', 'css')
    .sass('resources/sass/editor-style.scss', 'css');
    //.sass('resources/sass/plugins.scss', 'css')
    //.sass('resources/sass/app.scss', 'css');
