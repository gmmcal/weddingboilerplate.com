<?php
class Install_Task {
 
  public function run($arguments = array()) {
    $this->print_message('Creating migration table');
    shell_exec ( 'php artisan migrate:install --env="' . Request::env() . '"' );
    if (Config::get('application.key') == '') {
      $this->print_message('Generating key');
      echo shell_exec ( 'php artisan key:generate --env="' . Request::env() . '"' );
    }
    $this->print_message('Migrating database');
    $this->print_message(shell_exec ( 'php artisan migrate --env="' . Request::env() . '"' ), false);
  }

  private function print_message($msg, $break = true) {
    print($msg);
    if($break){
      print(PHP_EOL);
    }
  }
}