const module = angular.module('cashierApp', []);

module.service('ReceiptService', function($http) {
  this.pay = (data) => {
    const form_data = new FormData();
    angular.forEach(data, (value, key) => {
      form_data.append(key, value);
    });
    return $http({
      method: 'PUT',
      url: 'https://tak-angrestaurant.000webhostapp.com/apis/receipt',
      data: form_data,
      transformRequest: angular.identity,
      headers: { 'Content-Type': undefined }
    });
  }
});

module.service('ReceiptService', function($http) {
    this.pay = (data) => {
      const form_data = new FormData();
      angular.forEach(data, (value, key) => {
        form_data.append(key, value);
      });
      return $http({
        method: 'PUT',
        url: 'https://tak-angrestaurant.000webhostapp.com/api/receipt.php',
        data: form_data,
        transformRequest: angular.identity,
        headers: { 'Content-Type': undefined }
      });
    }
  });

module.controller('ModalController', ['$scope', 'ReceiptService', function(s, receipt_service) {

  let table;
  let is_serve = false;
  s.totalprice = 0;
  s.cash = 0;
  s.button_label = 'Process';
  s.orders = [];
  
  initDatatable();

  s.closeModal = () => {
    ModalController.closeModal();
  }

  s.onProcess = () => {
    if (s.orders.length > 0) {
        let order_id;
        if (is_serve) {
            order_id = {
                order_id: s.orders[0].order_id,
                is_serve: true
            }
        } else {
            order_id = {
                order_id: s.orders[0].order_id
            }
        }
        receipt_service.pay(order_id).then(
            result => {
            if (result.data.data == "Success") {
                alert(is_serve ? 'Cooking completed!' : 'Processing!');
                table.ajax.reload();
                ModalController.closeModal();
                s.cash = 0;
                is_serve = false;
            }
            else
                alert(result.data.data);
            }
        );
    }
  }


function initDatatable() {
  $(document).ready(function() {
    table = $("#table_id").DataTable({
      ajax: "https://tak-angrestaurant.000webhostapp.com/api/receipt.php?chef=true",
      dataSrc: "data",
      columns: [
        {
          data: 0
        },
        {
          data: 1
        },
        {
          data: 2,
          render: function(data, type, row) {
            switch (parseInt(data)) {
                case 1:
                    return 'Pending';
                case 3:
                    return 'Serve';
                default:
                    return 'Processing';
            }
          }
        }
      ]
    });

    $("#table_id tbody").on("click", "tr", async function() {
      var data = table.row(this).data();
      s.button_label = data[2] == '2' ? 'Ready' : 'Processing';
      is_serve = data[2] == '2' ? true : false;
      s.orders = await getOrdersByTable(data[0]);
      s.$apply();
      ModalController.showModal();
    });
  });
}

async function getOrdersByTable($id) {
  const response = await fetch('https://tak-angrestaurant.000webhostapp.com/api/order.php?tableId='+$id);
  if(response.ok) {
    return await response.json();
  }
}

}]);
