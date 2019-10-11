<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account Confirmation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../build/admin/confirmation.css">
</head>

<body ng-app="confirmationModule">
    <nav class="myNav"></nav>
    <div class="myContainer content-center">
        <div class="myCard" ng-controller="confirmationCtrl" style="width: 30%;">
            <h2 class="myCard-title center">Forgot Password</h2>
            <div class="myCard-content">
                <form name="accountForm">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="myInput-container">
                                <label class="floating-label active">Email</label>
                                <input name="email" type="email" ng-model="user_credentials.email" class="myInput-control margin" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="myCard-footer">
                <button type="button"
                 class="myBtn"
                 ng-click="onSave()"
                 ng-disabled="!accountForm.$valid"
                 style="font-size: 1.2rem;">{{button_label}}</button>
            </div>
        </div>
    </div>
    
    <script src="../js/angular.js"></script>
    <script src="../js/requestpath.js"></script>
    <script src="../js/account/forgot-password.js"></script>
</body>
</html>