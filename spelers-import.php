
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
  INSERT INTO spelers 
   (ID, Voornaam, Achternaam, SchoolID) 
   VALUES(:ID, :Voornaam, :Achternaam, :SchoolID);
  ";
  $statement = $connect->prepare($query);
  for($i = 0; $i < count($data); $i++)
  {
   $statement->execute(
    array(
     ':ID'   => $data->spelers[$i]->ID,
     ':Voornaam'  => $data->spelers[$i]->Voornaam,
     ':Achternaam'  => $data->spelers[$i]->Achternaam,
     ':SchoolID'  => $data->spelers[$i]->SchoolID,
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
