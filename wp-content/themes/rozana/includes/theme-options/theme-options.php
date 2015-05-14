<?php
	function removeDemoModeLink() { // Be sure to rename this function to something more unique
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
		}
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
		}
	}
	//add_action('<span id="IL_AD3" class="IL_AD">init</span>', 'removeDemoModeLink');
	
	
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux_Framework_sample_config' ) ) {

        class Redux_Framework_sample_config {

            public $args = array();
            public $sections = array();
            public $theme;
            public $ReduxFramework;

            public function __construct() {

                if ( ! class_exists( 'ReduxFramework' ) ) {
                    return;
                }

                // This is needed. Bah WordPress bugs.  ;)
                if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                    $this->initSettings();
                } else {
                    add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
                }

            }

            public function initSettings() {

                // Just for demo purposes. Not needed per say.
                $this->theme = wp_get_theme();

                // Set the default arguments
                $this->setArguments();

                // Set a few help tabs so you can see how it's done
                $this->setHelpTabs();

                // Create the sections and fields
                $this->setSections();

                if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                    return;
                }

                // If Redux is running as a plugin, this will remove the demo notice and links
                add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

                // Function to test the compiler hook and demo CSS output.
                // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
                //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);

                // Change the arguments after they've been declared, but before the panel is created
                //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );

                // Change the default value of a field after it's been set, but before it's been useds
                //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

                // Dynamically add a section. Can be also used to modify sections/fields
                //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

                $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
            }

            /**
             * This is a test function that will let you see when the compiler hook occurs.
             * It only runs if a field    set with compiler=>true is changed.
             * */
            function compiler_action( $sama_options, $css, $changed_values ) {
                echo '<h1>The compiler hook has run!</h1>';
                echo "<pre>";
                print_r( $changed_values ); // Values that have changed since the last save
                echo "</pre>";
                //print_r($sama_options); //Option values
                //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

                /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
            }

            /**
             * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
             * Simply include this function in the child themes functions.php file.
             * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
             * so you must use get_template_directory_uri() if you want to use any of the built in icons
             * */
            function dynamic_section( $sections ) {
                //$sections = array();
                $sections[] = array(
                    'title'  => __( 'Section via hook', 'samathemes' ),
                    'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'samathemes' ),
                    'icon'   => 'el-icon-paper-clip',
                    // Leave this as a blank section, no options just some intro text set above.
                    'fields' => array()
                );

                return $sections;
            }

            /**
             * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
             * */
            function change_arguments( $args ) {
                //$args['dev_mode'] = true;

                return $args;
            }

            /**
             * Filter hook for filtering the default value of any given field. Very useful in development mode.
             * */
            function change_defaults( $defaults ) {
                $defaults['str_replace'] = 'Testing filter hook!';

                return $defaults;
            }

            // Remove the demo link and the notice of integrated demo from the redux-framework plugin
            function remove_demo() {

                // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
                if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                    remove_filter( 'plugin_row_meta', array(
                        ReduxFrameworkPlugin::instance(),
                        'plugin_metalinks'
                    ), null, 2 );

                    // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                    remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
                }
            }

            public function setSections() {

                /**
                 * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
                 * */
                // Background Patterns Reader
                $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
                $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
                $sample_patterns      = array();

                if ( is_dir( $sample_patterns_path ) ) :

                    if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
                        $sample_patterns = array();

                        while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                            if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                                $name              = explode( '.', $sample_patterns_file );
                                $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                                $sample_patterns[] = array(
                                    'alt' => $name,
                                    'img' => $sample_patterns_url . $sample_patterns_file
                                );
                            }
                        }
                    endif;
                endif;

                ob_start();

                $ct          = wp_get_theme();
                $this->theme = $ct;
                $item_name   = $this->theme->get( 'Name' );
                $tags        = $this->theme->Tags;
                $screenshot  = $this->theme->get_screenshot();
                $class       = $screenshot ? 'has-screenshot' : '';

                $customize_title = sprintf( __( 'Customize &#8220;%s&#8221;', 'samathemes' ), $this->theme->display( 'Name' ) );

                ?>
                <div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
                    <?php if ( $screenshot ) : ?>
                        <?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
                            <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize"
                               title="<?php echo esc_attr( $customize_title ); ?>">
                                <img src="<?php echo esc_url( $screenshot ); ?>"
                                     alt="<?php esc_attr_e( 'Current theme preview', 'samathemes' ); ?>"/>
                            </a>
                        <?php endif; ?>
                        <img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>"
                             alt="<?php esc_attr_e( 'Current theme preview', 'samathemes' ); ?>"/>
                    <?php endif; ?>

                    <h4><?php echo $this->theme->display( 'Name' ); ?></h4>

                    <div>
                        <ul class="theme-info">
                            <li><?php printf( __( 'By %s', 'samathemes' ), $this->theme->display( 'Author' ) ); ?></li>
                            <li><?php printf( __( 'Version %s', 'samathemes' ), $this->theme->display( 'Version' ) ); ?></li>
                            <li><?php echo '<strong>' . __( 'Tags', 'samathemes' ) . ':</strong> '; ?><?php printf( $this->theme->display( 'Tags' ) ); ?></li>
                        </ul>
                        <p class="theme-description"><?php echo $this->theme->display( 'Description' ); ?></p>
                        <?php
                            if ( $this->theme->parent() ) {
                                printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'samathemes' ) . '</p>', __( 'http://codex.wordpress.org/Child_Themes', 'samathemes' ), $this->theme->parent()->display( 'Name' ) );
                            }
                        ?>

                    </div>
                </div>

                <?php
                $item_info = ob_get_contents();

                ob_end_clean();

                $sampleHTML = '';
                if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
                    Redux_Functions::initWpFilesystem();

                    global $wp_filesystem;

                    $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
                }

                // ACTUAL DECLARATION OF SECTIONS
				$this->sections[] = array(
                    'icon'   => 'el-icon-cogs',
                    'title'  => __( 'General Settings', 'samathemes' ),
                    'fields' => array(
                        array(
                            'id'       => 'display_load_img',
                            'type'     => 'switch',
                            'title'    => __( 'Enable Page Loader', 'samathemes' ),
                            'default'  => true
                        ),
						array(
                            'id'       => 'menu_phone_1',
                            'type'     => 'text',
                            'title'    => __( 'Phone Number 1', 'samathemes' ),
							'desc'     => __('This field display at end of navigation menu.', 'samathemes'),
                        ),
						array(
                            'id'       => 'menu_phone_2',
                            'type'     => 'text',
                            'title'    => __( 'Phone Number 2', 'samathemes' ),
							'desc'     => __('This field display at end of navigation menu.', 'samathemes'),
                        ),
                    )
                );
				
				$this->sections[] = array(
                    'icon'   => 'el-icon-eye-open',
                    'title'  => __( 'Logo and Favicons', 'samathemes' ),
                    'fields' => array(
						array(
                            'id'       => 'logo_url',
                            'type'     => 'media',
                            'title'    => __( 'Logo for header horizontal', 'samathemes' ),
                            'desc'     => __( 'This Logo display in horizontal header outside menu. ', 'samathemes' ),
                        ),
                        array(
                            'id'       => 'logo_url_inside_menu',
                            'type'     => 'media',
                            'title'    => __( 'Logo for header horizontal inside menu', 'samathemes' ),
                            'desc'     => __( 'This Logo display in horizontal header inside menu. ', 'samathemes' ),
                        ),
						array(
                            'id'       => 'vertical_logo_outside',
                            'type'     => 'media',
                            'title'    => __( 'Logo for header vertical', 'samathemes' ),
                            'desc'     => __( 'This Logo display in vertical header outside menu. ', 'samathemes' ),
                        ),
                        array(
                            'id'       => 'vertical_logo_inside',
                            'type'     => 'media',
                            'title'    => __( 'Logo for header vertical inside menu', 'samathemes' ),
                            'desc'     => __( 'This Logo display in vertical header inside menu. ', 'samathemes' ),
                        ),
						array(
                            'id'       => 'favicon',
                            'type'     => 'media',
							'title'    => __( 'Favicon', 'samathemes' ),
                            'desc'     => __( 'A favicon is a 16x16 pixel icon that represents your site. ', 'samathemes' ),
                        ),
						array(
                            'id'       => 'apple_touch_icon_57',
                            'type'     => 'media',
							'title'    => __( 'Apple Custom Icon (57x57)', 'samathemes' ),
                            'desc'     => __( 'Upload your Apple Touch Icon (57x57px png). ', 'samathemes' ),
                        ),
						array(
                            'id'       => 'apple_touch_icon_72',
                            'type'     => 'media',
							'title'    => __( 'Apple Custom Icon (72x72)', 'samathemes' ),
                            'desc'     => __( 'Upload your Apple Touch Icon (72x72px png). ', 'samathemes' ),
                        ),
						array(
                            'id'       => 'apple_touch_icon_114',
                            'type'     => 'media',
							'title'    => __( 'Apple Custom Icon (114x114)', 'samathemes' ),
                            'desc'     => __( 'Upload your Apple Touch Icon (114x114px png). ', 'samathemes' ),
                        ),
                    )
                );
				$this->sections[] = array(
                    'icon'   => 'el-icon-th',
                    'title'  => __( 'Menu', 'samathemes' ),
                    'fields' => array(
						array(
                            'id'       => 'main_menu',
                            'type'     => 'button_set',
                            'title'    => __( 'Menu Type', 'samathemes' ),
                            'options'  => array(
								'defaultmenu' 	=> __('Default', 'samathemes'),
                                'horizental' 	=> __('Horizental', 'samathemes'),
                                'vertical' 		=> __('Vertical', 'samathemes')
                            ),
                            'default'  => 'defaultmenu'
                        ),
						array(
                            'id'       => 'small_defaultmenu',
                            'type'     => 'button_set',
                            'title'    => __( 'Small Menu', 'samathemes' ),
							'desc'     => __( 'When scroll page display make menu small.', 'samathemes' ),
                            'options'  => array(
								'yes' 	=> __('Yes', 'samathemes'),
                                'no' 	=> __('no', 'samathemes'),
                            ),
                            'default'  => 'yes',
							'required' => array('main_menu','equals', 'defaultmenu')
                        ),
						array(
						    'id'       => 'display_vertical_menu',
                            'type'     => 'select',
                            'data'     => 'pages',
                            'multi'    => true,
                            'title'    => __( 'Display Vertical Menu', 'samathemes' ),
                            'desc'     => __( 'Select pages to display vertical menu.', 'samathemes' ),
							'required' => array('main_menu','!=', 'vertical'),
                        ),
						array(
						    'id'       => 'display_horizental_menu',
                            'type'     => 'select',
                            'data'     => 'pages',
                            'multi'    => true,
                            'title'    => __( 'Display Horizental Menu', 'samathemes' ),
                            'desc'     => __( 'Select pages to display horizental menu.', 'samathemes' ),
							'required' => array('main_menu','!=', 'horizental'),
                        ),
						array(
						    'id'       => 'display_default_menu',
                            'type'     => 'select',
                            'data'     => 'pages',
                            'multi'    => true,
                            'title'    => __( 'Display Defalut Menu', 'samathemes' ),
                            'desc'     => __( 'Select pages to display default menu.', 'samathemes' ),
							'required' => array('main_menu','!=', 'defaultmenu'),
                        ),
						
						array(
                            'id'       => 'remove_top_header',
                            'type'     => 'select',
                            'data'     => 'pages',
                            'multi'    => true,
                            'title'    => __( 'Remove top header without menu', 'samathemes' ),
                            'subtitle' => __( 'For horizental menu only', 'samathemes' ),
                            'desc'     => __( 'Select pages to remove top header without menu.', 'samathemes' ),
                        ),
						array(
                            'id'       => 'remove_menu_and_header',
                            'type'     => 'select',
                            'data'     => 'pages',
                            'multi'    => true,
                            'title'    => __( 'Remove top header and menu', 'samathemes' ),
                            //'subtitle' => __( 'No validation can be done on this field type', 'samathemes' ),
                            'desc'     => __( 'Select pages to remove top header and menu.', 'samathemes' ),
                        ),
						array(
                            'id'       => 'landing_menu',
                            'type'     => 'select',
                            'data'     => 'pages',
                            'multi'    => true,
                            'title'    => __( 'Landing Page Menu', 'samathemes' ),
							'subtitle' => __( 'Optional', 'samathemes' ),
                            'desc'     => __( 'Select this menu for some different page this replace defalut top menu with this menu.', 'samathemes' ),
                        ),
						array(
                            'id'       => 'one_page_menu',
                            'type'     => 'select',
                            'data'     => 'pages',
                            'multi'    => true,
                            'title'    => __( 'One Page Menu', 'samathemes' ),
							'subtitle' => __( 'Optional', 'samathemes' ),
                            'desc'     => __( 'Select this menu for some different page this replace defalut top menu with this menu.', 'samathemes' ),
                        ),
						array(
                            'id'       => 'remove_phone_menu',
                            'type'     => 'select',
                            'data'     => 'pages',
                            'multi'    => true,
                            'title'    => __( 'Remove Phone Number', 'samathemes' ),
							'subtitle' => __( 'Optional', 'samathemes' ),
                            'desc'     => __( 'Select Pages to remove phone number from this page.', 'samathemes' ),
                        ),
                    )
                );
				
				$this->sections[] = array(
                    'icon'   => 'el-icon-bold',
                    'title'  => __( 'Blog', 'samathemes' ),
					'desc'	 => __('This fields used in blog page or home page blog , search, category, tags, archives page', 'samathemes'),
                    'fields' => array(
						array(
                            'id'       => 'blog_type',
                            'type'     => 'select',
                            'title'    => __( 'Blog Type', 'samathemes' ),
                            'options'  => array(
                                'grid' 					=> __('Grid', 'samathemes'),
                                'list' 					=> __('List', 'samathemes'),
								'masonry' 				=> __('Masonry', 'samathemes'),
								'bigthumbnails' 		=> __('Big thumbnails full width', 'samathemes'),
								'bigthumbwithsidebar' 	=> __('Big thumb with sidebar', 'samathemes'),
								'wpdefalutfullwidth' 	=> __('Default Wordpress full width', 'samathemes'),
								'wpdefaultwithsidebar' 	=> __('Default Wordpress With Siderbar', 'samathemes'),
                            ),
                            'default'  => 'bigthumbwithsidebar'
                        ),
						array(
                            'id'       => 'display_blog_grid_cat',
                            'type'     => 'switch',
                            'title'    => __( 'Display blog categories', 'samathemes' ),
                            'desc' => __( 'Display blog categories at top of blog grid', 'samathemes' ),
                            'default'  => true,
							'required' => array('blog_type','equals','grid'),
							'on'	=> 'Yes',
							'off'	=> 'No',
                        ),
						array(
                            'id'   => 'sama-divide-1',
                            'type' => 'divide'
                        ),
						array(
                            'id'       => 'display_title_in_aside',
                            'type'     => 'button_set',
                            'title'    => __( 'Display title in Aside Post Format', 'samathemes' ),
							'desc' => __( 'Wordpress aside post format by default not have title if all aside post format in your blog have title you can choose yes to display it.', 'samathemes' ),
                            'options'  => array(
                                'yes' 	=> __('Yes', 'samathemes'),
                                'no' 	=> __('No', 'samathemes')
                            ),
                            'default'  => 'no'
                        ),
						array(
                            'id'       => 'display_title_in_link',
                            'type'     => 'button_set',
                            'title'    => __( 'Display title in Link Post Format', 'samathemes' ),
							'desc' => __( 'Wordpress Link post format by default not display title display link to another page that you add inside content and before more tag.', 'samathemes' ),
                            'options'  => array(
                                'yes' 	=> __('Yes', 'samathemes'),
                                'no' 	=> __('No', 'samathemes')
                            ),
                            'default'  => 'no'
                        ),
						array(
                            'id'       => 'display_title_in_quote',
                            'type'     => 'button_set',
                            'title'    => __( 'Display title in Quote Post Format', 'samathemes' ),
							'desc' => __( 'By defalut in blog archive not display quote post title.', 'samathemes' ),
                            'options'  => array(
                                'yes' 	=> __('Yes', 'samathemes'),
                                'no' 	=> __('No', 'samathemes')
                            ),
                            'default'  => 'no'
                        ),
						array(
                            'id'   => 'sama-divide',
                            'type' => 'divide'
                        ),
						array(
                            'id'       => 'video_post_view_thumb',
                            'type'     => 'button_set',
                            'title'    => __( 'Video Post Format', 'samathemes' ),
							'desc' => __( 'By default in archive blog theme display video you can choose display thumbnail at top instead video.', 'samathemes' ),
                            'options'  => array(
                                'yes' 	=> __('Display Thumbnail', 'samathemes'),
                                'no' 	=> __('Display Video', 'samathemes')
                            ),
                            'default'  => 'no'
                        ),
						array(
                            'id'       => 'gallery_post_view_thumb',
                            'type'     => 'button_set',
                            'title'    => __( 'Gallery Post Format', 'samathemes' ),
							'desc' => __( 'By default in archive blog theme display slider you can choose to display thumbnail at top instead slider.', 'samathemes' ),
                            'options'  => array(
                                'yes' 	=> __('Display Thumbnail', 'samathemes'),
                                'no' 	=> __('Display Gallery', 'samathemes')
                            ),
                            'default'  => 'no'
                        ),
						array(
                            'id'       => 'audio_post_view_thumb',
                            'type'     => 'button_set',
                            'title'    => __( 'Audio Post Format', 'samathemes' ),
							'desc' => __( 'By default in archive blog theme display audio you can choose to display thumbnail at top instead audio.', 'samathemes' ),
                            'options'  => array(
                                'yes' 	=> __('Display Thumbnail', 'samathemes'),
                                'no' 	=> __('Display Audio', 'samathemes')
                            ),
                            'default'  => 'no'
                        ),
						
						array(
                            'id'       => 'display_quote_in_archive',
                            'type'     => 'button_set',
                            'title'    => __( 'Quote Post Format', 'samathemes' ),
							'desc' => __( 'By default in archive blog theme display quote you can choose to display thumbnail at top instead quote.', 'samathemes' ),
                            'options'  => array(
                                'thumb' 	=> __('Thumbnail', 'samathemes'),
								'quote' 	=> __('Quote', 'samathemes')
                            ),
                            'default'  => 'quote'
                        ),
						array(
                            'id'   => 'sama-divide-1',
                            'type' => 'divide'
                        ),
						array(
                            'id'       => 'display_author_archive',
                            'type'     => 'switch',
                            'title'    => __( 'Display Author', 'samathemes' ),
                            'default'  => true,
							'on'	=> 'Yes',
							'off'	=> 'No',
                        ),
						array(
                            'id'       => 'display_tags_archive',
                            'type'     => 'switch',
                            'title'    => __( 'Display Tags', 'samathemes' ),
                            'default'  => true,
							'on'		=> 'Yes',
							'off'		=> 'No',
                        ),
						array(
                            'id'       => 'display_views_archive',
                            'type'     => 'switch',
                            'title'    => __( 'Display post views', 'samathemes' ),
							'desc' 	   => __( 'This require to use wp postviews plugin', 'samathemes'),
                            'default'  => true,
							'on'	   => 'Yes',
							'off'	   => 'No',
                        ),
						array(
                            'id'       => 'display_comments_archive',
                            'type'     => 'switch',
                            'title'    => __( 'Display Number of Comments', 'samathemes' ),
                            'default'  => true,
							'on'	=> 'Yes',
							'off'	=> 'No',
                        ),
						array(
                            'id'       => 'grid_excerpt',
                            'type'     => 'text',
                            'title'    => __( 'Excerpt Length for Blog Grid', 'samathemes' ),
                            'validate' => 'numeric',
                            'default'  => '16',
                        ),
						array(
                            'id'       => 'list_excerpt',
                            'type'     => 'text',
                            'title'    => __( 'Excerpt Length for Blog List', 'samathemes' ),
                            'validate' => 'numeric',
                            'default'  => '45',
                        ),
						array(
                            'id'       => 'bigthumbnails_excerpt',
                            'type'     => 'text',
                            'title'    => __( 'Excerpt Length for Blog Big Thumbnails', 'samathemes' ),
                            'validate' => 'numeric',
                            'default'  => '75',
                        ),
                    )
                );
				
				$this->sections[] = array(
                    'icon'   => 'el-icon-blogger',
					'subsection' => true,
                    'title'  => __( 'Blog Post', 'samathemes' ),
					'desc'	 => __('This fields used in Blog post', 'samathemes'),
                    'fields' => array(
						array(
                            'id'       => 'single_display_author_bio',
                            'type'     => 'switch',
                            'title'    => __( 'Display Author info', 'samathemes' ),
							'desc'    => __( 'Display author info and image at bottom of post', 'samathemes' ),
                            'default'  => true,
							'on'	   => 'Yes',
							'off'	   => 'No',
                        ),
						array(
                            'id'   => 'sama-divide-1',
                            'type' => 'divide'
                        ),
						array(
                            'id'       => 'single_display_share_icon',
                            'type'     => 'switch',
                            'title'    => __( 'Display Share icon', 'samathemes' ),
							'desc'    => __( 'Display Share icon in post', 'samathemes' ),
                            'default'  => true,
							'on'	   => 'Yes',
							'off'	   => 'No',
                        ),
						array(
                            'id'       => 'single_share_facebook',
                            'type'     => 'switch',
							'title'    => __( 'Display Facebook', 'samathemes' ),
                            'desc'    => __( 'Display Facebook Share icon in post', 'samathemes' ),
                            'default'  => true,
							'on'	   => 'Yes',
							'off'	   => 'No',
							'required' => array('single_display_share_icon','equals', true)
                        ),
						array(
                            'id'       => 'single_share_twitter',
                            'type'     => 'switch',
							'title'    => __( 'Display Twitter', 'samathemes' ),
                            'desc'    => __( 'Display Twitter Share icon in post', 'samathemes' ),
                            'default'  => true,
							'on'	   => 'Yes',
							'off'	   => 'No',
							'required' => array('single_display_share_icon','equals', true)
                        ),
						array(
                            'id'       => 'single_share_pinterest',
                            'type'     => 'switch',
							'title'    => __( 'Display Pinterest', 'samathemes' ),
                            'desc'    => __( 'Display Pinterest Share icon in post', 'samathemes' ),
                            'default'  => true,
							'on'	   => 'Yes',
							'off'	   => 'No',
							'required' => array('single_display_share_icon','equals', true)
                        ),
						array(
                            'id'       => 'single_share_gplus',
                            'type'     => 'switch',
							'title'    => __( 'Display Google Plus', 'samathemes' ),
                            'desc'    => __( 'Display Google Plus Share icon in post', 'samathemes' ),
                            'default'  => true,
							'on'	   => 'Yes',
							'off'	   => 'No',
							'required' => array('single_display_share_icon','equals', true)
                        ),
						array(
                            'id'       => 'single_share_linkedin',
                            'type'     => 'switch',
							'title'    => __( 'Display Linkedin', 'samathemes' ),
                            'desc'    => __( 'Display Linkedin Share icon in post', 'samathemes' ),
                            'default'  => true,
							'on'	   => 'Yes',
							'off'	   => 'No',
							'required' => array('single_display_share_icon','equals', true)
                        ),
						array(
                            'id'   => 'sama-divide-1',
                            'type' => 'divide'
                        ),
						array(
                            'id'       => 'single_standard_at_top',
                            'type'     => 'button_set',
                            'title'    => __( 'Top post format standard display', 'samathemes' ),
							'desc' => __( 'For post format standard choose what you need to diplsay at top.', 'samathemes' ),
                            'options'  => array(
                                'thumb' 	=> __('Thumbnail', 'samathemes'),
                                'no' 		=> __('Nothing ', 'samathemes')
                            ),
                            'default'  => 'thumb'
                        ),
						array(
                            'id'       => 'single_aside_at_top',
                            'type'     => 'button_set',
                            'title'    => __( 'Top post format aside display', 'samathemes' ),
							'desc' => __( 'For post format aside choose what you need to diplsay at top.', 'samathemes' ),
                            'options'  => array(
                                'thumb' 	=> __('Thumbnail', 'samathemes'),
                                'no' 		=> __('Nothing ', 'samathemes')
                            ),
                            'default'  => 'thumb'
                        ),
						array(
                            'id'       => 'single_image_at_top',
                            'type'     => 'button_set',
                            'title'    => __( 'Top post format image display', 'samathemes' ),
							'desc' => __( 'For post format image choose what you need to diplsay at top.', 'samathemes' ),
                            'options'  => array(
                                'thumb' 	=> __('Thumbnail', 'samathemes'),
                                'no' 		=> __('Nothing ', 'samathemes')
                            ),
                            'default'  => 'thumb'
                        ),
						array(
                            'id'       => 'single_link_at_top',
                            'type'     => 'button_set',
                            'title'    => __( 'Top post format link display', 'samathemes' ),
							'desc' => __( 'For post format link choose what you need to diplsay at top.', 'samathemes' ),
                            'options'  => array(
                                'thumb' 	=> __('Thumbnail', 'samathemes'),
                                'no' 		=> __('Nothing ', 'samathemes')
                            ),
                            'default'  => 'thumb'
                        ),
						array(
                            'id'       => 'single_video_at_top',
                            'type'     => 'button_set',
                            'title'    => __( 'Top post format video display', 'samathemes' ),
							'desc' => __( 'For post format video choose what you need to diplsay at top.', 'samathemes' ),
                            'options'  => array(
                                'thumb' 	=> __('Thumbnail', 'samathemes'),
								'video' 	=> __('Video', 'samathemes'),
                                'no' 		=> __('Nothing ', 'samathemes')
                            ),
                            'default'  => 'video'
                        ),
						array(
                            'id'       => 'single_audio_at_top',
                            'type'     => 'button_set',
                            'title'    => __( 'Top post format audio display', 'samathemes' ),
							'desc' => __( 'For post format audio choose what you need to diplsay at top.', 'samathemes' ),
                            'options'  => array(
                                'thumb' 	=> __('Thumbnail', 'samathemes'),
								'audio' 	=> __('Audio', 'samathemes'),
                                'no' 		=> __('Nothing ', 'samathemes')
                            ),
                            'default'  => 'audio'
                        ),
						array(
                            'id'       => 'single_gallery_at_top',
                            'type'     => 'button_set',
                            'title'    => __( 'Top post format gallery display', 'samathemes' ),
							'desc' => __( 'For post format gallery choose what you need to diplsay at top.', 'samathemes' ),
                            'options'  => array(
                                'thumb' 	=> __('Thumbnail', 'samathemes'),
								'gallery' 	=> __('Gallery', 'samathemes'),
                                'no' 		=> __('Nothing ', 'samathemes')
                            ),
                            'default'  => 'gallery'
                        ),
                    )
                );
				
				$this->sections[] = array(
                    'icon'   => 'el-icon-fire',
                    'title'  => __( 'Portfolio', 'samathemes' ),
					'desc'	 => __('This fields used for portfolio', 'samathemes'),
                    'fields' => array(
						array(
                            'id'       => 'portfolio_type',
                            'type'     => 'select',
                            'title'    => __( 'Portfolio Type', 'samathemes' ),
                            'options'  => array(
                                'portfolio_fullwidth_without_text' 			=> __('Portfolio Fullwidth Without Text', 'samathemes'),
                                'portfolio_fullwidth_with_text' 			=> __('Portfolio Fullwidth With Text', 'samathemes'),
								'portfolio_gird_two_column_withtext' 		=> __('Portfolio Gird Two Column With Text', 'samathemes'),
								'portfolio_gird_two_column_withouttext' 	=> __('Portfolio Gird Two Column Without Text', 'samathemes'),
								'portfolio_gird_three_column_withtext' 		=> __('Portfolio Gird Three Column With Text', 'samathemes'),
								'portfolio_gird_three_column_withouttext' 	=> __('Portfolio Gird Three Column Without Text', 'samathemes'),
								'portfolio_gird_four_column_withtext' 		=> __('Portfolio Gird Four Column With Text', 'samathemes'),
								'portfolio_gird_four_column_withouttext' 	=> __('Portfolio Gird Four Column Without Text', 'samathemes'),
                            ),
                            'default'  => 'portfolio_fullwidth_without_text'
                        ),
						array(
                            'id'       => 'portfolio_sub_title',
                            'type'     => 'text',
                            'title'    => __( 'Portfolio Sub title', 'samathemes' ),
                            'desc' => __( 'This subtitle display in all portfolio page except portfolio single', 'samathemes' ),
                            'default'  => 'Dream Large, Create Brilliance, Inspire the Market',
                        ),
						array(
                            'id'   => 'sama-divide-1',
                            'type' => 'divide'
                        ),
						array(
                            'id'       => 'portfolio_display_share_icon',
                            'type'     => 'switch',
                            'title'    => __( 'Display Share icon', 'samathemes' ),
							'desc'    => __( 'Display Share icon in post', 'samathemes' ),
                            'default'  => true,
							'on'	   => 'Yes',
							'off'	   => 'No',
                        ),
						array(
                            'id'       => 'portfolio_display_facebook',
                            'type'     => 'switch',
							'title'    => __( 'Display Facebook', 'samathemes' ),
                            'desc'    => __( 'Display Facebook Share icon in post', 'samathemes' ),
                            'default'  => true,
							'on'	   => 'Yes',
							'off'	   => 'No',
							'required' => array('portfolio_display_share_icon','equals', true)
                        ),
						array(
                            'id'       => 'portfolio_display_twitter',
                            'type'     => 'switch',
							'title'    => __( 'Display Twitter', 'samathemes' ),
                            'desc'    => __( 'Display Twitter Share icon in post', 'samathemes' ),
                            'default'  => true,
							'on'	   => 'Yes',
							'off'	   => 'No',
							'required' => array('portfolio_display_share_icon','equals', true)
                        ),
						array(
                            'id'       => 'portfolio_display_pin',
                            'type'     => 'switch',
							'title'    => __( 'Display Pinterest', 'samathemes' ),
                            'desc'    => __( 'Display Pinterest Share icon in post', 'samathemes' ),
                            'default'  => true,
							'on'	   => 'Yes',
							'off'	   => 'No',
							'required' => array('portfolio_display_share_icon','equals', true)
                        ),
						array(
                            'id'       => 'portfolio_display_gplus',
                            'type'     => 'switch',
							'title'    => __( 'Display Google Plus', 'samathemes' ),
                            'desc'    => __( 'Display Google Plus Share icon in post', 'samathemes' ),
                            'default'  => true,
							'on'	   => 'Yes',
							'off'	   => 'No',
							'required' => array('portfolio_display_share_icon','equals', true)
                        ),
						array(
                            'id'       => 'portfolio_display_linkedin',
                            'type'     => 'switch',
							'title'    => __( 'Display Linkedin', 'samathemes' ),
                            'desc'    => __( 'Display Linkedin Share icon in post', 'samathemes' ),
                            'default'  => true,
							'on'	   => 'Yes',
							'off'	   => 'No',
							'required' => array('portfolio_display_share_icon','equals', true)
                        ),
						array(
                            'id'       => 'single_portfolio_after_recent',
                            'type'     => 'textarea',
                            'title'    => __( 'Add Content in Single Portfolio', 'samathemes' ),
                            'desc'     => __( 'Add shortcode or html tags to display after recent work in single portfolio page.', 'samathemes' ),
                            'validate' => 'html',
                        ),
						
                    )
                );
				
				$this->sections[] = array(
                    'icon'   => 'el-icon-paper-clip',
                    'title'  => __( 'Footer', 'samathemes' ),
                    'fields' => array(
						array(
                            'id'       => 'display_top_bottom_footer',
                            'type'     => 'switch',
							'title'    => __( 'Top and Bottom Footer', 'samathemes' ),
                            'desc'    => __( 'Display footer widget and bottom footer', 'samathemes' ),
                            'default'  => true,
							'on'	   => 'Enabled',
							'off'	   => 'Disabled',
							//'required' => array('portfolio_display_share_icon','equals', true)
                        ),
						array(
                            'id'       => 'display_widegt_footer',
                            'type'     => 'switch',
							'title'    => __( 'Top Footer', 'samathemes' ),
                            'desc'    => __( 'Display footer widget', 'samathemes' ),
                            'default'  => true,
							'on'	   => 'Enabled',
							'off'	   => 'Disabled',
							'required' => array('display_top_bottom_footer','equals', true)
                        ),
						array(
                            'id'       => 'footer_widegt_type',
                            'type'     => 'select',
                            'title'    => __( 'Footer Widget Type', 'samathemes' ),
                            'options'  => array(
                                '3columns' 			=> __('3 Columns', 'samathemes'),
                                '4columns' 			=> __('4 Columns', 'samathemes'),
								'3columnsbigleft' 	=> __('3 Columns and the left column is big', 'samathemes'),
                            ),
                            'default'  => '3columns',
							'required' => array('display_widegt_footer','equals', true)
                        ),
						array(
                            'id'       => 'display_bottom_footer',
                            'type'     => 'switch',
							'title'    => __( 'Display Bottom Footer', 'samathemes' ),
                            'desc'    => __( 'Display bottom footer content', 'samathemes' ),
                            'default'  => true,
							'on'	   => 'Enabled',
							'off'	   => 'Disabled',
							'required' => array('display_top_bottom_footer','equals', true)
                        ),
						array(
                            'id'       => 'footer_bottom_bg',
                            'type'     => 'select',
                            'title'    => __( 'Select Bottom Footer Color', 'samathemes' ),
							'desc'    => __( 'if you select theme color this depend on light or dark version you used.', 'samathemes' ),
                            'options'  => array(
                                'bottom-footer' 				=> __('Dark', 'samathemes'),
                                'footer-one-page theme-color' 	=> __('Theme color', 'samathemes'),
                            ),
                            'default'  => 'bottom-footer',
							'required' => array('display_widegt_footer','equals', true)
                        ),
						array(
                            'id'       => 'footer_bottom_pad',
                            'type'     => 'select',
                            'title'    => __( 'Footer Bottom Padding', 'samathemes' ),
							'desc'    => __( 'Small padding good for dark background and extra padding good for theme color background.', 'samathemes' ),
                            'options'  => array(
                                'pad-top-bottom-20' => __('padding 20px', 'samathemes'),
                                'pad-top-bottom-40' => __('padding 40px', 'samathemes'),
                            ),
                            'default'  => 'pad-top-bottom-20',
							'required' => array('display_widegt_footer','equals', true)
                        ),
						
						array(
                            'id'       => 'bt_footer_content',
                            'type'     => 'textarea',
                            'title'    => __( 'Copy right content', 'samathemes' ),
                            'validate' => 'html',
							'required' => array('display_bottom_footer','equals', true)
                        ),
						array(
                            'id'       => 'remove_top_bottom_footer',
                            'type'     => 'select',
                            'data'     => 'pages',
                            'multi'    => true,
                            'title'    => __( 'Hide top and bottom footer', 'samathemes' ),
                            'desc'     => __( 'Select pages to hide top and bottom footer.', 'samathemes' ),
                        ),
						array(
                            'id'       => 'remove_top_footer',
                            'type'     => 'select',
                            'data'     => 'pages',
                            'multi'    => true,
                            'title'    => __( 'Hide top footer', 'samathemes' ),
                            'desc'     => __( 'Select pages to hide top footer that have widgets.', 'samathemes' ),
                        ),
						array(
                            'id'       => 'remove_bottom_footer',
                            'type'     => 'select',
                            'data'     => 'pages',
                            'multi'    => true,
                            'title'    => __( 'hide bottom footer', 'samathemes' ),
                            'desc'     => __( 'Select pages to hide bottom footer.', 'samathemes' ),
                        ),
                    )
                );
				
				$this->sections[] = array(
                    'icon'   => 'el-icon-globe',
					'subsection' => true,
                    'title'  => __( 'Social icons', 'samathemes' ),
                    'fields' => array(
						array(
                            'id'       => 'footer_share_icon',
                            'type'     => 'switch',
                            'title'    => __( 'Display Share icon', 'samathemes' ),
                            'default'  => true,
							'on'	   => 'Yes',
							'off'	   => 'No',
                        ),
						array(
                            'id'       => 'facebook',
                            'type'     => 'text',
							'title'    => __( 'Facebook URL', 'samathemes' ),
							'validate' => 'url',
							'required' => array('footer_share_icon','equals', true)
                        ),
						array(
                            'id'       => 'twitter',
                            'type'     => 'text',
							'title'    => __( 'Twitter URL', 'samathemes' ),
                            'validate' => 'url',
							'required' => array('footer_share_icon','equals', true)
                        ),
						array(
                            'id'       => 'dribbble',
                            'type'     => 'text',
							'title'    => __( 'Dribbble URL', 'samathemes' ),
							'validate' => 'url',
							'required' => array('footer_share_icon','equals', true)
                        ),
						array(
                            'id'       => 'linkedin',
                            'type'     => 'text',
							'title'    => __( 'Linkedin URL', 'samathemes' ),
							'validate' => 'url',
							'required' => array('footer_share_icon','equals', true)
                        ),
						array(
                            'id'       => 'gplus',
                            'type'     => 'text',
							'title'    => __( 'Google Plus URL', 'samathemes' ),
							'validate' => 'url',
							'required' => array('footer_share_icon','equals', true)
                        ),
						array(
                            'id'       => 'youtube',
                            'type'     => 'text',
							'title'    => __( 'Youtube URL', 'samathemes' ),
							'validate' => 'url',
							'required' => array('footer_share_icon','equals', true)
                        ),
						array(
                            'id'       => 'rss',
                            'type'     => 'text',
							'title'    => __( 'RSS URL', 'samathemes' ),
							'validate' => 'url',
							'required' => array('footer_share_icon','equals', true)
                        ),
                    )
                );
				$this->sections[] = array(
                    'icon'   => 'el-icon-globe',
					'subsection' => true,
                    'title'  => __( 'Footer Code', 'samathemes' ),
                    'fields' => array(
						array(
                            'id'       => 'analyticscode',
                            'type'     => 'textarea',
                            'title'    => __( 'Analytics Code', 'samathemes' ),
                            'desc'     => __( 'like Google Analytics Code.', 'samathemes' ),
                            'validate' => 'js'
                        ),
                    )
                );
				
				$this->sections[] = array(
                    'icon'   => 'el-icon-brush',
                    'title'  => __( 'Style Options', 'samathemes' ),
                    'fields' => array(
						array(
                            'id'       => 'themestyle',
                            'type'     => 'select',
                            'title'    => __( 'Theme style', 'samathemes' ),
                            'options'  => array(
                                'light' 	=> __('Light', 'samathemes'),
                                'dark' 		=> __('dark', 'samathemes'),
                            ),
                            'default'  => 'light',
                        ),
						array(
                            'id'       => 'themecolor',
                            'type'     => 'image_select',
                            'compiler' => true,
                            'title'    => __( 'Theme Color', 'samathemes' ),
                            'options'  => array(
                                'alizarin' => array(
                                    'alt' => 'alizarin',
                                    'img' => get_template_directory_uri() . '/img/options/alizarin.jpg'
                                ),
                                'pomegranate' => array(
                                    'alt' => 'pomegranate',
                                    'img' => get_template_directory_uri() . '/img/options/pomegranate.jpg'
                                ),
                                'turqioise' => array(
                                    'alt' => 'turqioise',
                                    'img' => get_template_directory_uri() . '/img/options/turqioise.jpg'
                                ),
                                'green_sea' => array(
                                    'alt' => 'green sea',
                                    'img' => get_template_directory_uri() . '/img/options/green_sea.jpg'
                                ),
                                'emerald' => array(
                                    'alt' => 'emerald',
                                    'img' => get_template_directory_uri() . '/img/options/emerald.jpg'
                                ),
                                'nephritis' => array(
                                    'alt' => 'nephritis',
                                    'img' => get_template_directory_uri() . '/img/options/nephritis.jpg'
                                ),
								'peter_river' => array(
                                    'alt' => 'peter river',
                                    'img' => get_template_directory_uri() . '/img/options/peter_river.jpg'
                                ),
                                'belize_hole' => array(
                                    'alt' => 'belize hole',
                                    'img' => get_template_directory_uri() . '/img/options/belize_hole.jpg'
                                ),
                                'amethyst' => array(
                                    'alt' => 'amethyst',
                                    'img' => get_template_directory_uri() . '/img/options/amethyst.jpg'
                                ),
                                'wisteria' => array(
                                    'alt' => 'wisteria',
                                    'img' => get_template_directory_uri() . '/img/options/wisteria.jpg'
                                ),
                                'wet_asphalt' => array(
                                    'alt' => 'wet asphalt',
                                    'img' => get_template_directory_uri() . '/img/options/wet_asphalt.jpg'
                                ),
                                'midnight_blue' => array(
                                    'alt' => 'midnight blue',
                                    'img' => get_template_directory_uri() . '/img/options/midnight_blue.jpg'
                                ),
								'sun_flower' => array(
                                    'alt' => 'sun flower',
                                    'img' => get_template_directory_uri() . '/img/options/sun_flower.jpg'
                                ),
                                'orange' => array(
                                    'alt' => 'orange',
                                    'img' => get_template_directory_uri() . '/img/options/orange.jpg'
                                ),
                                'carrot' => array(
                                    'alt' => 'carrot',
                                    'img' => get_template_directory_uri() . '/img/options/carrot.jpg'
                                ),
                                'pumpkin' => array(
                                    'alt' => 'pumpkin',
                                    'img' => get_template_directory_uri() . '/img/options/pumpkin.jpg'
                                ),
                                'brown' => array(
                                    'alt' => 'brown',
                                    'img' => get_template_directory_uri() . '/img/options/brown.jpg'
                                ),
                                'concrete' => array(
                                    'alt' => 'concrete',
                                    'img' => get_template_directory_uri() . '/img/options/concrete.jpg'
                                ),
								
								'asbestos' => array(
                                    'alt' => 'asbestos',
                                    'img' => get_template_directory_uri() . '/img/options/asbestos.jpg'
                                ),
                                'silver' => array(
                                    'alt' => 'silver',
                                    'img' => get_template_directory_uri() . '/img/options/silver.jpg'
                                ),
                            ),
                            'default'  => 'alizarin'
                        ),
						array(
                            'id'       => 'enable_custom_color',
                            'type'     => 'switch',
                            'title'    => __( 'Custom color', 'samathemes' ),
                            'default'  => false,
							'on'	   => 'Enabled',
							'off'	   => 'Disabled',
                        ),
						array(
                            'id'     => 'custom-color-info',
                            'type'   => 'info',
                            'notice' => true,
                            'style'  => 'info',
                            'title'  => __( 'About Custom CSS Color.', 'samathemes' ),
                            'desc'   => __( 'Rozana wordpress theme provide you simple way to change color used for main elments in this theme using small fields ( Color, Border color, background).', 'samathemes' ),
							'required' => array('enable_custom_color','equals',true)
                        ),
						array(
                            'id'     => 'custom-color-success',
                            'type'   => 'info',
                            'notice' => true,
                            'style'  => 'success',
                            //'icon'   => 'el-icon-info-sign',
                            'title'  => __( 'Demo Theme Changer.', 'samathemes' ),
                            'desc'   => __( 'Defalut color for this theme elments ( color - border color , background ) have same color value like: #f54325 feel free if you assign individual value for this elments.', 'samathemes' ),
							'required' => array('enable_custom_color','equals',true),
                        ),
						array(
                            'id'     => 'custom-color-critical',
                            'type'   => 'info',
                            'notice' => true,
                            'style'  => 'critical',
                            //'icon'   => 'el-icon-info-sign',
                            'title'  => __( 'Chnange Color For Specific HTML Elment.', 'samathemes' ),
                            'desc'   => __( 'Add your css code to custom CSS section.', 'samathemes' ),
							'required' => array('enable_custom_color','equals',true),
                        ),
						array(
                            'id'       		=> 'rozana-color',
                            'type'     		=> 'color',
                            'title'    		=> __( 'Theme Color', 'samathemes' ),
                            'default'  		=> '#f54325',
                            'validate' 		=> 'color',
							'transparent'	=> false,
							'required' => array('enable_custom_color','equals',true),
                        ),
						array(
                            'id'       => 'rozana-background',
                            'type'     => 'color',
                            'output'   => array( '.site-title' ),
                            'title'    => __( 'Theme Color', 'samathemes' ),
                            'default'  => '#f54325',
                            'validate' => 'color',
							'transparent'	=> false,
							'required' => array('enable_custom_color','equals',true),
                        ),
						array(
                            'id'       => 'rozana-bordercolor',
                            'type'     => 'color',
                            'title'    => __( 'Theme Border Color', 'samathemes' ),
                            'default'  => '#f54325',
                            'validate' => 'color',
							'transparent'	=> false,
							'required' => array('enable_custom_color','equals',true),
                        ),
                    )
                );
				
				$this->sections[] = array(
                    'icon'   => 'el-icon-font',
					'subsection' => true,
                    'title'  => __( 'Fonts', 'samathemes' ),
                    'fields' => array(
						array(
                            'id'     => 'custom-font-info',
                            'type'   => 'info',
                            'notice' => true,
                            'style'  => 'info',
                            'title'  => __( 'Google Fonts used in Theme', 'samathemes' ),
                            'desc'   => __( 'Rozana themes used 3 fonts Open Sans, Oswald, Open Sans Condensed so you can easy replace any font used in theme with another font.', 'samathemes' ),
                        ),
						array(
                            'id'     => 'custom-font-info-weight',
                            'type'   => 'info',
                            'notice' => true,
                            'style'  => 'info',
                            'title'  => __( 'Font Weight', 'samathemes' ),
                            'desc'   => __( 'Open Sans: 300italic,400italic,600italic,700italic,400,300,600,700<br/> Oswald:400,700,300<br/> Open Sans Condensed: 300,700,300italic.', 'samathemes' ),
                        ),
						array(
                            'id'     => 'custom-font-success',
                            'type'   => 'info',
                            'notice' => true,
                            'style'  => 'critical',
                            //'icon'   => 'el-icon-info-sign',
                            'title'  => __( 'Add new google fonts.', 'samathemes' ),
                            'desc'   => __( 'EX: theme use open sans font with different weight like 300italic,400italic,600italic,700italic,400,300,600,700 <br /> So when you choose to replace this font with anothere you need to add more weight but theme options have one dropdown menu to select only one weight so there is another field called Add additional style so you can add more weight.', 'samathemes' ),
                        ),
						array(
                            'id'     => 'custom-font-weight',
                            'type'   => 'info',
                            'notice' => true,
                            'style'  => 'success',
                            'title'  => __( 'Why i need to add font weight.', 'samathemes' ),
                            'desc'   => __( 'Theme appearance be good.', 'samathemes' ),
                        ),
						array(
                            'id'     => 'custom-font-weight-lineheight',
                            'type'   => 'info',
                            'notice' => true,
                            'style'  => 'critical',
                            'title'  => __( 'Font weight and line height.', 'samathemes' ),
                            'desc'   => __( 'This fields for preview only.', 'samathemes' ),
                        ),
						array(
                            'id'       => 'enable_custom_fonts',
                            'type'     => 'switch',
                            'title'    => __( 'Custom Fonts', 'samathemes' ),
                            'default'  => false,
							'on'	   => 'Enabled',
							'off'	   => 'Disabled',
                        ),
						array(
                            'id'       => 'enable-font-opensans',
                            'type'     => 'switch',
                            'title'    => __( 'Font 1', 'samathemes' ),
							'subtitle'    => __( 'By default Open Sans', 'samathemes' ),
							'desc'    => __('usingt for body and h5 and some html elments.', 'samathemes'),
                            'default'  => false,
							'on'	   => 'Enabled',
							'off'	   => 'Disabled',
							'required' => array('enable_custom_fonts','equals',true),
                        ),
						array(
							'id'          => 'font-opensans',
							'type'        => 'typography', 
							'title'       => __('Font 1', 'samathemes'),
							'google'      => true, 
							'font-backup' => true,
							'color'         => false,
							'font-style'    => true,
							'subsets'       => true,
							'font-size'     => true, // for preview only
							'line-height'   => true, // for preview only
							'preview'       => true,
							'text-align'	=> false,				
							'units'       =>'px',
                            'all_styles'  => true,
							'default'     => array(
                                'font-style'  => '700',
                                'font-family' => 'Open Sans',
                                'google'      => true,
                                'font-size'   => '33px',
                                'line-height' => '40px',
								'font-backup'	=> true,
                            ),
							'required' => array('enable-font-opensans','equals',true),
						),
						array(
                            'id'       => 'font-opensans-style',
                            'type'     => 'text',
							'title'    => __( 'Font 1 Add additional style', 'samathemes' ),
							'desc'	   => __( '[Optional] EX: 700,900,400italic,700italic,900italic', 'samathemes' ),
							'required' => array('enable-font-opensans','equals',true),
                        ),
						array(
                            'id'       => 'font-opensans-subsets',
                            'type'     => 'text',
							'title'    => __( 'Font 1 Add additional Font Subsets', 'samathemes' ),
							'desc'	   => __( '[Optional] EX: latin,greek-ext,greek', 'samathemes' ),
							'required' => array('enable-font-opensans','equals',true),
                        ),
						
						array(
                            'id'       => 'enable-font-oswald',
                            'type'     => 'switch',
                            'title'    => __( 'Font 2', 'samathemes' ),
							'subtitle'    => __( 'By default Oswald', 'samathemes' ),
							'desc'    => __('using for heading h1, h2, and some html elments.', 'samathemes'),
                            'default'  => false,
							'on'	   => 'Enabled',
							'off'	   => 'Disabled',
							'required' => array('enable_custom_fonts','equals',true),
                        ),
						array(
							'id'          => 'font-oswald',
							'type'        => 'typography', 
							'title'       => __('Typography', 'samathemes'),
							'google'      => true, 
							'font-backup' => true,
							'color'         => false,
							'font-style'    => true,
							'subsets'       => true,
							'font-size'     => true, // for preview only
							'line-height'   => true, // for preview only
							'preview'       => true,
							'text-align'	=> false,				
							'units'       =>'px',
                            'all_styles'  => true,
							'default'     => array(
                                'font-style'  => '700',
                                'font-family' => 'Oswald',
                                'google'      => true,
                                'font-size'   => '33px',
                                'line-height' => '40px',
								'font-backup'	=> true,
                            ),
							'required' => array('enable-font-oswald','equals',true),
						),
						array(
                            'id'       => 'font-oswald-style',
                            'type'     => 'text',
							'title'    => __( 'Font 2 Add additional style', 'samathemes' ),
							'desc'	   => __( '[Optional] EX: 700,900,400italic,700italic,900italic', 'samathemes' ),
							'required' => array('enable-font-oswald','equals',true),
                        ),
						array(
                            'id'       => 'font-oswald-subsets',
                            'type'     => 'text',
							'title'    => __( 'Font 2 Add additional Font Subsets', 'samathemes' ),
							'desc'	   => __( '[Optional] EX: latin,greek-ext,greek', 'samathemes' ),
							'required' => array('enable-font-oswald','equals',true),
                        ),
						
						array(
                            'id'       => 'enable-font-opensans-condensed',
                            'type'     => 'switch',
                            'title'    => __( 'Font 3', 'samathemes' ),
							'subtitle'    => __( 'By default Open Sans Condensed', 'samathemes' ),
							'desc'    => __('using for widget title and some html elments.', 'samathemes'),
                            'default'  => false,
							'on'	   => 'Enabled',
							'off'	   => 'Disabled',
							'required' => array('enable_custom_fonts','equals',true),
                        ),
						array(
							'id'          => 'font-opensans-condensed',
							'type'        => 'typography', 
							'title'       => __('Typography', 'samathemes'),
							'google'      => true, 
							'font-backup' => true,
							'color'         => false,
							'font-style'    => true,
							'subsets'       => true,
							'font-size'     => true, // for preview only
							'line-height'   => true, // for preview only
							'preview'       => true,
							'text-align'	=> false,				
							'units'       =>'px',
                            'all_styles'  => true,
							'desc'    => __('By default rozana theme using open sans font for body and h5 and some html elments.', 'samathemes'),
							'default'     => array(
                                'font-style'  => '700',
                                'font-family' => 'Open Sans Condensed',
                                'google'      => true,
                                'font-size'   => '33px',
                                'line-height' => '40px',
								'font-backup'	=> true,
                            ),
							'required' => array('enable-font-opensans-condensed','equals',true),
						),
						array(
                            'id'       => 'font-opensans-condensed-style',
                            'type'     => 'text',
							'title'    => __( 'Font 3 Add additional style', 'samathemes' ),
							'desc'	   => __( '[Optional] EX: 700,900,400italic,700italic,900italic', 'samathemes' ),
							'required' => array('enable-font-opensans-condensed','equals',true),
                        ),
						array(
                            'id'       => 'font-opensans-condensed-subsets',
                            'type'     => 'text',
							'title'    => __( 'Font 3 Add additional Font Subsets', 'samathemes' ),
							'desc'	   => __( '[Optional] EX: latin,greek-ext,greek', 'samathemes' ),
							'required' => array('enable-font-opensans-condensed','equals',true),
                        ),
                    )
                );
				
				$this->sections[] = array(
                    'icon'   => 'el-icon-fontsize',
					'subsection' => true,
                    'title'  => __( 'Typography', 'samathemes' ),
                    'fields' => array(
						array(
                            'id'       => 'enable_typography',
                            'type'     => 'switch',
                            'title'    => __( 'Font Size', 'samathemes' ),
                            'default'  => false,
							'on'	   => 'Enabled',
							'off'	   => 'Disabled',
                        ),
						array(
                            'id'            => 'body_font_size',
                            'type'          => 'slider',
                            'title'         => __( 'Body Font Size', 'samathemes' ),
                            'default'       => 13,
                            'min'           => 8,
                            'step'          => 1,
                            'max'           => 60,
                            'display_value' => 'label',
							'required' => array('enable_typography','equals',true),
                        ),
						array(
                            'id'            => 'body_line_height',
                            'type'          => 'slider',
                            'title'         => __( 'Body Line Height', 'samathemes' ),
                            'default'       => 24,
                            'min'           => 8,
                            'step'          => 1,
                            'max'           => 80,
                            'display_value' => 'label',
							'required' => array('enable_typography','equals',true),
                        ),
						array(
                            'id'            => 'h_1_size',
                            'type'          => 'slider',
                            'title'         => __( 'Header H1 Font Size', 'samathemes' ),
                            'default'       => 38,
                            'min'           => 8,
                            'step'          => 1,
                            'max'           => 80,
                            'display_value' => 'label',
							'required' => array('enable_typography','equals',true),
                        ),
						array(
                            'id'            => 'h_1_lineheight',
                            'type'          => 'slider',
                            'title'         => __( 'Header H1', 'samathemes' ),
                            'default'       => 24,
                            'min'           => 8,
                            'step'          => 1,
                            'max'           => 80,
                            'display_value' => 'label',
							'required' => array('enable_typography','equals',true),
                        ),
						array(
                            'id'            => 'h_2_size',
                            'type'          => 'slider',
                            'title'         => __( 'Header H2 Font Size', 'samathemes' ),
                            'default'       => 31,
                            'min'           => 8,
                            'step'          => 1,
                            'max'           => 80,
                            'display_value' => 'label',
							'required' => array('enable_typography','equals',true),
                        ),
						array(
                            'id'            => 'h_2_lineheight',
                            'type'          => 'slider',
                            'title'         => __( 'Header H2', 'samathemes' ),
                            'default'       => 24,
                            'min'           => 8,
                            'step'          => 1,
                            'max'           => 80,
                            'display_value' => 'label',
							'required' => array('enable_typography','equals',true),
                        ),
						array(
                            'id'            => 'h_3_size',
                            'type'          => 'slider',
                            'title'         => __( 'Header H3 Font Size', 'samathemes' ),
                            'default'       => 24,
                            'min'           => 8,
                            'step'          => 1,
                            'max'           => 80,
                            'display_value' => 'label',
							'required' => array('enable_typography','equals',true),
                        ),
						array(
                            'id'            => 'h_3_lineheight',
                            'type'          => 'slider',
                            'title'         => __( 'Header H3', 'samathemes' ),
                            'default'       => 24,
                            'min'           => 8,
                            'step'          => 1,
                            'max'           => 80,
                            'display_value' => 'label',
							'required' => array('enable_typography','equals',true),
                        ),
						array(
                            'id'            => 'h_4_size',
                            'type'          => 'slider',
                            'title'         => __( 'Header H4 Font Size', 'samathemes' ),
                            'default'       => 18,
                            'min'           => 8,
                            'step'          => 1,
                            'max'           => 80,
                            'display_value' => 'label',
							'required' => array('enable_typography','equals',true),
                        ),
						array(
                            'id'            => 'h_4_lineheight',
                            'type'          => 'slider',
                            'title'         => __( 'Header H4', 'samathemes' ),
                            'default'       => 24,
                            'min'           => 8,
                            'step'          => 1,
                            'max'           => 80,
                            'display_value' => 'label',
							'required' => array('enable_typography','equals',true),
                        ),
						array(
                            'id'            => 'h_5_size',
                            'type'          => 'slider',
                            'title'         => __( 'Header H5 Font Size', 'samathemes' ),
                            'default'       => 14,
                            'min'           => 8,
                            'step'          => 1,
                            'max'           => 80,
                            'display_value' => 'label',
							'required' => array('enable_typography','equals',true),
                        ),
						array(
                            'id'            => 'h_5_lineheight',
                            'type'          => 'slider',
                            'title'         => __( 'Header H5', 'samathemes' ),
                            'default'       => 24,
                            'min'           => 8,
                            'step'          => 1,
                            'max'           => 80,
                            'display_value' => 'label',
							'required' => array('enable_typography','equals',true),
                        ),
						array(
                            'id'            => 'h_6_size',
                            'type'          => 'slider',
                            'title'         => __( 'Header H6 Font Size', 'samathemes' ),
                            'default'       => 12,
                            'min'           => 8,
                            'step'          => 1,
                            'max'           => 80,
                            'display_value' => 'label',
							'required' => array('enable_typography','equals',true),
                        ),
						array(
                            'id'            => 'h_6_lineheight',
                            'type'          => 'slider',
                            'title'         => __( 'Header H6', 'samathemes' ),
                            'default'       => 24,
                            'min'           => 8,
                            'step'          => 1,
                            'max'           => 80,
                            'display_value' => 'label',
							'required' => array('enable_typography','equals',true),
                        ),
						array(
                            'id'            => 'custom_header_font_size',
                            'type'          => 'slider',
                            'title'         => __( 'Custom Header Font Size', 'samathemes' ),
							'desc'         => __( 'Used in Visual Composer Custom Title', 'samathemes' ),
                            'default'       => 38,
                            'min'           => 8,
                            'step'          => 1,
                            'max'           => 80,
                            'display_value' => 'label',
							'required' => array('enable_typography','equals',true),
                        ),
						array(
                            'id'            => 'custom_header_linghtheight',
                            'type'          => 'slider',
                            'title'         => __( 'Custom Header Line Height', 'samathemes' ),
                            'default'       => 48,
                            'min'           => 8,
                            'step'          => 1,
                            'max'           => 80,
                            'display_value' => 'label',
							'required' => array('enable_typography','equals',true),
                        ),
						array(
                            'id'            => 'custom_header_fontweight',
                            'type'          => 'slider',
                            'title'         => __( 'Custom Header Font Weight', 'samathemes' ),
                            'default'       => 400,
                            'min'           => 300,
                            'step'          => 100,
                            'max'           => 900,
                            'display_value' => 'label',
							'required' => array('enable_typography','equals',true),
                        ),
                    )
                );
				
				
				$this->sections[] = array(
                    'icon'   => 'el-icon-css',
                    'title'  => __( 'Custom CSS', 'samathemes' ),
                    'fields' => array(
						array(
                            'id'       => 'custom_css',
                            'type'     => 'ace_editor',
                            'title'    => __( 'CSS Code', 'samathemes' ),
                            'subtitle' => __( 'Paste your CSS code here.', 'samathemes' ),
                            'mode'     => 'css',
                            'theme'    => 'monokai',
                        ),
                    )
                );
				
              

                $theme_info = '<div class="redux-framework-section-desc">';
                $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __( '<strong>Theme URL:</strong> ', 'samathemes' ) . '<a href="' . $this->theme->get( 'ThemeURI' ) . '" target="_blank">' . $this->theme->get( 'ThemeURI' ) . '</a></p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __( '<strong>Author:</strong> ', 'samathemes' ) . $this->theme->get( 'Author' ) . '</p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __( '<strong>Version:</strong> ', 'samathemes' ) . $this->theme->get( 'Version' ) . '</p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get( 'Description' ) . '</p>';
                $tabs = $this->theme->get( 'Tags' );
                if ( ! empty( $tabs ) ) {
                    $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __( '<strong>Tags:</strong> ', 'samathemes' ) . implode( ', ', $tabs ) . '</p>';
                }
                $theme_info .= '</div>';

                /*if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
                    $this->sections['theme_docs'] = array(
                        'icon'   => 'el-icon-list-alt',
                        'title'  => __( 'Documentation', 'samathemes' ),
                        'fields' => array(
                            array(
                                'id'       => '17',
                                'type'     => 'raw',
                                'markdown' => true,
                                'content'  => file_get_contents( dirname( __FILE__ ) . '/../README.md' )
                            ),
                        ),
                    );
                }*/

                $this->sections[] = array(
                    'title'  => __( 'Import / Export', 'samathemes' ),
                    'desc'   => __( 'Import and Export your Redux Framework settings from file, text or URL.', 'samathemes' ),
                    'icon'   => 'el-icon-refresh',
                    'fields' => array(
                        array(
                            'id'         => 'opt-import-export',
                            'type'       => 'import_export',
                            'title'      => 'Import Export',
                            'subtitle'   => 'Save and restore your Redux options',
                            'full_width' => false,
                        ),
                    ),
                );

                $this->sections[] = array(
                    'type' => 'divide',
                );

                $this->sections[] = array(
                    'icon'   => 'el-icon-info-sign',
                    'title'  => __( 'Theme Information', 'samathemes' ),
                    'desc'   => __( '<p class="description">This is the Description. Again HTML is allowed</p>', 'samathemes' ),
                    'fields' => array(
                        array(
                            'id'      => 'opt-raw-info',
                            'type'    => 'raw',
                            'content' => $item_info,
                        )
                    ),
                );

                if ( file_exists( trailingslashit( dirname( __FILE__ ) ) . 'README.html' ) ) {
                    $tabs['docs'] = array(
                        'icon'    => 'el-icon-book',
                        'title'   => __( 'Documentation', 'samathemes' ),
                        'content' => nl2br( file_get_contents( trailingslashit( dirname( __FILE__ ) ) . 'README.html' ) )
                    );
                }
            }

            public function setHelpTabs() {
            }

            /**
             * All the possible arguments for Redux.
             * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
             * */
            public function setArguments() {

                $theme = wp_get_theme(); // For use with some settings. Not necessary.

                $this->args = array(
                    // TYPICAL -> Change these values as you need/desire
                    'opt_name'             => 'rozana',
                    // This is where your data is stored in the database and also becomes your global variable name.
                    'display_name'         => $theme->get( 'Name' ),
                    // Name that appears at the top of your panel
                    'display_version'      => $theme->get( 'Version' ),
                    // Version that appears at the top of your panel
                    'menu_type'            => 'submenu',
                    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                    'allow_sub_menu'       => true,
                    // Show the sections below the admin menu item or not
                    'menu_title'           => __( 'Rozana Options', 'samathemes' ),
                    'page_title'           => __( 'Rozana Options', 'samathemes' ),
                    // You will need to generate a Google API key to use this feature.
                    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                    'google_api_key'       => '',
                    // Set it you want google fonts to update weekly. A google_api_key value is required.
                    'google_update_weekly' => false,
                    // Must be defined to add google fonts to the typography module
                    'async_typography'     => true,
                    // Use a asynchronous font on the front end or font string
                    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                    'admin_bar'            => true,
                    // Show the panel pages on the admin bar
                    'admin_bar_icon'     => 'dashicons-portfolio',
                    // Choose an icon for the admin bar menu
                    'admin_bar_priority' => 50,
                    // Choose an priority for the admin bar menu
                    'global_variable'      => '',
                    // Set a different name for your global variable other than the opt_name
                    'dev_mode'             => false,
                    // Show the time the page took to load, etc
                    'update_notice'        => false,
                    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                    'customizer'           => false,
                    // Enable basic customizer support
                    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                    // OPTIONAL -> Give you extra features
                    'page_priority'        => null,
                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                    'page_parent'          => 'themes.php',
                    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                    'page_permissions'     => 'manage_options',
                    // Permissions needed to access the options panel.
                    'menu_icon'            => '',
                    // Specify a custom URL to an icon
                    'last_tab'             => '',
                    // Force your panel to always open to a specific tab (by id)
                    'page_icon'            => 'icon-themes',
                    // Icon displayed in the admin panel next to your menu_title
                    'page_slug'            => '_options',
                    // Page slug used to denote the panel
                    'save_defaults'        => true,
                    // On load save the defaults to DB before user clicks save or not
                    'default_show'         => false,
                    // If true, shows the default value next to each field that is not the default value.
                    'default_mark'         => '',
                    // What to print by the field's title if the value shown is default. Suggested: *
                    'show_import_export'   => true,
                    // Shows the Import/Export panel when not used as a field.

                    // CAREFUL -> These options are for advanced use only
                    'transient_time'       => 60 * MINUTE_IN_SECONDS,
                    'output'               => true,
                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                    'output_tag'           => true,
                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                    'database'             => '',
                    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                    'system_info'          => false,
                    // REMOVE
                );

            }

            public function validate_callback_function( $field, $value, $existing_value ) {
                $error = true;
                $value = 'just testing';

                /*
              do your validation

              if(something) {
                $value = $value;
              } elseif(something else) {
                $error = true;
                $value = $existing_value;
                
              }
             */

                $return['value'] = $value;
                $field['msg']    = 'your custom error message';
                if ( $error == true ) {
                    $return['error'] = $field;
                }

                return $return;
            }

            public function class_field_callback( $field, $value ) {
                print_r( $field );
                echo '<br/>CLASS CALLBACK';
                print_r( $value );
            }

        }

        global $reduxConfig;
        $reduxConfig = new Redux_Framework_sample_config();
    } else {
        echo "The class named Redux_Framework_sample_config has already been called. <strong>Developers, you need to prefix this class with your company name or you'll run into problems!</strong>";
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ):
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    endif;

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ):
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error = true;
            $value = 'just testing';

            /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            
          }
         */

            $return['value'] = $value;
            $field['msg']    = 'your custom error message';
            if ( $error == true ) {
                $return['error'] = $field;
            }

            return $return;
        }
    endif;
