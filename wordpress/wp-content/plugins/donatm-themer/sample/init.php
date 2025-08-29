<?php
use Elementor\Plugin;
use Elementor\Core\Settings\Page\Manager as PageManager;
use Give\Framework\Database\DB;

function donatm_themer_path_demo_content(){
  return (__DIR__.'/demo-data/');
}
add_filter('wbc_importer_dir_path', 'donatm_themer_path_demo_content');

//Way to set menu, import revolution slider, and set home page.
function donatm_themer_import_sample($demo_active_import , $demo_directory_path){

	reset($demo_active_import);
	$current_key = key($demo_active_import);

	//Setting Menus
	$wbc_menu_array = array( 'main' );
	if( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
		$top_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
		if ( isset( $top_menu->term_id ) ) {
			set_theme_mod( 'nav_menu_locations', array(
				'primary' => $top_menu->term_id
			));
		}
	}

	//Set HomePage
	$pageID = donatm_themer_get_post_id_by_title( 'Home 1', 'page' );
	if ($pageID) {
		update_option('page_on_front', $pageID);
		update_option('show_on_front', 'page');
	}
	
	// Import Settings of Elementor
	$options_elementor = maybe_unserialize('a:11:{s:13:"system_colors";a:4:{i:0;a:3:{s:3:"_id";s:7:"primary";s:5:"title";s:7:"Primary";s:5:"color";s:7:"#02A95C";}i:1;a:3:{s:3:"_id";s:9:"secondary";s:5:"title";s:9:"Secondary";s:5:"color";s:7:"#FC791A";}i:2;a:3:{s:3:"_id";s:4:"text";s:5:"title";s:4:"Text";s:5:"color";s:7:"#6C6E76";}i:3;a:3:{s:3:"_id";s:6:"accent";s:5:"title";s:7:"Heading";s:5:"color";s:7:"#17342F";}}s:13:"custom_colors";a:3:{i:0;a:3:{s:3:"_id";s:7:"68a0019";s:5:"title";s:10:"Gray Color";s:5:"color";s:7:"#FFF8F2";}i:1;a:3:{s:3:"_id";s:7:"fe4fa39";s:5:"title";s:11:"Boder Color";s:5:"color";s:7:"#D7D7D7";}i:2;a:3:{s:3:"_id";s:7:"83e7262";s:5:"title";s:5:"Black";s:5:"color";s:7:"#17342F";}}s:17:"system_typography";a:4:{i:0;a:5:{s:3:"_id";s:7:"primary";s:5:"title";s:7:"Primary";s:22:"typography_font_family";s:7:"Manrope";s:22:"typography_font_weight";s:3:"700";s:20:"typography_font_size";a:3:{s:4:"unit";s:2:"px";s:4:"size";i:48;s:5:"sizes";a:0:{}}}i:1;a:5:{s:3:"_id";s:9:"secondary";s:5:"title";s:9:"Secondary";s:22:"typography_font_family";s:7:"Manrope";s:22:"typography_font_weight";s:3:"400";s:20:"typography_font_size";a:3:{s:4:"unit";s:2:"px";s:4:"size";i:16;s:5:"sizes";a:0:{}}}i:2;a:5:{s:3:"_id";s:4:"text";s:5:"title";s:4:"Text";s:22:"typography_font_family";s:7:"Manrope";s:22:"typography_font_weight";s:3:"400";s:20:"typography_font_size";a:3:{s:4:"unit";s:2:"px";s:4:"size";i:16;s:5:"sizes";a:0:{}}}i:3;a:5:{s:3:"_id";s:6:"accent";s:5:"title";s:6:"Accent";s:22:"typography_font_family";s:7:"Manrope";s:22:"typography_font_weight";s:3:"400";s:20:"typography_font_size";a:3:{s:4:"unit";s:2:"px";s:4:"size";i:16;s:5:"sizes";a:0:{}}}}s:17:"custom_typography";a:0:{}s:21:"default_generic_fonts";s:10:"Sans-serif";s:9:"site_name";s:42:"Donatm - Nonprofit Charity WordPress Theme";s:19:"page_title_selector";s:14:"h1.entry-title";s:15:"activeItemIndex";i:1;s:11:"viewport_md";i:768;s:11:"viewport_lg";i:1025;s:15:"container_width";a:3:{s:4:"unit";s:2:"px";s:4:"size";i:1200;s:5:"sizes";a:0:{}}}', true);
	$active_kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();
	update_post_meta($active_kit_id, '_elementor_page_settings', $options_elementor);
	update_option('use_extendify_templates', '0');
	update_option( 'elementor_experiment-e_dom_optimization', 'inactive' );
	update_option( 'elementor_experiment-a11y_improvements', 'inactive' );
	update_option( 'elementor_editor_break_lines', '1' );
	update_option( 'elementor_unfiltered_files_upload', '1' );
	update_option( 'elementor_experiment-container', 'active' );
	update_option( 'elementor_experiment-e_element_cache', 'inactive' );
	update_option( 'elementor_experiment-e_optimized_assets_loading', 'inactive' );
	update_option( 'elementor_experiment-additional_custom_breakpoints', 'inactive' );
	update_option( 'elementor_experiment-e_swiper_latest', 'inactive' );
	update_option( 'elementor_experiment-e_optimized_css_loading', 'inactive' );
	update_option( 'elementor_experiment-e_font_icon_svg', 'inactive' );

	if( class_exists('Give') ){
		donatm_themer_give_import_meta();
		update_option('donatm_give_imported', 'yes');
	}

	// Import Settings of Event
	$options_event = maybe_unserialize('a:18:{s:8:"did_init";b:1;s:19:"tribeEventsTemplate";s:0:"";s:16:"tribeEnableViews";a:3:{i:0;s:4:"list";i:1;s:5:"month";i:2;s:3:"day";}s:10:"viewOption";s:4:"list";s:14:"schema-version";s:6:"6.14.1";s:21:"previous_ecp_versions";a:15:{i:0;s:1:"0";i:1;s:5:"6.1.3";i:2;s:5:"6.1.4";i:3;s:7:"6.2.0.1";i:4;s:5:"6.8.0";i:5;s:7:"6.8.2.1";i:6;s:5:"6.8.3";i:7;s:5:"6.9.0";i:8;s:8:"6.10.1.1";i:9;s:6:"6.10.2";i:10;s:6:"6.12.0";i:11;s:8:"6.12.0.1";i:12;s:6:"6.13.0";i:13;s:8:"6.13.2.1";i:14;s:6:"6.14.0";}s:18:"latest_ecp_version";s:6:"6.14.1";s:18:"dateWithYearFormat";s:6:"F j, Y";s:24:"recurrenceMaxMonthsAfter";i:60;s:22:"google_maps_js_api_key";s:39:"AIzaSyDNsicAsP6-VuGtAb1O9riI3oc_NOb7IOU";s:39:"last-update-message-the-events-calendar";s:5:"6.1.3";s:24:"front_page_event_archive";b:0;s:13:"opt-in-status";b:0;s:11:"latest_date";s:19:"2025-12-11 17:00:00";s:13:"earliest_date";s:19:"2025-12-11 08:00:00";s:21:"earliest_date_markers";a:1:{i:0;i:386;}s:19:"latest_date_markers";a:1:{i:0;i:386;}s:18:"tec-schema-version";s:5:"6.8.3";}', true);
	update_option('tribe_events_calendar_options', $options_event);

	if (function_exists('is_plugin_active') && is_plugin_active( 'elementor/elementor.php' )) {
		\Elementor\Plugin::$instance->files_manager->clear_cache();
	}
}

