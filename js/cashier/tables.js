const module = angular.module('cashierApp', []);

module.service('ReceiptService', function($http) {
  this.pay = (data) => {
    const form_data = new FormData();
    angular.forEach(data, (value, key) => {
      form_data.append(key, value);
    });
    return $http({
      method: 'POST',
      url: `${RequestPath.getPath()}/api/receipt.php?payment=true`,
      data: form_data,
      transformRequest: angular.identity,
      headers: { 'Content-Type': undefined }
    });
  }
});

module.controller('ModalController', ['$scope', 'ReceiptService', function(s, receipt_service) {

  let table;
  let table_status;
  let booking_id;
  s.totalprice = 0;
  s.cash = 0;
  s.orders = [];
  s.customer_info = {};
  s.waiter_info = {};
  s.todays_date = moment().format('MMMM DD, YYYY');
  
  getTableStatus(() => {
    initDatatable();
  });

  s.closeModal = () => {
    ModalController.closeModal();
  }

  s.totalPrice = () => {
    if(s.orders.length > 0) {
      let totalprice = 0;
      angular.forEach(s.orders, (value) => {
        totalprice += value.quantity * value.price;
      });
      s.totalprice = totalprice;
      return totalprice;
    }
    return 0;
  }

  s.onPaid = () => {
    if (s.orders.length > 0) {
      const order_id = {
        order_id: s.orders[0].order_id,
        booking_id: table_status.filter(f => table_id = booking_id)[0].booking_id
      }
      receipt_service.pay(order_id).then(
        result => {
          if (result.data.data == "Success") {
            alert('Payment Successful!');
            getTableStatus(() => {
              table.ajax.reload();
            });
            ModalController.closeModal();
            s.cash = 0;
          }
          else
            alert(result.data.data);
        }
      );
    }
  }

  s.cashChange = (cash) => {
    if(cash != 0) {
      const result = cash - s.totalprice;
      if(result < 0)
        return 0;
      else 
        return result;
    }
    else
      return 0;
  }


function initDatatable() {
  $(document).ready(function() {
    table = $("#table_id").DataTable({
      ajax: `${RequestPath.getPath()}/api/table.php?datatable=true`,
      dataSrc: "data",
      columns: [
        {
          data: 0
        },
        {
          data: 1
        },
        {
          data: 2
        },
        {
          data: 3,
          render: function(data, type, row) {
            const result = table_status.filter(f => f.table_id == row[0])[0];
            data = result ? result.status : 0;
            switch (parseInt(data)) {
                case 0:
                    return 'Available';
                default:
                    return 'Occupied';
            }
          }
        }
      ]
    });

    $("#table_id tbody").on("click", "tr", async function() {
      var data = table.row(this).data();
      booking_id = data[0];
      const result =  await getOrdersAndCustomerByTable(data[0]);
      s.orders = result.orders;
      s.customer_info = result.customer_info ? result.customer_info : {};
      s.waiter_info = result.waiter_info ? result.waiter_info : {};
      s.customer_info.date_ordered = moment(s.customer_info.date_ordered).format('MMMM DD, YYYY');
      s.$apply();
      ModalController.showModal();
    });
  });
}

async function getTableStatus(callback) {
  const response = await fetch(`${RequestPath.getPath()}/api/table.php`);
  if(response.ok) {
    table_status = (await response.json()).data;
    callback();
  }
}

async function getOrdersAndCustomerByTable($id) {
  const response = await fetch(`${RequestPath.getPath()}/api/order.php?tableId=`+$id);
  if(response.ok) {
    return await response.json();
  }
}

}]);
