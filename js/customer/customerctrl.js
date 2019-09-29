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

module.controller('ModalController', ['$scope', 'OrderFactory', function(s, order_factory) {

    s.quantity = [];
    s.prices = [];

    s.onCancel = () => {
        ModalController.closeModal();
        console.log(s.quantity);
    }

    s.order = () => {
        const receipt = {};
        receipt.total = s.totalPrice(s.prices);
        console.log(receipt);

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

    $('#a_cart').click(function() {
        ModalController.showModal();
        const orders = order_factory.orders;
        angular.forEach(orders, (value, key) => {
            s.quantity[key] = 1;
        });
        s.menus = orders;
        s.$apply();
    });
}]);

module.controller('MenuController', ['$scope', 'MenuService', 'OrderFactory',
 function(s, menu_service, order_factory) {

    initMenu();

    s.onClickMenu = (menu, index) => {
        order_factory.orders.push(menu);
        const cart = document.getElementById('cart');
        const selected = document.querySelectorAll('.main-dish')[index];
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