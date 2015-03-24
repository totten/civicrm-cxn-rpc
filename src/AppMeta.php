<?php
namespace Civi\Cxn\Rpc;

use Civi\Cxn\Rpc\Exception\CxnException;

class AppMeta {

  public static function validate($appMeta) {
    $errors = self::getValidationMessages($appMeta);
    if (!empty($errors)) {
      throw new CxnException("Invalid AppMeta:" . implode(', ', array_keys($errors)));
    }
  }

  /**
   * @param array $appMeta
   * @return array
   *   List of errors. Empty error if OK.
   */
  public static function getValidationMessages($appMeta) {
    $errors = array();

    if (!is_array($appMeta)) {
      $errors['appMeta'] = 'Not an array';
    }

    foreach (array('appCert', 'appId') as $key) {
      if (empty($appMeta[$key])) {
        $errors[$key] = 'Required field';
      }
    }

    foreach (array('appUrl') as $key) {
      if (empty($appMeta[$key])) {
        $errors[$key] = 'Required field';
      }
      elseif (!filter_var($appMeta[$key], FILTER_VALIDATE_URL)) {
        $errors[$key] = 'Malformed URL';
      }
    }

    if (!isset($appMeta['perm']) || !is_array($appMeta['perm'])) {
      $errors['perm'] = 'Missing permisisons';
    }

    return $errors;
  }

}
