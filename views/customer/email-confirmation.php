<?php
    require 'Models/UserCode.php';

    $user_code = new UserCode;
    $param = [
        'search' => 'code',
        'value' => RequestRoute::PARAMGET('code')
    ];
    $result = $user_code->search($param);
    if ($result == null){
        echo '
        <script>
            alert("This code already used or not exist.");
            window.location.href = "/";
        </script>';
    }
    else {
        $user_code->update($result['code_id']);
        echo '
        <script>
            alert("Email Confirmed.");
            window.location.href = "/login";
        </script>';
    }
?>