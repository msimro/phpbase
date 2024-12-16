The Singleton pattern is a design pattern that ensures a class has only one instance and provides a global point of access to it. Here's a simple implementation of the Singleton pattern in PHP:

The anatomy of a singleton pattern
Let's start by understanding the structural characteristics of a class that obeys the singleton pattern:

A private constructor is used to prevent the direct creation of objects from the class.
The expensive process is performed within the private constructor.
The only way to create an instance from the class is by using a static method that creates the object only if it wasn't already created.
<?php
// General singleton class.
class Singleton {
  // Hold the class instance.
  private static $instance = null;
  
  // The constructor is private
  // to prevent initiation with outer code.
  private function __construct()
  {
    // The expensive process (e.g.,db connection) goes here.
  }
 
  // The object is created from within the class itself
  // only if the class has no instance.
  public static function getInstance()
  {
    if (self::$instance == null)
    {
      self::$instance = new Singleton();
    }
 
    return self::$instance;
  }
}
?>
Why is it a singleton?
Since we restrict the number of objects that can be created from a class to only one, we end up with all the variables pointing to the same, single object.

<?php
// All the variables point to the same object.
$object1 = Singleton::getInstance();
$object2 = Singleton::getInstance();
$object3 = Singleton::getInstance();
?>

Key Points:
Private Constructor: Prevents direct object creation.
Static Instance: Holds the single instance of the class.
Public Static Method: Provides a global access point to the instance.
Prevent Cloning and Unserialization: Ensures the instance cannot be duplicated.
This pattern is useful when exactly one object is needed to coordinate actions across the system.

Practical example::database class

<?php
// Singleton to connect db.
class ConnectDb {
    // Hold the class instance.
    private static $instance = null;
    private $conn;
    
    private $host = 'localhost';
    private $user = 'db user-name';
    private $pass = 'db password';
    private $name = 'db name';
     
    // The db connection is established in the private constructor.
    private function __construct()
    {
      $this->conn = new PDO("mysql:host={$this->host};
      dbname={$this->name}", $this->user,$this->pass,
      array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    
    public static function getInstance()
    {
      if(!self::$instance)
      {
        self::$instance = new ConnectDb();
      }
     
      return self::$instance;
    }
    
    public function getConnection()
    {
      return $this->conn;
    }
  }



//usage
$instance = ConnectDb::getInstance();
$conn = $instance->getConnection();
var_dump($conn);

$instance = ConnectDb::getInstance();
$conn = $instance->getConnection();
var_dump($conn);

$instance = ConnectDb::getInstance();
$conn = $instance->getConnection();
var_dump($conn);

//The result is the same connection for the three instances.

?>

To understand the problem that the singleton pattern solves, let's consider the following class that has no mechanism to check if a connection already exists before it establishes a new connection
<?php
// Connect db without a singleton.
class ConnectDbWOSingleton {
    private $conn;
    
    private $host = 'localhost';
    private $user = 'db user-name';
    private $pass = 'db password';
    private $name = 'db name';
     
    // Public constructor.
    public function __construct()
    {
      $this->conn = new PDO("mysql:host={$this->host};
      dbname={$this->name}", $this->user,$this->pass,
      array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
     
    public function getConnection()
    {
      return $this->conn;
    }
  }

//  Now, each time we create a new object, we also establish a new database connection.
$instance = new ConnectDbWOSingleton();
$conn = $instance->getConnection();
var_dump($conn);
 
$instance = new ConnectDbWOSingleton();
$conn = $instance->getConnection();
var_dump($conn);
 
$instance = new ConnectDbWOSingleton();
$conn = $instance->getConnection();
var_dump($conn);
//This has implications for slowing down the system because each new connection with the database costs time.

?>

The singleton pattern::the good, the bad, and the ugly

The singleton pattern is probably the most infamous pattern to exist, and is considered an anti-pattern because it creates global variables that can be accessed and changed from anywhere in the code.
Yet, The use of the singleton pattern is justified in those cases where we want to restrict the number of instances that we create from a class in order to save the system resources. Such cases include data base connections as well as external APIs that devour our system resources.


<?php
class MyConnect {
	private $db_name;
	private $username;
	private $password;
	private $host;

	private static $connection;
	
	private function __construct($name, $username, $password) {
		$this->db_name = $name;
		$this->username = $username;
		$this->password = $password;
		$this->host = 'localhost';	
	}

	public static function open_connection($name, $username, $password) {
		if ( ! isset( self::$connection ) ) {
			self::$connection = new MyConnect($name, $username, $password);
		}

		return self::$connection;
	}
	
	public function get_info( $query ) {
		//STUB
	}
	
	public function set_info( $query ) {
		//STUB
	}

	public function get_db_name() {
		return $this->db_name;
	}
}

//$db = new MyConnect( 'people', 'joe', 'hello_there' );

$db = MyConnect::open_connection( 'people', 'joe', 'hello_there' );
echo $db->get_db_name();
echo '<br/>';

$db2 = MyConnect::open_connection( 'places', 'joe', 'hello_there' );
echo $db2->get_db_name();