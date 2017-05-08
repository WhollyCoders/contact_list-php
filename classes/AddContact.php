<?php
class AddContact{
  public $connection;
  public $id;
  public $email;
  public $firstname;
  public $lastname;
  public $phone;
  public $table_name;

  function __construct($contact_data_array){
    $this->id         = $contact_data_array['id'];
    $this->email      = $contact_data_array['email'];
    $this->firstname  = $contact_data_array['firstname'];
    $this->lastname   = $contact_data_array['lastname'];
    $this->phone      = $contact_data_array['phone'];
    $this->connection = $contact_data_array['connection'];
    $this->table_name = $contact_data_array['table_name'];
    $this->create_contacts_table();
    $this->add_contact();

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
      PRIMARY KEY (`contact_id`)) ENGINE = InnoDB;";

      $query_array = array(
        'connection'  => $this->connection,
        'query'       => $sql_create_contacts_table
      );

      new QueryDatabase($query_array);

    }

    function add_contact(){
      $sql_add_contact = "INSERT INTO `".$this->get_table_name()."` (
        `contact_id`,
        `contact_email`,
        `contact_firstname`,
        `contact_lastname`,
        `contact_phone`,
        `contact_date_entered`
        ) VALUES (
          NULL,
          '$this->email',
          '$this->firstname',
          '$this->lastname',
          '$this->phone',
          CURRENT_TIMESTAMP
        );";

        $query_array = array(
          'connection'  => $this->connection,
          'query'       => $sql_add_contact
        );

        new QueryDatabase($query_array);

      }
    }
 ?>
