<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Config_pagination {
  public function get_config() {     
      $config["per_page"] = 15;
      $config["uri_segment"] = 3;
      $config['page_query_string'] = TRUE;
      // $config['use_page_numbers'] = TRUE;
      $config['query_string_segment'] = 'page';
      $config['full_tag_open'] = '<div ><ul class="pagination">';
      $config['full_tag_close'] = '</ul></div><!--pagination-->';
      $config['first_link'] = '&laquo; Primero';
      $config['first_tag_open'] = '<li class="prev page">';
      $config['first_tag_close'] = '</li>';
      $config['last_link'] = 'Ultimo &raquo;';
      $config['last_tag_open'] = '<li class="next page">';
      $config['last_tag_close'] = '</li>';
      $config['next_link'] = '<span aria-hidden="true">&raquo;</span>';
      $config['next_tag_open'] = '<li class="next page">';
      $config['next_tag_close'] = '</li>';
      $config['prev_link'] = '<span aria-hidden="true">&laquo;</span>';
      $config['prev_tag_open'] = '<li class="prev page">';
      $config['prev_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a href="">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li class="page">';
      $config['num_tag_close'] = '</li>';      
      $config['anchor_class'] = 'follow_link';
      
      return $config;
  }
}

    
    
