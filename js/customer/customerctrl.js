const module = angular.module('myApp', []);

module.factory('OrderFactory', function() {
    return {
        orders: []
    }
});

module.service('MenuService', ['$http', function(h) {
    this.getMenus = () => {
        return h.get('http://localhost:8000/apis/menu');
    }
}]);

module.service('ReservationService', function($http) {
    this.getReservation = () => {
        return $http.get('http://localhost:8000/apis/reservation')
    }
});

module.service('OrderService', function($http) {
    this.submitOrder = (data) => {
        const form_data = new FormData();
        angular.forEach(data, (value, key) => {
            if (angular.isObject(value) || angular.isArray(value)) {
                form_data.append(key, JSON.stringify(value));
            } else {
                form_data.append(key, value);
            }
        });
        return $http({
            method: 'POST',
            url: 'http://localhost:8000/apis/order',
            data: form_data,
            transformRequest: angular.identity,
            headers: { 'Content-Type': undefined }
        });
    }
});

module.controller('ModalController', ['$scope', 'OrderFactory', 'OrderService', 'ReservationService', function(s, order_factory, order_service, reservation_service) {

    s.quantity = [];
    s.prices = [];
    s.table_id = null;
    s.reservations = [];

    init();

    s.onCancel = () => {
        ModalController.closeModal();
    }

    s.order = () => {
        const receipt = {};
        const orders = [];
        const factory_orders = order_factory.orders;
        receipt.total = s.totalPrice(s.prices);
        receipt.table_id = parseInt(s.table_id);
        for (let i = 0; i < factory_orders.length; i++) {
            orders.push({
                menu_id: parseInt(factory_orders[i].menu_id),
                quantity: s.quantity[i]
            });
        }
        const data = {
            receipt: receipt,
            orders: orders
        }
        console.log(data);
        order_service.submitOrder(data).then(
            result => {
                if (result.status == 201) {
                    alert('Order Submitted Successfully!');
                    window.location.href = "/orders";
                } else {
                    alert('Something went wrong, Try Again.');
                }
            },
            () => alert('Check your internet connection')
        )
    }

    s.removeItem = (item, index) => {
        const items = order_factory.orders;
        order_factory.orders.splice(items.indexOf(items.filter(f => f.menu_id == item.menu_id)[0]), 1);
        
        s.menus = order_factory.orders;
        s.prices.splice(s.prices.indexOf(item.price), 1);

        const elem_cart = document.getElementById('cart');
        const menu_elem = document.getElementById(`menu-${item.menu_id}`);
        menu_elem.style.border = '';
        elem_cart.innerText = (parseInt(elem_cart.innerText) - 1) == 0 ? '' : parseInt(elem_cart.innerText) - 1; 
    }

    s.orderPrice = (quantity, price, index) => {
        s.prices[index] = quantity ? price * quantity : 0;
        return s.prices[index];
    }

    s.totalPrice = (prices) => {
        let final_total = 0;
        angular.forEach(prices, (value) => {
            final_total += value;
        });
        return final_total;
    }

    s.canOrder = (table_id) => {
        return table_id && order_factory.orders.length > 0 ? true : false;
    }

    function init() {
        $('#a_cart').click(function() {
            ModalController.showModal();
            const orders = order_factory.orders;
            angular.forEach(orders, (value, key) => {
                s.quantity[key] = 1;
            });
            s.menus = orders;
            s.$apply();
        });

        reservation_service.getReservation().then(
            result => s.reservations = result.data
        );
    }
}]);

module.controller('MenuController', ['$scope', 'MenuService', 'OrderFactory',
 function(s, menu_service, order_factory) {

    initMenu();

    s.onClickMenu = (menu, elem) => {
        order_factory.orders.push(menu);
        const cart = document.getElementById('cart');
        const selected = elem;
        if (!selected.style.border) {
            selected.style.border = '2px solid green';
            cart.innerText = cart.innerText ? parseInt(cart.innerText) + 1 : 1;
        } else {
            selected.style.border = '';
            const order_count = parseInt(cart.innerText) - 1;
            cart.innerText = order_count == 0 ? '' : order_count;
        }
    }

    function initMenu() {
        menu_service.getMenus().then(
            result => s.menus = result.data
        );
    }
}]);