<?php 
namespace CPT;

use \CPT\BookCPT;
use \CPT\BookMeta;
use \CPT\BookGenre;


class Plugin {

    public function init(){
    $this->load_dependencies();
    $this->register_components();
    }
    private function load_dependencies(){
        require_once plugin_dir_path(__FILE__).'class-book-cpt.php';
        require_once plugin_dir_path(__FILE__).'class-book-meta.php';
        require_once plugin_dir_path(__FILE__).'class-book-genre-taxonomy.php';
    }
    private function register_components(){
        (new BookCPT)->register();
        (new BookMeta)->register();
        (new BookGenre)->register();
    }

        public function activate() {
        $this->register_car_cpt();
        flush_rewrite_rules();
    }
}