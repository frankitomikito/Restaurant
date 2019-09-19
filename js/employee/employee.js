import Users from './classes/Users.js';
import {ModalController} from './classes/Modal.js';

async function setDataTableValue() {
    let response = await fetch('http://localhost:8000/apis/user?returnType=datatable');
    if (response.ok) {
        let json = await response.json();
        changeIntegerToText(json);
        const table = $('#datatable-tabletoolss').DataTable({
            data: json,
            columnDefs: [
                { width: 100, targets: 0 },
                { width: 40, targets: 3 },
                { width: 40, targets: 5 },
                { width: 40, targets: 6 }
            ]
        });

        $('#datatable-tabletoolss').on('click', 'tr', function() {
            const data = table.row(this).data();
            alert('You clicked on ' + data[0] + '\'s row');
        });
    } else {
        alert("HTTP-Error: " + response.status);
    }
}

function changeIntegerToText(json) {
    let users = [];
    for (let i = 0; i < json.length; i++) {
        let user = json[i];
        user[5] = Users.getPositionString(user[5]);
        user[6] = Users.getStatusString(user[6]);
    }
}

let modal_ctrl = new ModalController();

function showModal(action) {
    switch(action) {
        case 'add':
        break;
    }
    modal_ctrl.showModal();
}

$(document).ready(function() {
    $('#buttonAdd').click(function() {
        showModal('add');
    });
    $('#buttonCancel').click(function() {
        modal_ctrl.closeModal();
    });
});


setDataTableValue();