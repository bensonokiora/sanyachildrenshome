<?php
Redux::setSection($opt_name, array(
   'icon'   => 'el-icon-th-list',
   'title'  => esc_html__('Page Options', 'donatm'),
   'fields' => array(
      array(
         'id'     => 'nf_page_info',
         'type'   => 'info',
         'icon'   => true,
         'raw'    => '<h3 class="mb-0">' . esc_html__('404 Page Settings', 'donatm') . '</h3>',
      ),
      array(
         'id'        => 'nfpage_image',
         'type'      => 'media',
         'url'       => true,
         'title'     => esc_html__('Image', 'donatm'),
         'default'   => '',
      ),
      array(
         'id'        => 'nfpage_image_width',
         'type'      => 'slider',
         'title'     => esc_html__('Image Width', 'donatm'),
         'default'   => 500,
         'min'       => 50,
         'max'       => 1200,
         'step'      => 5,
         'display_value' => 'text',
      ),
      array(
         'id'        => 'nfpage_title',
         'type'      => 'text',
         'title'     => esc_html__('Title Text', 'donatm'),
         'default'   => esc_html__('OPPS! This Page is Not Found', 'donatm'),
      ),
      array(
         'id'        => 'nfpage_desc',
         'type'      => 'textarea',
         'title'     => esc_html__('Primary Text', 'donatm'),
         'default'   => esc_html('The page requested could not be found. This could be a spelling error in the URL or a removed page.', 'donatm')
      ),
      array(
         'id'        => 'nfpage_btn_title',
         'type'      => 'text',
         'title'     => esc_html__('Button Title', 'donatm'),
         'default'   => esc_html__('Back Homepage', 'donatm'),
      ),
      array(
         'id'        => 'nfpage_btn_link',
         'type'      => 'text',
         'title'     => esc_html__('Button Link', 'donatm'),
         'default'   => '',
      ),
   )
));  