add_action('wbc_importer_after_content_import', 'donatm_themer_import_sample', 10, 2);

function donatm_themer_give_import_meta(){
   global $wpdb;

   $check_import = get_option('donatm_give_imported', 'no');
   if($check_import == 'yes') return false;

   $campaigns = array(
   	'New clothes for highland children',
   	'Raise fund cause water clear for life',
   	'Help Children poor Insurance and Medical',
   	'Help poor kids after an unfortunate tragedy',
   	'Raise funds for clean water system for rural poor',
   	'Raise funds for children clean and healthy food',
   	'Give African Childrens a good Education and Healthy',
   	'Your small help can bring a Better Life to Everyone',
   	'Raise Fund for Clean Water and Healthy Food'
   );

   $thumbs = array('campaign-01', 'campaign-02', 'campaign-03', 'campaign-04', 'campaign-05', 'campaign-06', 'campaign-07', 'campaign-08', 'campaign-09');

   $i = 0;
   $imageUrl = 'https://themegavias.com/wp/donatm/wp-content/uploads/2025/05/campaign-02.jpg';
   foreach ($campaigns as $title) {
   	$formId = $campaignPageID = '';
   	$formId = donatm_themer_get_post_id_by_title($title, 'give_forms');
		$campaignPageID = donatm_themer_get_post_id_by_title($title , 'page');
		$imageID = donatm_themer_get_post_id_by_title($thumbs[$i] , 'attachment');
		if($imageID){
			$imageUrl = wp_get_attachment_url($imageID);
		}
		DB::table('give_campaigns')
   	->insert([
	      'form_id' 				=> $formId,
	      'campaign_type' 		=> 'core',
	      'campaign_title' 		=> $title,
	      'campaign_page_id' 	=> $campaignPageID,
	      'status' 				=> 'active',
	      'short_desc' 			=> 'Lorem ipsum dolor sit amet, consectetur eiusmod tempor incididunt.',
	      'long_desc' 			=> '',
	      'campaign_logo' 		=> '',
	      'campaign_image' 		=> $imageUrl,
	      'primary_color' 		=> '#0b72d9',
	      'secondary_color' 	=> '#27ae60',
	      'campaign_goal' 		=> '38000',
	      'goal_type' 			=> 'amount',
	      'start_date' 			=> '',
	      'end_date' 				=> null,
	      'date_created' 		=> '',
   	]);
        
      $campaignId = DB::last_insert_id();

	   DB::table('give_campaign_forms')
      ->insert([
         'form_id' => $formId,
         'campaign_id' => $campaignId,
      ]);

      // Update Meta Form
      $insert_query  = "INSERT INTO {$wpdb->formmeta} (form_id, meta_key, meta_value) ";
      if(get_post_type($formId) == 'give_forms'){
   		$query_values = [];
		   $post_meta_data = array(
		   	'formBuilderSettings'	=> '{"showHeader":true,"showHeading":true,"showDescription":true,"formTitle":"Raise Fund for Clean Water and Healthy Food","enableDonationGoal":true,"enableAutoClose":false,"goalSource":"campaign","goalType":"amount","goalProgressType":"all_time","goalStartDate":"","goalEndDate":"","designId":"classic","heading":"Support Our Cause","description":"Help our organization by donating today! Donations go to making a difference for our cause.","primaryColor":"#69b86b","secondaryColor":"#f49420","goalAmount":28000,"registrationNotification":false,"customCss":"","goalAchievedMessage":"Thank you to all our donors, we have met our fundraising goal.","pageSlug":"raise-fund-for-clean-water-and-healthy-food","receiptHeading":"Hey {first_name}, thanks for your donation!","receiptDescription":"{first_name}, your contribution means a lot and will be put to good use in making a difference. We\u2019ve sent your donation receipt to {email}.","formStatus":"publish","emailTemplateOptions":[],"emailOptionsStatus":"global","emailTemplate":"default","emailLogo":"","emailFromName":"","emailFromEmail":"","formGridCustomize":false,"formGridRedirectUrl":"","formGridDonateButtonText":"","formGridHideDocumentationLink":false,"offlineDonationsCustomize":false,"offlineDonationsInstructions":"","donateButtonCaption":"Donate now","multiStepFirstButtonText":"Donate now","multiStepNextButtonText":"Continue","pdfSettings":[],"designSettingsImageUrl":"http:\/\/donatm.localhost\/wp-content\/uploads\/2025\/05\/campaign-01.jpg","designSettingsImageAlt":"","designSettingsImageStyle":"background","designSettingsLogoUrl":"","designSettingsLogoPosition":"left","designSettingsSectionStyle":"default","designSettingsTextFieldStyle":"default","designSettingsImageColor":"#000000","designSettingsImageOpacity":"56","formExcerpt":"","currencySwitcherSettings":[],"enableReceiptConfirmationPage":false,"inheritCampaignColors":true}',
		      'formBuilderFields'		=> '[{"name":"givewp/section","clientId":"dc0cb152-c09d-4a36-9b04-57703505bd89","isValid":true,"attributes":{"title":"How much would you like to donate today?","description":"All donations directly impact our organization and help us further our mission."},"innerBlocks":[{"name":"givewp/donation-amount","clientId":"5b2f7498-5f26-4516-910e-c6b57b1b37ef","isValid":true,"attributes":{"label":"Donation Amount","levels":[{"value":10,"checked":true},{"value":25},{"value":50},{"value":100},{"value":250},{"value":500}],"priceOption":"multi","setPrice":25,"customAmount":true,"customAmountMin":1,"recurringBillingPeriodOptions":["month"],"recurringBillingInterval":1,"recurringEnabled":false,"recurringLengthOfTime":"0","recurringOptInDefaultBillingPeriod":"month","recurringEnableOneTimeDonations":true},"innerBlocks":[]}]},{"name":"givewp/section","clientId":"fd44b90e-28e2-4af5-bc4d-3d808e0a30e1","isValid":true,"attributes":{"title":"Who iss Giving Today?","description":"We will never share this information with anyone."},"innerBlocks":[{"name":"givewp/donor-name","clientId":"286c927d-ad2e-4b8f-a008-08c2a0adb9f2","isValid":true,"attributes":{"showHonorific":false,"honorifics":["Mr","Ms","Mrs"],"firstNameLabel":"First name","firstNamePlaceholder":"First name","lastNameLabel":"Last name","lastNamePlaceholder":"Last name","requireLastName":false},"innerBlocks":[]},{"name":"givewp/email","clientId":"7d7041e2-8ce5-4bc3-89e2-9dd3fa9992f7","isValid":true,"attributes":{"label":"Email Address","isRequired":true},"innerBlocks":[]}]},{"name":"givewp/section","clientId":"44b88c2e-c3cc-498b-b34e-3ad540f6dfa0","isValid":true,"attributes":{"title":"Payment Details","description":"How would you like to pay for your donation?"},"innerBlocks":[{"name":"givewp/donation-summary","clientId":"bd2e77bc-9803-474b-aa4e-11e8ce934e09","isValid":true,"attributes":[],"innerBlocks":[]},{"name":"givewp/payment-gateways","clientId":"ae710e83-28da-4601-ad24-efe40b4bf024","isValid":true,"attributes":[],"innerBlocks":[]}]}]',
		      '_thumbnail_id' 			=> $imageID,
		      '_give_price_option'			=> 'multi',
		      '_give_donation_levels' 	=> 'a:6:{i:0;a:3:{s:8:"_give_id";a:1:{s:8:"level_id";i:0;}s:12:"_give_amount";d:10;s:10:"_give_text";s:0:"";}i:1;a:3:{s:8:"_give_id";a:1:{s:8:"level_id";i:1;}s:12:"_give_amount";d:25;s:10:"_give_text";s:0:"";}i:2;a:3:{s:8:"_give_id";a:1:{s:8:"level_id";i:2;}s:12:"_give_amount";d:50;s:10:"_give_text";s:0:"";}i:3;a:3:{s:8:"_give_id";a:1:{s:8:"level_id";i:3;}s:12:"_give_amount";d:100;s:10:"_give_text";s:0:"";}i:4;a:3:{s:8:"_give_id";a:1:{s:8:"level_id";i:4;}s:12:"_give_amount";d:250;s:10:"_give_text";s:0:"";}i:5;a:3:{s:8:"_give_id";a:1:{s:8:"level_id";i:5;}s:12:"_give_amount";d:500;s:10:"_give_text";s:0:"";}}',
		   	'_give_form_earnings'   	=> 0,
		   	'_give_goal_option'			=> 'enabled',
		   	'_give_goal_format'			=> 'amount',
		   	'_give_set_goal'				=> '38000',
		   	'_give_form_grid_option' 	=> 'global',
		   	'_give_email_options'		=> 'global'
		   );

		   foreach ( $post_meta_data as $meta_key => $meta_data ) {
		      $query_values[] = "( {$formId}, '{$meta_key}', '{$meta_data}' ) ";
		   }

		   $query_values_string = implode( ' , ', $query_values );
		   $query_import = $insert_query . ' VALUES ' . $query_values_string;
		   $wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->formmeta} WHERE form_id = '%d'", $formId ) );
		   $wpdb->query( $query_import ); 

		   $i++;
   	}
   }
}

function donatm_themer_get_post_id_by_title( string $title = '', $post_type = 'post' ){
    	$posts = get_posts(
        	array(
            'post_type'              => $post_type,
            'title'                  => $title,
            'numberposts'            => 1,
            'update_post_term_cache' => false,
            'update_post_meta_cache' => false,
            'orderby'                => 'post_date ID',
            'order'                  => 'ASC',
            'fields'                 => 'ids'
        	)
    	);
    	return empty( $posts ) ? '' : $posts[0];
	}
