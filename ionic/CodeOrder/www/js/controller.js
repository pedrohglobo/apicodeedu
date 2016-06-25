angular.module('starter.controllers', [])
    .controller('LoginCtrl', ['$scope', '$http', '$state', 'OAuth', '$cookies', 'OAuthToken',
        function($scope, $http, $state, OAuth, $cookies, OAuthToken){

            $scope.login = function(data){

                OAuth.getAccessToken(data).then(function(){
                    $state.go('tabs.orders');
                }, function(data){
                    $scope.error_login = 'Usuário ou Senha Inválidos.'
                });
            }
        }
    ])
    .controller('OrdersCtrl', ['$scope', '$http', '$state', '$ionicPopup',
        function($scope, $http, $state, $ionicPopup){

            $scope.getOrders = function(){
                $http.get('http://localhost:8888/orders').then(
                    function(data){
                        $scope.orders = data.data._embedded.orders;
                    }
                );
            };
            $scope.getOrders();

            $scope.doRefresh = function(){
                $scope.getOrders();
                $scope.$broadcast('scroll.refreshComplete');
            };

            $scope.onOrderDelete = function(order){
                
                var confirmPopup = $ionicPopup.confirm({
                    template: 'Deseja remover o pedido '+order.id+'?'
                });

                confirmPopup.then(function(res) {
                    if(res) {
                        $http.delete('http://localhost:8888/orders/' + order.id).then(
                            function (data) {
                                var alertPopup = $ionicPopup.alert({
                                    template: 'Pedido removido com sucesso'
                                });

                                alertPopup.then(function(res) {
                                    $scope.getOrders();
                                });

                            }
                        );
                    }
                });
                
            };
        }

    ]);