<?php
    class Post extends CI_Model {
        public function all() {
            $query = "SELECT * FROM quotes";
            return $this->db->query($query)->result_array();
        }
        public function create($new_post){
            $query = "INSERT INTO quotes (author, quote) VALUES (?, ?)";
            $values = array($new_post['author'], $new_post['quote']);
            return $this->db->query($query, $values);
        }
    }

?>