const mix = require('laravel-mix');
const LiveReloadPlugin = require("webpack-livereload-plugin");
const path = require('path');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    //---------------------------[admin]--------------------------------
    //                      js                   🍓+🟡
    .ts("resources/admin/ts/app.js", "public/admin/js/app.js")
    .ts("resources/admin/ts/pages/list.js", "public/admin/js/pages")
    .ts("resources/admin/ts/pages/add.js", "public/admin/js/pages")
    .ts("resources/admin/ts/pages/edit.js", "public/admin/js/pages")

    //                      sass                 🍓+🎟
    .sass("resources/admin/scss/app.scss", "public/admin/css")
    .sass("resources/admin/scss/pages/list.scss", "public/admin/css/pages/list.css")
    .sass("resources/admin/scss/pages/add.scss", "public/admin/css/pages/add.css")
    .sass("resources/admin/scss/pages/edit.scss", "public/admin/css/pages/edit.css")
    .sass("resources/admin/scss/pages/home.scss", "public/admin/css/pages/home.css")
    .sass("resources/admin/scss/components/nav.scss", "public/admin/css/components/nav.css")
    .sass("resources/admin/scss/pages/login.scss", "public/admin/css/pages/login.css")

    // copy phần fonts vào /public               🗂
    // .copyDirectory("resources/fonts", "public/admin/fonts")  // chỉ định đúng font cần dùng. Hiện tại sẽ đóng copy font.

    // copy phần libraries | frameworks vào /public
    .copyDirectory("resources/assets/libraries_frameworks/ckeditor5-build-decoupled-document", "public/admin/libraries_frameworks/ckeditor5-build-decoupled-document")
    .copyDirectory("resources/assets/libraries_frameworks/functions",                          "public/admin/libraries_frameworks/functions")
    .copyDirectory("resources/assets/libraries_frameworks/jcrop",                              "public/admin/libraries_frameworks/jcrop")
    .copyDirectory("resources/assets/libraries_frameworks/jquery",                             "public/admin/libraries_frameworks/jquery")
    .copyDirectory("resources/assets/libraries_frameworks/materialize",                        "public/admin/libraries_frameworks/materialize")
    .copyDirectory("resources/assets/libraries_frameworks/three.js",                           "public")

    // copy phần assets favicons - images cho admin
    .copyDirectory("resources/assets/admin", "public/admin")

    // copy phần hình ảnh cho READMELARAVEL.md
    .copyDirectory("resources/assets/readme_img",                                  "public/readme_img")


    //---------------------------[client]---------------------------------------
    // blade-pages          ts                   🍓+🟡
    .ts('resources/public/ts/blade-pages.ts', 'public/js')
    .ts('resources/public/ts/index.tsx', 'public/js/app.js')
    // blade-pages          scss                 🍓+🎟
    .sass('resources/public/scss/blade-pages.scss', 'public/css', {
        sassOptions: {
            autoprefixer: true,
        }
    })

    // ❌ phần này bỏ: vì lý do: frontend đã phát triển và compile ở /resources/react-app/
    // react-app            tsx                  🔰+🎟
    // .ts('resources/react-app/src/index.tsx', 'public/js/index.js').react()
    // react-app            sass                 🔰+🎟
    // .sass('resources/src/sass/app.scss', 'public/css')   // comment dòng này vì source src mới được dùng create-react-app có thể sass đc compile trong tsx

    // copy assets                               🗂
    // .copyDirectory("resources/fonts", "public/admin/fonts")  // chỉ định đúng font cần dùng. Hiện tại sẽ đóng copy font.
    // favicons - images - files direct in public/admin/
    .copyDirectory("resources/assets/public",                                  "public")


    //---------------------------[config]---------------------------------------
    .webpackConfig({
        module: {
            rules: [
                {
                    test: /\.tsx?$/,
                    loader: "ts-loader",
                    options: {
                        compilerOptions: {
                            noEmit: false,
                        },
                    },
                    exclude: /node_modules/,
                },
            ],
        },
        resolve: {
            extensions: ["*", ".js", ".jsx", ".vue", ".ts", ".tsx"],
            alias: {
                'resources': path.resolve(__dirname + '/resources'),// phải có laravel mới hiểu. mới import "resources/*" trong app react đc.
            }
        },
        plugins: [new LiveReloadPlugin()],
    })

    // dev
    .sourceMaps();

    /**
         composer require laravel/ui
        // Generate basic scaffolding...
        php artisan ui react
        // Generate login / registration scaffolding...
        php artisan ui react --auth

        // Khi chạy react sinh ra các dòng dưới:
    */
