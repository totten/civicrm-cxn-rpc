<?php
namespace Civi\Cxn\Rpc;

class KeyPair {
  /**
   * @return array
   *   Array with elements:
   *   - privatekey: string.
   *   - publickey: string.
   */
  public static function create() {
    $rsa = new \Crypt_RSA();
    return $rsa->createKey(Constants::RSA_KEYLEN);
  }

  /**
   * @param string $file
   *   File path.
   * @return array
   *   Array with elements:
   *   - privatekey: string.
   *   - publickey: string.
   */
  public static function load($file) {
    return json_decode($file, TRUE);
  }

  /**
   * @param string $file
   *   File path.
   * @param array $keyPair
   *   Array with elements:
   *   - privatekey: string.
   *   - publickey: string.
   */
  public static function save($file, $keyPair) {
    file_put_contents($file, json_encode($keyPair, JSON_PRETTY_PRINT));
  }
}