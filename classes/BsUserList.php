<?php
if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class BsUserList extends WP_List_Table {

    /**
     * Prepare the items for the table to process
     *
     * @return Void
     */
    public function prepare_items()
    {
        $columns  = $this->get_columns();
        $hidden   = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();

        $data = $this->table_data();

        $perPage     = 10;
        $currentPage = $this->get_pagenum();
        $totalItems  = count($data);

        $this->set_pagination_args( array(
            'total_items' => $totalItems,
            'per_page'    => $perPage
        ) );

        $data = array_slice($data,(($currentPage-1)*$perPage),$perPage);

        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;
    }

    /**
     * Override the parent columns method. Defines the columns to use in your listing table
     *
     * @return Array
     */
    public function get_columns() {
        $columns = array(
            'display_name' => 'Name',
            'user_login'   => 'Username',
            'user_email'   => 'Email',
            'commission'   => 'Commission',            
            'action'       => 'Action',            
        );
        return $columns;
    }

    /**
     * Define which columns are hidden
     *
     * @return Array
     */
    public function get_hidden_columns() {
        return array();
    }

    /**
     * Define the sortable columns
     *
     * @return Array
     */
    public function get_sortable_columns() {
        return array();
    }

    /**
     * Get the table data
     *
     * @return Array
     */
    private function table_data() {
        global $wpdb;

        // $sql      = "SELECT *  FROM  {$wpdb->prefix}users";
        // $result = $wpdb->get_results( $sql, 'OBJECT' );
        $data       = array();
        $blogusers  = get_users( );

        foreach ( $blogusers as $user ) {
            if(in_array('instructor', $user->roles)){
                $temp = array();

                $temp['ID']             = $user->ID;
                $temp['display_name']   = $user->display_name;
                $temp['user_email']     = $user->user_email;
                $temp['user_login']     = $user->user_login;                
                $temp['commission']     = self::getCommission($user->ID);
                $temp['action']         = self::getAction($user->ID);

                $data[] = $temp;
            }                   
        }
        return $data;
    }

    /**
     * Define what data to show on each column of the table
     *
     * @param  Array $item        Data
     * @param  String $column_name - Current column name
     *
     * @return Mixed
     */
    public function column_default( $item, $column_name ) {
        switch( $column_name ) {

            case 'display_name':
            case 'user_login':
            case 'user_email':
             case 'commission':
             case 'action':
                return $item[$column_name];
            default:
                return print_r( $item, true ) ;
        }
    }

    public function getCommission( $userID ) {
        return '10%';
    }

    public function getAction( $userID ) {
        return '<a href="#" class="button button-primary">Change Commission</a>';
    }
    



}
?>