function changeIntegerToText(json) {
    const array = [];
    for (let i = 0; i < json.length; i++) {
      let order = json[i];
      order[5] = order[5] == 1 ? 'Not Paid' : order[5] == 2 ? 'Processed' : order[5] == 3 ? 'Serving' : 'Paid';
      array[i] = order;
    }
    return array;
  }
  

const module = angular.module('myApp', []);

module.service('OrderService', function($http) {
    this.getOrder = () => {
        return $http.get('http://localhost:8000/api/order.php');
    }
});

module.controller('ModalController', ['$scope', 'OrderService', function(s, order_service) {

    setDataTableValue();

    s.closeModal = () => {
        ModalController.closeModal();
    }

    s.totalPrice = (orders) => {
        let total = 0;
        angular.forEach(orders, (value) => {
            total += value.quantity * value.price;
        });
        return total;
    }

    async function setDataTableValue() {
        let response = await fetch('http://localhost:8000/api/order.php');
        let orders;
        if (response.ok) {
          let json = await response.json();
          orders = json.orders;
          const table = $('#table_id').DataTable({
            data: changeIntegerToText(json.receipt)
          });
    
          table.on('click', 'tr', function() {
            const data = table.row(this).data();
            console.log(orders);
            s.curr_orders = orders.filter(f => f.order_id == data[0]);
            console.log(s.curr_orders);
            s.$apply();
            ModalController.showModal();
          });
        } else {
          alert("HTTP-Error: " + response.status);
        }
      }
}]);