const module = angular.module('cashierApp', []);

module.controller('ModalController', ['$scope', function(s) {

  let table;
  s.totalprice = 0;
  s.cash = 0;
  s.orders = [];
  
  initDatatable();

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


function initDatatable() {
  $(document).ready(function() {
    table = $("#table_id").DataTable({
      ajax: `${RequestPath.getPath()}/api/receipt.php?datatable=true`,
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
          render: function(data) {
            return moment(data).format('MMMM DD, YYYY - h:mm A');
          }
        },
        {
          data: 3
        },
        {
          data: 4
        },
        {
            data: 5
        },
        {
            data: 6,
            render: function(data, type, row) {
                switch (data) {
                    case '0':
                        return 'Paid';
                    default:
                        return 'Not Paid';
                }
            }
        }
      ]
    });

    $("#table_id tbody").on("click", "tr", async function() {
      var data = table.row(this).data();
      booking_id = data[0];
      const result =  await getOrdersAndCustomerByTable(data[0]);
      s.orders = result;
      s.$apply();
      ModalController.showModal();
    });
  });
}

async function getOrdersAndCustomerByTable($id) {
  const response = await fetch(`${RequestPath.getPath()}/api/order.php?receipt_id=`+$id);
  if(response.ok) {
    return await response.json();
  }
}

}]);