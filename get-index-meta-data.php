<?php
  function getIMDSv2Token() {
      $token_url = "http://169.254.169.254/latest/api/token";
      $token = file_get_contents($token_url, false, stream_context_create([
          "http" => [
              "method" => "PUT",
              "header" => "X-aws-ec2-metadata-token-ttl-seconds: 21600"
          ]
      ]));
      return $token;
  }

  $token = getIMDSv2Token();
  $urlRoot = "http://169.254.169.254/latest/meta-data/";

  if ($token) {
      echo "<tr><td>InstanceId</td><td><i>" . file_get_contents($urlRoot . 'instance-id', false, stream_context_create([
          "http" => [
              "header" => "X-aws-ec2-metadata-token: " . $token
          ]
      ])) . "</i></td><tr>";
  } else {
      echo "<tr><td>Erro</td><td><i>Não foi possível obter o token do IMDSv2</i></td></tr>";
  }
?>