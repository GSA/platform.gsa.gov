<?php
require_once 'CAS.php';

phpCAS::client(CAS_VERSION_2_0,'login.max.gov',443,'/cas' );
phpCAS::setNoCasServerValidation();

class OMBMax
{

  public static function login()    
  {
    phpCAS::forceAuthentication();
  }
  public static function logout()   
  {
    if ( phpCAS::isAuthenticated() )
    {
      if ( isset($_SESSION['phpCAS']) ) 
      {
        $_SESSION['phpCAS'] = null;
        unset($_SESSION['phpCAS']);
      }
    }
  }

  public static function requireAuthentication()
  {
    if ( !phpCAS::isAuthenticated() ) 
    {
      phpCAS::forceAuthentication();
    }
  }

  public static function isAuthenticated()
  {
    return phpCAS::isAuthenticated();
  }

  public static function setDebug( $file )
  {
    phpCAS::setDebug($file);
  }

  public static function get( $attribute )
  {
    if ( isset($_SESSION['phpCAS']) 
      && isset($_SESSION['phpCAS'][$attribute]) ) 
    {
      return $_SESSION['phpCAS'][$attribute];
    }
    if ( isset($_SESSION['phpCAS']) 
      && isset($_SESSION['phpCAS']['attributes']) 
      && !empty($_SESSION['phpCAS']['attributes'][$attribute]) ) 
    {
      return $_SESSION['phpCAS']['attributes'][$attribute];
    }
    return null;
  } 

}

?>
