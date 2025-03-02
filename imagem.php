<!DOCTYPE html>
<html>
  <head>
    <title>AWS Cloud Practioner Essentials</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body style="background-color:black">
    <div class="container">

	<div class="row">
		<div class="col-md-12">
      <?php include('menu.php'); ?>

			<div class="jumbotron" style="background-color:#555; color:#fff">
      <a  href="/"><img width="400" src="<?php echo $linkestatico?>/<?php echo $bucket ?>/<?php echo $arqName ?>" /></a>
            <div class="form-group">
      
    </div>
    <div class="navbar-header">
     
        
    </div>
    <form  form name="teste" method="post" enctype="multipart/form-data">
          <input type="file" name="file">
          <input class="btn btn-primary btn-sm" type="submit">
        </form>
    
     <?php

require 'vendor/autoload.php';
require 's3-conf.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

// Configuração do cliente S3 usando IAM Role da EC2
$s3 = new S3Client([
    'version' => 'latest',
    'region'  => $region , // Altere para a região do seu S3
]);

// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        $bucketName = $bucket;
        $key = 'logo.jpg'; // Caminho dentro do bucket

        try {
            // Enviar o arquivo para o S3
            $result = $s3->putObject([
                'Bucket' => $bucketName,
                'Key'    => $key,
                'SourceFile' => $file['tmp_name'],
            ]);

            echo "Arquivo enviado com sucesso! URL: " . $result['ObjectURL'];
        } catch (AwsException $e) {
            echo "Erro ao enviar arquivo: " . $e->getMessage();
        }
    } else {
        echo "Erro no upload do arquivo.";
    }
}


	?>
    </div>
  </div>
</div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>

</body>
</html>
