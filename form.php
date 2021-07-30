<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

</body>
</html>
<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleInputFile">File Upload</label>
        <input type="file" name="file" class="form-control" id="exampleInputFile">
    </div>
    <button type="preview" name="preview" class="btn btn-primary">Preview</button>
</form>



<?php
require_once 'vendor/autoload.php';
require_once 'db.php';
  
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
  
if (isset($_POST['preview'])) {
 
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
     
    if(isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {
     
        $arr_file = explode('.', $_FILES['file']['name']);
        $extension = end($arr_file);
     
        if('csv' == $extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

 
        $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
 
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        ?>
            <form action="action.php"   method="post">
             <div class="container">
        
              <table class="table table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
               </tr>

                <?php
                 for ($i=1; $i<count($sheetData); $i++) {
                               $name = $sheetData[$i][1];
                               $id = $sheetData[$i][0];
                               $email = $sheetData[$i][2];

                  echo "<tr><td><input type=checkbox name=checked[".$i."] value='true'>".
                                "<input type=hidden name=name[".$i."] value='".$name."'>".
                                "<input type=hidden name=email[".$i."] value='".$email."'>"

                        .$id."</td><td>".$name."</td><td>".$email."</td></tr>";

                }
                ?>

            <input type="submit" value="save" id="submit">
        </thead>
            </table>
        </form>
<?php } } ?>