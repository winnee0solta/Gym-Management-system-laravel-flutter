const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js/v1_app.js").sass(
    "resources/sass/app.scss",
    "public/css/v1_app.css"
);

mix.browserSync({
    proxy: "http://localhost:8000",
    snippetOptions: {
        rule: {
            match: /<\/body>/i,
            fn: function(snippet, match) {
                return snippet + match;
            }
        }
    }
});

//for notification
mix.disableNotifications();
