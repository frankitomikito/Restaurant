const module  = angular.module('chefApp', []);

module.service('OrderService', function($http) {
    this.getOrders = (receipt_id) => {
        return $http.get(`${RequestPath.getPath()}/api/order.php?receipt_id=`+receipt_id);
    }
});

module.controller('ModalController', ['$scope', 'OrderService', function(s, order_service) {

    s.orders = [];

    setDataTableValue();

    s.closeModal = () => {
        ModalController.closeModal();
    }

    function setDataTableValue() {
        const table = $('#chef-datatable').DataTable({
            ajax: `${RequestPath.getPath()}/api/receipt.php?chef_cooked=true`,
            dataSrc: 'data',
            columns: [{
                    data: 0
                },
                {
                    data: 1,
                    render: function(data, type, row) {
                        const date = moment(data).format('MMMM DD, YYYY - h:mm A');
                        return date;
                    }
                },
                {
                    data: 2
                },
                {
                    data: 3
                },
                {
                    data: 4,
                    render: function(data, type, row) {
                        switch (parseInt(data)) {
                            case 2:
                                return 'Processed';
                            case 3:
                                return 'Ready';
                            default:
                                return 'Served';
                        }
                    }
                }
            ]
        });

        $('#chef-datatable tbody').on('click', 'tr', function () {
            const data = table.row(this).data();
            document.getElementById('profileImg').setAttribute('src', '../'+data[5]);
            s.chef_fullname = data[2];
            order_service.getOrders(data[0]).then(
                result => {
                    s.orders = result.data;
                    ModalController.showModal();
                }
            );
        });
    }
}]);