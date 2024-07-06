<?php 

if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class Test_table extends WP_LIST_Table{

    private $_items;

    function __construct($args = array()){
        parent::__construct($args); 
    }

    function set_deta($data){
        $this->_items = $data;

    }

    
    function get_columns(){
        return [
            'cb' => '<imput type="checkbox">',
            'name' => __('Name', 'test-plugin'),
            // 'sex' => __('gender', 'test-plugin'),
            'email' => __('E-mail', 'test-plugin'),
            'age' => __('Age', 'test-plugin'),
        ];
    }

    function get_sortable_columns()
    {
        return [
            'age' => [ 'age' , true ],
            'name' => [ 'name' , true ],

        ];
    }

    function column_cb($item)
    {
        return "<input type='checkbox' value='{$item['id']}'>";
    }

    /*
    function extra_tablenav($which)
    {
        if($which == 'top'):
        ?>
            <div class="action alignleft">
                <select name="filter_s" id="filter_s" class="filter_s">
                    <option value="All">All</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <?php  
                submit_button(__('Filter', 'test-plugin'), 'primary', 'submit', false);
                ?>
            </div>
        <?php
        endif;
    }
        */

    function prepare_items(){        

        
        $paged = $_REQUEST['paged'] ?? 1;
        $data_chucks = array_chunk($this->_items, 10);
        $this->items = $data_chucks[$paged -1];

        $this->set_pagination_args([
            'total_items' => count($this->_items),
            'per_page' => 10,
            'totla_page' => ceil(count($this->_items) / 10) 
        ]);

        
        $this->_column_headers = array($this->get_columns(), array(), $this->get_sortable_columns() );
    }

    function column_default($item, $column_name)
    {
        return $item[$column_name];
    }

}