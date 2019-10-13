const module = angular.module('confirmationModule', []);
module.service('confirmationService', function($http) {
    this.saveNewPassword = (data) => {
        const form_data = new FormData();
        angular.forEach(data, (value, key) => {
            form_data.append(key, value);
        });
        return $http({
            method: 'PUT',
            url: `${RequestPath.getPath()}/api/resetpassword.php`,
            data: form_data,
            transformRequest: angular.identity,
            headers: { 'Content-Type': undefined }
        });
    }
});
module.controller('confirmationCtrl', ['$scope', 'confirmationService', function(s, service) {
    s.user_credentials = {};
    s.button_label = 'Save';

    s.onSave = () => {
        s.user_credentials.code_id = code_id;
        s.user_credentials.user_id = user_id;
        if(s.user_credentials.password == s.user_credentials.repassword) {
            s.button_label = 'Please Wait';
            service.saveNewPassword(s.user_credentials).then(
                result => {
                   if (result['status']){
                    alert('New password saved!.');
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
        else
            alert('Password does not match.');
    }
}]);