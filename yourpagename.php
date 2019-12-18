

$contents_europeana = fopen("https://bigquery-api-dot-lfanttest1.appspot.com/items/25, "r");
$json_europeana = stream_get_contents($contents_europeana);
fclose($contents_europeana);

//print $json_europeana;

//$data_europeana = json_decode($json_europeana);

//print $data_europeana;
print '<table border=1><tr><th>id</th><th>title</th><th>date_time</th><th>location</th><th>price</th><th>images</th></tr>';

$data_europeana = json_decode($json_europeana);

// foreach($data_europeana as $key=>$value){
//     print '<tr>'.$value->id.'</tr>';
//     print '<tr>'.$value->title.'</tr>';
//     print '<tr>'.$value->date_time.'</tr>';
//     print '<tr>'.$value->location.'</tr>';
//     print '<tr>'.$value->price.'</tr>';
//     //print '<img src="'.(isset($value->images)?$value->images:'').'" height="100" width="100"></a></td></tr>';
//     print '<tr><img src="'.$value->images.'" height="100" width="100"></tr>';
//      //print_r($key);
//      //print_r($value);
// }

foreach($data_europeana as $key=>$value){
echo "<tr><td>".$value->id."</td><td>".$value->title."</td><td>".$value->date_time."</td><td>".$value->location."</td><td>".$value->price.'</td><td><img src="'.$value->images.'" height="100" width="100"></td>';
}

// foreach($data_europeana as $item) {
//     print '<td>'.(isset($item->id)?$item->id:'').'</td>';
//     print '<td>'.(isset($item->title)?$item->title:'').'</td>';
//     print '<td>'.(isset($item->date_time)?$item->date_time:'').'</td>';
//     print '<td>'.(isset($item->location)?$item->location:'').'</td>';
//     print '<td>'.(isset($item->price)?$item->price:'').'</td>';
//     print '<td>'.(isset($item->price)?$item->price:'').'</td>';
//     //print '<td><a href="'.(isset($item->url)?$item->url:'').'">View at the website</a></td>';
//     print '<td><a href="'.(isset($item->isShownAt)?$item->images:'').'"><img src="'.(isset($item->images)?$item->images:'').'" height="100" width="100"></a></td></tr>';
//     print '<br>';
// }


print '</table>';

?>

