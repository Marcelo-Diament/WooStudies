<?php
/**
 * WooStudies functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage WooStudies
 * @since 1.0.0
 */



/* Enqueue Style*/
function woostudies_enqueue_styles() {
    $parent_style = 'storefront-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'woostudies-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'woostudies_enqueue_styles' );

/* Retorna o URI do tema filho*/
function get_template_directory_child() {
    $directory_template = get_template_directory_uri(); 
    $directory_child = str_replace('storefront', '', $directory_template) . 'woostudies';
    return $directory_child;
}

/* Customizando a página de login */

    /* Logo */

    //$wccImgLogin = get_stylesheet_directory_uri() . '/images/logo-300x300.png);height:150px;';
    function wcwc_login_logo() { ?>
        <style type="text/css">
            #login h1 a, .login h1 a {
                background-image: url(<?php echo get_stylesheet_directory_uri() . '/images/logo-300x300.png);height:150px;'; ?>);
                height:150px;
                width:150px;
                background-size: 150px 150px;
                background-repeat: no-repeat;
                padding-bottom: 30px;
            }
        </style>
    <?php }
    add_action( 'login_enqueue_scripts', 'wcwc_login_logo' );

    /* Link */
    function wcwc_login_logo_url() {
        return home_url();
    }
    add_filter( 'login_headerurl', 'wcwc_login_logo_url' );

    /* Link Title */
    function wcwc_login_logo_url_title() {
        return 'WooStudy Case';
    }
    add_filter( 'login_headertitle', 'wcwc_login_logo_url_title' );

    /* Mensagem */
    function wcwc_login_message(){
        return '<h1 style="text-align:center;">WCWC</h1><br/>';
    }
    add_filter( 'login_message', 'wcwc_login_message' );

    /* Botão */
    function wcwc_login_stylesheet() {
        wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/style-login.css' );
        // wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/style-login.js' );
    }
    add_action( 'login_enqueue_scripts', 'wcwc_login_stylesheet' );

    /* Admin Panel Style */
    function my_admin_theme_style() {
        wp_enqueue_style('my-admin-style', get_stylesheet_directory_uri() . '/style-login.css');
    }
    add_action('admin_enqueue_scripts', 'my_admin_theme_style');

    /* Adicionando página ao Dashboard */
    function add_custom_dashboard_widgets() { 
        wp_add_dashboard_widget(
            'wcwc_dashboard_widget', // Widget slug.
            'WooStudy Case', // Title.
            'custom_dashboard_widget_content' // Display function.
        );
    }
    add_action( 'wp_dashboard_setup', 'add_custom_dashboard_widgets' );

    /* Create the function to output the contents of your Dashboard Widget. */
    function custom_dashboard_widget_content() {
        $wcwc_id_user_logado = get_current_user_id();
        $user_info = get_userdata($wcwc_id_user_logado);
        $user_display_name = $user_info->first_name;
        echo '<h4>Seja bem-vindo ' . $user_display_name . '!</h4><img src="' . get_stylesheet_directory_uri() . '/images/logo-h-321x157.png)" title="WCWC | WooStudy Case" alt""WooStudy Case" height="157" width="auto" style="height:157px;width:auto;margin:auto;padding:5% 9%;"/><p>Através desse painel é possível incluir páginas, posts e realizar uma série de outras edições de conteúdo.</p><p>Em caso de dúvidas, entre em contato com a Djament Comunicação através do email <a href="mailto:contato@djament.com.br" title="Enviar email para Djament">contato@djament.com.br</a>. Obrigado!</p>';
    }