const module = angular.module('confirmationModule', []);
module.service('confirmationService', function($http) {
    this.saveCredentials = (data) => {
        const form_data = new FormData();
        angular.forEach(data, (value, key) => {
            form_data.append(key, value);
        });
        return $http.put('http://localhost:8000/apis/user_code', form_data);
    }
});
module.controller('confirmationCtrl', ['$scope', 'confirmationService', function(s, service) {
    s.user_credentials = {};
    s.save_btn = 'Save';

    s.onSave = () => {
        s.user_credentials.code_id = code_id;
        s.user_credentials.user_id = user_id;
        s.save_btn = 'Please wait';
        service.saveCredentials(s.user_credentials).then(
            result => {
               if (result['status']){
                alert('Saving Credentials Completed.');
                window.location.href = '/login';
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