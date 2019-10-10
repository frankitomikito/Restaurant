async function reloadTable() {
    let response = await fetch('https://tak-angrestaurant.000webhostapp.com/api/user.php?returnType=datatable');
    if (response.ok) {
        let json = await response.json();
        table.rows().invalidate(json)
        .draw(false);

    } else {
        alert("HTTP-Error: " + response.status);
    }
}

function changeIntegerToText(json) {
    for (let i = 0; i < json.length; i++) {
        let user = json[i];
        user[0] = parseInt(user[0]);
        user[3] = Users.getGenderString(user[3]);
        user[5] = Users.getPositionString(user[5]);
        user[6] = Users.getStatusString(user[6]);
    }
}

function showModal(action) {
    switch(action) {
        case 'add':
        break;
    }
    ModalController.showModal();
}

$(document).ready(function() {
    $('#buttonAdd').click(function() {
        showModal('add');
    });
});

module.service('userService', ['$http', function(h) {
    this.addUser = (data) => {
        console.log(data);
        let formdata = new FormData();
        angular.forEach(data, (value, key) => {
            formdata.append(key, value);
        });
        return h({
            method: 'POST',
            url: 'https://tak-angrestaurant.000webhostapp.com/api/user.php',
            data: formdata,
            transformRequest: angular.identity,
            headers: { 'Content-Type': undefined }
        });
    }
    this.updateUser = (data) => {
        console.log(data);
        let formdata = new FormData();
        angular.forEach(data, (value, key) => {
            formdata.append(key, value);
        });
        return h({
            method: 'PUT',
            url: 'https://tak-angrestaurant.000webhostapp.com/api/user.php',
            data: formdata,
            transformRequest: angular.identity,
            headers: { 'Content-Type': undefined }
        });
    }
}]);

module.controller('modalCtrl', ['$scope', 'userService', function(s, user_service) {
    s.user = {
        gender: '1',
        position: '3',
    }
    s.users = null;
    s.edit = false;
    s.save_btn_text = 'save';
    let isSubmit = false;
    let table;

    setDataTableValue();

    s.onSubmit = () => {
        if (!isSubmit) {
            s.save_btn_text = 'Please wait';
            user_service.addUser(s.user).then(
              result => {
                if (result['status']) {
                  alert("Saved Successfully!");
                  reInitializeTable();
                  s.onCancel();
                } else {
                  alert(result.data.error);
                  s.save_btn_text = 'Save';
                }
              },
              error => {
                console.log(error);
              }
            );
        }
    }

    s.onUpdate = () => {
        user_service.updateUser(s.user).then(
            result => {
                if (result.data) {
                    alert("Updated Successfully!");
                    reInitializeTable();
                    s.onCancel();
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
        ModalController.closeModal(() => {
            s.user = {};
            s.save_btn_text = 'Save';
            $('#profileImg').attr('src', '../images/person_3.jpg');
            $('#uploadImg').val(null);
    
            if (s.edit)
                s.edit = false;
            s.$apply();
        });
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

    function reInitializeTable() {
        $('#datatable-tabletoolss').DataTable().destroy();
        $('#datatable-tabletoolss').off();
        setDataTableValue();
    }

    async function setDataTableValue() {
        let response = await fetch('https://tak-angrestaurant.000webhostapp.com/api/user.php?returnType=datatable');
        if (response.ok) {
            let json = await response.json();
            changeIntegerToText(json);
            table = $('#datatable-tabletoolss').DataTable({
                data: json,
                columnDefs: [
                    { width: 100, targets: 0 },
                    { width: 40, targets: 3 },
                    { width: 40, targets: 5 },
                    { width: 40, targets: 6 }
                ]
            });

            $('#datatable-tabletoolss').on('click', 'tr', function () {
                const data = table.row(this).data();
                s.user.user_id = parseInt(data[0]);
                s.user.fullname = data[1];
                s.user.email = data[2];
                s.user.gender = Users.getGenderInt(data[3]);
                s.user.address = data[4];
                s.user.position = Users.getPositionInt(data[5]);
                s.user.status = Users.getStatusInt(data[6]);
                s.user.image_path = data[7];
                $('#profileImg').attr('src', `../${data[7]}`);
                s.edit = true;
                s.$apply();
                ModalController.showModal();
            });
        } else {
            alert("HTTP-Error: " + response.status);
        }
    }
}]);