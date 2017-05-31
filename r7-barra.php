<?php
/**
 * Plugin Name: Barra R7
 * Description: Adiciona barra do portal R7 ao site
 * Author: Bruno Borges <brbsilva@sp.r7.com>
 * Author URI: www
 * Version: 0.1
 * License: GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
include_once 'admin_config.php';

if ( is_admin() ) {
	return;
}

function is_from_r7() {
	$referer = $_SERVER['HTTP_REFERER'];

	if ( strpos( $referer, 'r7.com' ) !== false ) {
		return true;
	}
	return false;
}

function footer_r7() {
	$label_partner = get_option( 'label_partner' );
	$background_color = get_option( 'background_color' );

	?>
	<script id="r7-footer-portal" src="http://barra.r7.com/footer/footer-portal/footer-portal.js" charset="UTF-8">
		{showPane:false, bgC:"<?php echo $background_color;?>", isPartner: "true", partnerLabel:"<?php echo $label_partner;?>"}
	</script>
	<?php
}

function header_r7() {
	$sub_menu = get_option( 'sub_menu' );
	$banner = get_option( 'show_banner' );
  $acessibilidade = get_option( 'show_acessibilidade' );
	$r7_play = get_option( 'show_r7_play' );
	$url_admin_menu = "https://cms-media-api.r7.com/menu/58ee86211d42061afb000002";

	?>
	<script
		src="https://code.jquery.com/jquery-3.2.1.min.js"
		integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
		crossorigin="anonymous"></script>

	<script type="text/javascript" id="r7barrautil" src="http://localhost/sites-core/wp-content/plugins/barra-generica/src/barra-v2.js">
		{r7_play: "<?php echo $r7_play;?>", acessibilidade: "<?php echo $acessibilidade;?>", url_admin_menu: "<?php echo $url_admin_menu;?>", responsivo:true, banner: "<?php echo $banner;?>", submenu:"<?php echo $sub_menu;?>"}

	</script>
	<?php
}

$r7_show_banner_using_referer = get_option( 'r7_referer' );

if ( $r7_show_banner_using_referer && !is_from_r7() ) {
	return;
}


add_action('wp_head', 'header_r7');

