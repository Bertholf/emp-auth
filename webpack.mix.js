let mix = require('laravel-mix');

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

/**************************************************************************
 *                          Helpers
 *************************************************************************/

/**
 * Set current layout.
 *
 * @type {string}
 */
const layout = 'mmenu';

/**
 * Get global asset path.
 *
 * i.e. themes/remark/global/css/bootstrap.min.css
 *
 * @param file
 * @returns {string}
 */
function global_path(file) {
    return `resources/themes/remark/global/${file}`;
}

/**
 * Get layout asset path.
 *
 * i.e. themes/remark/{mmenu}/css/site.min.css
 *
 * @param file
 * @returns {string}
 */
function layout_path(file) {
    return `resources/themes/remark/${layout}/${file}`;
}

/**
 * Get topbar layout asset path.
 *
 * i.e. themes/remark/{topbar}/css/site.min.css
 *
 * @param file
 * @returns {string}
 */
function layout_topbar_path(file) {
    return `resources/themes/remark/topbar/${file}`;
}

/**************************************************************************
 *                          Assets compilation
 *************************************************************************/

    // Application script
    mix.js('resources/assets/js/app.js', 'public/js/app.js').version();

    // Core css
    mix.combine([
        global_path('css/bootstrap.min.css'),
        global_path('css/bootstrap-extend.min.css'),
        layout_path('css/site.css'),
        'resources/assets/css/style.css',
    ], 'public/css/core.css')

    // Plugin css
    .combine([
        global_path('vendor/animsition/animsition.css'),
        global_path('vendor/asscrollable/asScrollable.css'),
        global_path('vendor/switchery/switchery.css'),
        global_path('vendor/intro-js/introjs.css'),
        global_path('vendor/slidepanel/slidePanel.css'),
        global_path('vendor/jquery-mmenu/jquery-mmenu.css'),
        global_path('vendor/flag-icon-css/flag-icon.min.css'),
        global_path('vendor/bootstrap-sweetalert/sweetalert.min.css'),
        layout_path('examples/css/structure/breadcrumbs.min.css'),
        'resources/assets/css/stars_plugin/star-rating-svg.css',
    ], 'public/css/plugins.css')

    // Font css
    .combine([
        global_path('fonts/web-icons/web-icons.min.css'),
        global_path('fonts/brand-icons/brand-icons.min.css'),
        // global_path('fonts/font-awesome/font-awesome.min.css'),
        layout_path('examples/css/uikit/colors.css'),
    ], 'public/css/fonts/fonts.css')

    // IE 9 scripts
    .combine([
        global_path('vendor/html5shiv/html5shiv.min.js'),
    ], 'public/js/ie9.js')

    // IE 10 scripts
    .combine([
        global_path('vendor/media-match/media.match.min.js'),
        global_path('vendor/respond/respond.min.js'),
    ], 'public/js/ie10.js')

    // Header scripts
    .combine([
        'resources/assets/js/fontawesome-all.min.js',
        global_path('vendor/breakpoints/breakpoints.js'),
    ], 'public/js/header.js')

    // Core scripts
    .combine([
        global_path('vendor/babel-external-helpers/babel-external-helpers.js'),
        global_path('vendor/jquery/jquery.min.js'),
        // global_path('vendor/tether/tether.js'), removed on new remark
        global_path('vendor/popper-js/umd/popper.min.js'), // added on remark update
        //global_path('vendor/bootstrap/bootstrap.js'),
        global_path('vendor/animsition/animsition.min.js'),
        global_path('vendor/mousewheel/jquery.mousewheel.min.js'),
        global_path('vendor/asscrollbar/jquery-asScrollbar.js'),
        global_path('vendor/asscrollable/jquery-asScrollable.js'),
        global_path('vendor/ashoverscroll/jquery-asHoverScroll.min.js'),
    ], 'public/js/core.js')

    // Plugin scripts
    .combine([
        global_path('vendor/jquery-mmenu/jquery.mmenu.min.all.js'),
        global_path('vendor/switchery/switchery.min.js'),
        global_path('vendor/intro-js/intro.js'),
        global_path('vendor/screenfull/screenfull.min.js'),
        global_path('vendor/slidepanel/jquery-slidePanel.min.js'),
        global_path('vendor/bootstrap-select/bootstrap-select.js'),
        global_path('vendor/stickyfill/stickyfill.min.js'),
        global_path('vendor/bootstrap-sweetalert/sweetalert.min.js'),
    ], 'public/js/plugins.js')

    // Star Rating
    .combine([
        'resources/assets/js/star/jquery.star-rating-svg.js',
    ], 'public/js/star_plugin.js')

    // Common Scripts
    .combine([
        // global_path('js/State.js'), removed on new remark
        global_path('js/Component.js'),
        global_path('js/Plugin.js'),
        global_path('js/Base.js'),
        global_path('js/Config.js'),
        layout_path('js/Section/Menubar.js'),
        layout_path('js/Section/Sidebar.js'),
        layout_path('js/Section/PageAside.js'),
        layout_path('js/Section/GridMenu.js'),
    ], 'public/js/scripts.js')

    // Config scripts
    .combine([
        global_path('js/config/colors.js'),
        layout_path('js/config/tour.js'),
    ], 'public/js/config.js')

    // Page scripts
    .combine([
        layout_path('js/Site.js'),
        global_path('js/Plugin/asscrollable.js'),
        global_path('js/Plugin/slidepanel.js'),
        global_path('js/Plugin/switchery.js'),
        global_path('js/Plugin/bootstrap-select.js'),
        global_path('js/Plugin/bootstrap-sweetalert.js')
    ], 'public/js/page.js')

    /******************** Utilities ****************************************/

    // Sortable
    .combine([
        global_path('vendor/html5sortable/sortable.css'),
    ], 'public/css/utility-sortable.css')
    .combine([
        global_path('vendor/html5sortable/html.sortable.js'),
    ], 'public/js/utility-sortable.js')

    // WYSIWYG
    .combine([
        global_path('vendor/summernote/summernote.css'),
    ], 'public/css/utility-wysiwyg.css')
    .combine([
        global_path('vendor/summernote/summernote.min.js'),
        global_path('js/Plugin/summernote.js'),
    ], 'public/js/utility-wysiwyg.js')

    // Dropify File Upload
    .combine([
        global_path('vendor/dropify/dropify.css'),
    ], 'public/css/dropify.css')
    .combine([
        global_path('vendor/dropify/dropify.min.js'),
        global_path('js/Plugin/dropify.js'),
    ], 'public/js/dropify.js')


    /******************** Layouts ****************************************/

    // Public
    .combine([
        global_path('css/bootstrap.min.css'),
        global_path('css/bootstrap-extend.min.css'),
        layout_topbar_path('css/site.css'),
        'resources/assets/css/style.css',
    ], 'public/css/public.css')

    // Auth
    .combine([
        layout_path('examples/css/pages/login-v2.css'),
        layout_path('examples/css/pages/register-v2.css')
    ], 'public/css/auth.css')

    // Error
    .combine([
        layout_path('examples/css/pages/errors.css'),
    ], 'public/css/error.css')

    // Version files
    .version()
