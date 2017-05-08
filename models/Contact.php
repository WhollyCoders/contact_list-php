<?php
require('../../myb4g-connect.php');
require('../classes/QueryDatabase.php');
require('../classes/AddContact.php');
class Contact{
  public $connection;
  public $id;
  public $email;
  public $firstname;
  public $lastname;
  public $phone;
  public $table_name;

  function __construct($conn, $contact_data_array){
    $this->connection = $conn;
    $this->email      = $contact_data_array['email'];
    $this->firstname  = $contact_data_array['firstname'];
    $this->lastname   = $contact_data_array['lastname'];
    $this->phone      = $contact_data_array['phone'];
    $this->id         = null;
    $this->set_table_name();
    $this->create_contacts_table();
    $this->add_contact();
  }

  function set_table_name(){
    $this->table_name = 'table_contacts';
  }
  function get_table_name(){
    return $this->table_name;
  }
  function create_contacts_table(){
      $sql_create_contacts_table = "CREATE TABLE IF NOT EXISTS `mybod4god`.`".$this->get_table_name()."` (
     `contact_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
     `contact_email` VARCHAR(100) NOT NULL ,
     `contact_firstname` VARCHAR(100) NOT NULL ,
     `contact_lastname` VARCHAR(100) NOT NULL ,
     `contact_phone` VARCHAR(20) NOT NULL ,
     `contact_date_entered` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
     PRIMARY KEY (`contact_id`)
     ) ENGINE = InnoDB;";

     $query_array = array(
       'connection'  => $this->connection,
       'query'       => $sql_create_contacts_table
     );

     new QueryDatabase($query_array);

  }

  function get_contact_data_array(){
    $contact_data_array = array(
      'id'          =>  $this->id,
      'email'       =>  $this->email,
      'firstname'   =>  $this->firstname,
      'lastname'    =>  $this->lastname,
      'phone'       =>  $this->phone,
      'connection'  =>  $this->connection,
      'table_name'  =>  $this->table_name
    );
    return $contact_data_array;
  }

  function add_contact(){
    $contact_data_array = $this->get_contact_data_array();
    new AddContact($contact_data_array);
  }
}
// contact_data_array for testing purposes
$contact_data_array = array(
  'email'     => 'establer@gmail.com',
  'firstname' => 'Elliott',
  'lastname'  => 'Stabler',
  'phone'     => '(212) 555-1823'
);

// $contact = new Contact($connection, $contact_data_array);
// echo('<pre>');
// print_r($contact);
// echo('</pre>');
 ?>
