<?php

require_once "../src/vendor/autoload.php" ;

$client = new MongoDB\Client("mongodb://mongo");

$collection = $client->td3->parkings;

$response = file_get_contents('https://geoservices.grand-nancy.org/arcgis/rest/services/public/VOIRIE_Parking/MapServer/0/query?where=1%3D1&text=&objectIds=&time=&geometry=&geometryType=esriGeometryEnvelope&inSR=&spatialRel=esriSpatialRelIntersects&relationParam=&outFields=nom%2Cadresse%2Cplaces%2Ccapacite&returnGeometry=true&returnTrueCurves=false&maxAllowableOffset=&geometryPrecision=&outSR=4326&returnIdsOnly=false&returnCountOnly=false&orderByFields=&groupByFieldsForStatistics=&outStatistics=&returnZ=false&returnM=false&gdbVersion=&returnDistinctValues=false&resultOffset=&resultRecordCount=&queryByDistance=&returnExtentsOnly=false&datumTransformation=&parameterValues=&rangeValues=&f=pjson');
//var_dump($response);
$json = json_decode($response);

/*foreach ($json->{'features'} as $item) {
    $collection->insertOne($item);
}*/

$cursor = $collection->find();
   // iterate cursor to display title of documents
  // file_put_contents("test.json",$cursor);

    $myfile = fopen("test.json", "w") or die("Unable to open file!");
    fwrite($myfile,"{\"parkings\":[");
    foreach ($cursor as $document) {
        fwrite($myfile,json_encode($document));
        fwrite($myfile,",");
        //echo($document->{'attributes'}->{'NOM'}."<br>");
        //file_put_contents("test.json",$document);
    }
    //ftruncate($myfile, rand(1, filesize("test.json")-1));
    fwrite($myfile,"]}");
    fclose($myfile);
