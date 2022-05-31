<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.vsourz.com/
 * @since      1.0.0
 *
 * @package    All_In_One_Redirection
 * @subpackage All_In_One_Redirection/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    All_In_One_Redirection
 * @subpackage All_In_One_Redirection/admin
 * @author     Vsourz Digital <mehul@vsourz.com>
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class All_In_One_Redirection_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	
	/**
	 * The table name for this plugin
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $db_table_name    The table name for this plugin.
	 */
	protected $db_table_name;
	
	/**
	 * The default site url for this plugin
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $def_site_url    The default site url for this plugin.
	 */
	protected $def_site_url;
	
	/**
	 * The default setting site url for this plugin
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $def_setting_site_url    The default site url for this plugin.
	 */
	protected $def_setting_site_url;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $db_table_name, $def_site_url, $def_setting_site_url ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->db_table_name = $db_table_name;
		$this->def_site_url = $def_site_url;
		$this->def_setting_site_url = $def_setting_site_url;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in All_In_One_Redirection_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The All_In_One_Redirection_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/all-in-one-redirection-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in All_In_One_Redirection_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The All_In_One_Redirection_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/all-in-one-redirection-admin.js', array( 'jquery' ), $this->version, true );
	}
	
	// for 301, 302 redirection functionality with count number of hits
	public function vsz_redirection() {
		global $wpdb;
		$table_name = $this->db_table_name;
		$permalink_option = get_option('permalink_structure');
		
		$request_url = $this->vsz_get_address();
		
		$redirect_status = 0;
		$redirection_setting_array = json_decode(get_option('all-in-one-redirection-setting'));

			// check the host type
			if($redirection_setting_array->host=='HTTP'){
				if($this->vsz_get_protocol()=='https'){
					$redirect_status = 1;
					$request_url = str_ireplace('https:','http:',$request_url);
				}
			}
			elseif($redirection_setting_array->host=='HTTPS'){
				if($this->vsz_get_protocol()=='http'){
					$redirect_status = 1;
					$request_url = str_ireplace('http:','https:',$request_url);
				}
			}
			
			// check the www and non-www condition
			if($redirection_setting_array->www=='WWW'){
				if(!strpos($request_url,'www')){
					$redirect_status = 1;
					$request_url = str_ireplace('//','//www.',$request_url);
				}
			}
			elseif($redirection_setting_array->www=='NON-WWW'){
				if(strpos($request_url,'www')){
					$redirect_status = 1;
					$request_url = str_ireplace('//www.','//',$request_url);
				}
			}
			
			if(is_admin()){
				GOTO admin_redirection;	
			}
		
		$userrequest = str_ireplace($this->def_setting_site_url,'',$request_url);
		$userrequest = rtrim($userrequest,'/');
		if(empty($userrequest)){
			$userrequest = '/';
		}
		
		$userrequest_data = $wpdb->get_row("select * from ".$table_name." where source_url='".trim($userrequest)."' and reg_expression!=1 and hide_url!=1 and rtype!=404 order by id DESC");
		
		if($userrequest_data){
			$page_referrer='';
			if(isset($_SERVER['HTTP_REFERER'])){
				$page_referrer=esc_url($_SERVER['HTTP_REFERER']);
			}
			else{
				$page_referrer='-';
			}
			$page_ip=sanitize_text_field($_SERVER['REMOTE_ADDR']);
			
			$wpdb->update(
				$table_name,
				array(
					'hits' => $userrequest_data->hits+1,
					'referrer' => $page_referrer,
					'access_ip' => $page_ip,
					'last_access' => date('Y-m-d h:i:s')
				), 
				array( 'id' => $userrequest_data->id )
			);
			
			wp_redirect( $userrequest_data->destination_url, $userrequest_data->rtype ); 
			exit();
		}		
		else{
			$userrequest_data_reg_expression = $wpdb->get_results("select * from ".$table_name." where reg_expression=1 and hide_url!=1 and rtype!=404 order by id DESC");
			//var_dump($userrequest_data_reg_expression);
			//exit;
			
			$reg_expression_match=0;
			foreach($userrequest_data_reg_expression as $key => $reg_expression_data){				
				
				if($reg_expression_data->source_url=="/" || $reg_expression_data->source_url=="/*"){
					$page_referrer='';
					if(isset($_SERVER['HTTP_REFERER'])){
						$page_referrer=esc_url($_SERVER['HTTP_REFERER']);
					}
					else{
						$page_referrer='-';
					}
					$page_ip=sanitize_text_field($_SERVER['REMOTE_ADDR']);
						
					$wpdb->update(
						$table_name,
						array(
							'hits' => $reg_expression_data->hits+1,								
							'referrer' => $page_referrer,
							'access_ip' => $page_ip,
							'last_access' => date('Y-m-d h:i:s')
						), 
						array( 'id' => $reg_expression_data->id )
					);
					
					wp_redirect( $reg_expression_data->destination_url, $reg_expression_data->rtype ); 
					exit();
					break;
				}
				elseif(strlen($reg_expression_data->source_url) == strrpos($reg_expression_data->source_url,'*')+1){
					$reg_expression_match_detail_page = 0;
					$reg_expression_match_detail_slug = '';						
					$reg_expression_match_detail_slug = str_ireplace(rtrim($reg_expression_data->source_url,'/*'),'',$userrequest);
					
					if($userrequest!=$reg_expression_match_detail_slug && strlen($reg_expression_match_detail_slug) > 0){
						$reg_expression_match=$reg_expression_data->id;
						
						$page_referrer='';
						if(isset($_SERVER['HTTP_REFERER'])){
							$page_referrer=esc_url($_SERVER['HTTP_REFERER']);
						}
						else{
							$page_referrer='-';
						}
						$page_ip=sanitize_text_field($_SERVER['REMOTE_ADDR']);
							
						$wpdb->update(
							$table_name,
							array(
								'hits' => $reg_expression_data->hits+1,								
								'referrer' => $page_referrer,
								'access_ip' => $page_ip,
								'last_access' => date('Y-m-d h:i:s')
							), 
							array( 'id' => $reg_expression_data->id )
						);
						
						wp_redirect( $reg_expression_data->destination_url, $reg_expression_data->rtype ); 
						exit();
						break;
					}
				}
				elseif(strpos($userrequest,$reg_expression_data->source_url) !== false ){
					$reg_expression_match=$reg_expression_data->id;
					
					$page_referrer='';
					if(isset($_SERVER['HTTP_REFERER'])){
						$page_referrer=esc_url($_SERVER['HTTP_REFERER']);
					}
					else{
						$page_referrer='-';
					}
					$page_ip=sanitize_text_field($_SERVER['REMOTE_ADDR']);
								
					$wpdb->update(
						$table_name,
						array(
							'hits' => $reg_expression_data->hits+1,							
							'referrer' => $page_referrer,
							'access_ip' => $page_ip,
							'last_access' => date('Y-m-d h:i:s')
						),
						array( 'id' => $reg_expression_data->id )
					);
					
					wp_redirect( $reg_expression_data->destination_url, $reg_expression_data->rtype ); 
					exit();
					break;
				}				
			}
			
			if($redirect_status==1 && $reg_expression_match==0){
				if(!empty($permalink_option) && !(strpos($permalink_option,'post_id')) && !$_SERVER['QUERY_STRING']){
					$request_url = rtrim($request_url,'/');
					$request_url = $request_url.'/';
					wp_redirect( $request_url, 301 ); 
					exit();
				}
				else{
					
					if($_SERVER['QUERY_STRING'] && !is_admin()){
						$request_url= $request_url;
					}
					wp_redirect( $request_url, 301 ); 
					exit();
				}
			}
		}
		
		admin_redirection:
		if(is_admin()){
			if($redirect_status==1){
				if(!empty($permalink_option) && !(strpos($permalink_option,'post_id')) && !$_SERVER['QUERY_STRING']){
					$request_url = rtrim($request_url,'/');
					$request_url = $request_url.'/';
					wp_redirect( $request_url, 301 ); 
					exit();
				}
				else{
					
					if($_SERVER['QUERY_STRING'] && !is_admin()){
						$request_url= $request_url;
					}
					wp_redirect( $request_url, 301 ); 
					exit();
				}
			}
		}
	}
	
	// To keep the record of 404 pages
	public function vsz_404_pages() {
		if(is_404()) {
			global $wpdb;
			$table_name = $this->db_table_name;
			$page_404 = array();
			
			$page_404['source_url']=rtrim(str_ireplace($this->def_setting_site_url,'',$this->vsz_get_address()),'/');
			
			if(isset($_SERVER['HTTP_REFERER'])){
				$page_404['referrer']=esc_url($_SERVER['HTTP_REFERER']);
			}
			else{
				$page_404['referrer']='-';
			}
			$page_404['page_ip']=sanitize_text_field($_SERVER['REMOTE_ADDR']);
			
			
			$page_404_data = $wpdb->get_results("select * from ".$table_name." where rtype=404 order by last_access DESC");
			
			$match_404_page_id=0;
			$match_404_page_hit=0;
			if($page_404_data){
				foreach($page_404_data as $key => $page_404_data_item){
					if($page_404_data_item->source_url==$page_404['source_url']){
						$match_404_page_id=$page_404_data_item->id;
						$match_404_page_hit=$page_404_data_item->hits;
						break;
					}
				}
			}
			
			if($match_404_page_id!=0){
				$wpdb->update(
					$table_name,
					array(
						'hits' => $match_404_page_hit+1,							
						'referrer' =>  $page_404['referrer'],
						'access_ip' => $page_404['page_ip'],
						'last_access' => date('Y-m-d h:i:s')
					),
					array( 'id' => $match_404_page_id )
				);
			}
			else{
				$r_404_insert = $wpdb->insert(
					$table_name,
					array( 
						'rtype' => 404,
						'source_url' => stripslashes(trim($page_404['source_url'])),
						'hits' => 1,
						'referrer' => $page_404['referrer'],
						'access_ip' => $page_404['page_ip'],
						'last_access' => date('Y-m-d h:i:s'),					
						'time' => current_time( 'mysql' )
					) 
				);
			}
		}
	}
	
	// get the request uri address
	public function vsz_get_address() {
		// return the full address
		return $this->vsz_get_protocol().'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}
	
	
	// Set the base protocol to http
	public function vsz_get_protocol() {		
		$protocol = 'http';
		// check for https
		if ( isset( $_SERVER["HTTPS"] ) && strtolower( $_SERVER["HTTPS"] ) == "on" ) {
			$protocol .= "s";
		}
		return $protocol;
	}
	
	// Set the setting link in plugin page
	public function plugin_setting_link($links){
		$links[] = '<a href="'. get_admin_url(null, 'admin.php?page=all-in-one-redirection-setting') .'">'.__('Settings', 'all-in-one-redirection').'</a>';
        return $links;
	}
}