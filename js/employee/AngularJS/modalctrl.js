module.service('userService', ['$http', function(h) {
    this.addUser = (data) => {
        console.log(data);
        let formdata = new FormData();
        angular.forEach(data, (value, key) => {
            formdata.append(key, value);
        });
        return h({
            method: 'POST',
            url: 'http://localhost:8000/apis/user',
            data: formdata,
            transformRequest: angular.identity,
            headers: { 'Content-Type': undefined }
        });
    }
}]);

module.controller('modalCtrl', ['$scope', 'userService', function(s, user_service) {
    s.user = { }

    s.onSubmit = () => {
        console.log(s.user);
        user_service.addUser(s.user).then(
            result => {
                console.log(result);
                if(result.data) {
                    alert('Saved Successfully!');
                    s.onCancel();
                    closeModal();
                } else {
                    alert(result.error);
                }
            },
            error => {
                console.log(error);
            }
        );
    }

    s.onCancel = () => {
        s.user = {};
        $('#profileImg').attr('src', '../images/person_3.jpg');
        $('#uploadImg').val(null);
    }

    s.pickImage = () => {
        document.getElementById('uploadImg').click();
    }

    s.onImageChange = (file) => {
        if (file && file[0]) {
            s.user.user_image = file[0];
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#profileImg')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(file[0]);
        }
    }

    function closeModal() {
        const cont = document.getElementById('myModalContainer');
        cont.className = 'mymodal-container close';
        const id = document.getElementById('myModal');
        id.className = 'mymodal close';
        setTimeout(() => {
            id.style.display = "none";
        }, 600);
    }
}]);