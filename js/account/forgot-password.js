const module = angular.module('confirmationModule', []);
module.service('confirmationService', function($http) {
    this.sendResetEmailCode = (data) => {
        const form_data = new FormData();
        angular.forEach(data, (value, key) => {
            form_data.append(key, value);
        });
        return $http({
            method: 'POST',
            url: 'http://localhost:8000/api/resetpassword.php',
            data: form_data,
            transformRequest: angular.identity,
            headers: { 'Content-Type': undefined }
        });
    }
});
module.controller('confirmationCtrl', ['$scope', 'confirmationService', function(s, service) {
    s.user_credentials = {};
    s.button_label = 'Send';

    s.onSave = () => {
        s.button_label = 'Please Wait';
        service.sendResetEmailCode(s.user_credentials).then(
            result => {
               if (result['status']){
                alert('Please check your email to change your password.');
                window.location.href = 'login.php';
               }
                else 
                   alert(result['error']);
            },
            error => {
                console.log(error);
            }
        );
    }
}]);