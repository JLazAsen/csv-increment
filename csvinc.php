
<?php

class Csvinc {

  private $fichero;  // Fichero csv sobre el que trabajar
  private $temporal = "temp.csv";

  public function __construct($datacsv) {
    $this->fichero = $datacsv;
  }

  public function incrementa() {
    
    $error = FALSE;  

    if (($fichero = fopen($this->fichero, "r")) !== FALSE) {

      $temp = fopen($this->temporal, "w+");
      while ($row = fgetcsv($fichero)) {              
        foreach ($row as $key => $value) {
          if (is_numeric($value)) {
            $value = $value + 1;
            $row[$key] = $value;
          }        
        } 
       fputcsv($temp, $row);
      }
      fclose($fichero);
      fclose($temp);

      if (!copy($this->temporal, $this->fichero)) {
        $error = TRUE;
      }
      
      unlink($this->temporal);

      
    } else {
      $error = TRUE;
    }

    if ($error) {
      echo 'Error al procesar el fichero';
    }else{
      echo 'Proceso concluido con exito';
    }
  }
}

?>
