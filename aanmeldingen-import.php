
<?php
//import.php
sleep(3);
$output = '';

if(isset($_FILES['file']['name']) &&  $_FILES['file']['name'] != '')
{
 $valid_extension = array('xml');
 $file_data = explode('.', $_FILES['file']['name']);
 $file_extension = end($file_data);
 if(in_array($file_extension, $valid_extension))
 {
  $data = simplexml_load_file($_FILES['file']['tmp_name']); // CODE OM XML BESTANDEN TE LADEN
  $connect = new PDO('mysql:host=localhost;dbname=mboopen','root', ''); //CONNECTIE MET DATABASE
  $query = "
  INSERT INTO aanmelding
   (Naam, School, Toernooi) 
   VALUES(:Naam, :School, :Toernooi);
  ";
  $statement = $connect->prepare($query);
  for($i = 0; $i < count($data); $i++)
  {
   $statement->execute(
    array(
     ':Naam'   => $data->aanmelding[$i]->Naam,
     ':School'  => $data->aanmelding[$i]->School,
     ':Toernooi'  => $data->aanmelding[$i]->Toernooi,
    )
   );

  }
  $result = $statement->fetchAll();
  if(isset($result))
  {
   $output = '<div class="alert alert-success">Importeren gelukt</div>';
  }
 }
 else
 {
  $output = '<div class="alert alert-warning">Verkeerde bestand</div>';
 }
}
else
{
 $output = '<div class="alert alert-warning">Kies XML Bestand</div>';
}

echo $output;

?>
