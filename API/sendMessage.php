<?php
    session_start();

    function sendMessage($to_yb_uid, $content)
    {
        $url = 'https://openapi.yiban.cn/msg/letter';
        $post_data = array(
          'access_token' => $_SESSION['token'],
          'to_yb_uid' => $to_yb_uid,
          'content' => $content
        );
        $postdata = http_build_query($post_data);
        $options = array(
        'http' => array(
          'method' => 'POST',
          'header' => 'Content-type:application/x-www-form-urlencoded',
          'content' => $postdata,
          'timeout' => 15 * 60 // 超时时间（单位:s）
        )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        return $result;
    }
 ?>
