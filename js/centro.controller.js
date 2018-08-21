(function () {
    'use strict';
    
    angular.module('app.centro')
    .controller('MapCtrl',['$scope',MapCtrl])
    .controller('InputCtrl',['$scope','$http','$filter','$directores','$interval',InputCtrl]);
    
    function MapCtrl($scope)
    {
        console.log($scope);
    }
    function InputCtrl($scope,$http,$filter,$directores,$interval)
    {
        $scope.map = false;
        /*var chicago = new google.maps.LatLng(41.850033, -87.6500523);
        
        
        var click = function() {
            ngMap.map.setCenter(chicago);
        };*/
        $scope.$on('mapInitialized', function(event, map) {
         // map.setCenter( .... )
         // ..
            //console.log(map);
            //google.maps.event.trigger(map, "resize");
            $scope.map = map;
        });
       $('.tap-pane').on('shown', function (e) {
            console.log('show');
            google.maps.event.trigger($scope.map, "resize");
            
        });
        $scope.resize = function()
        {
            // console.log($scope.map);
            
             //$interval(google.maps.event.trigger($scope.map, "resize"),9000);
             //google.maps.event.trigger($scope.map, "resize");
        }
        
        $scope.drag = [];
        $scope.id_centro = ''; 
        $scope.today = function() {
            $scope.fecha_creacion = new Date();
        };
        $scope.edit = false;
        $scope.today();

        $scope.clear = function () {
            $scope.fecha_creacion = null;
        };
       
        
        
        // Disable weekend selection
        $scope.disabled = function(date, mode) {
            return ( mode === 'day' && ( date.getDay() === 0 || date.getDay() === 6 ) );
        };

        $scope.toggleMin = function() {
            $scope.minDate = $scope.minDate ? null : new Date();
        };
        $scope.toggleMin();
        $scope.maxDate = new Date(2020, 5, 22);

        $scope.open = function($event) {
            $scope.status.opened = true;
            
        };

        $scope.setDate = function(year, month, day) {
            $scope.fecha_creacion = new Date(year, month, day);
        };

        $scope.dateOptions = {
            formatYear: 'yy',
            startingDay: 1
        };



        $scope.status = {
            opened: false
        };

        var tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        var afterTomorrow = new Date();
        afterTomorrow.setDate(tomorrow.getDate() + 2);
        $scope.events =
            [
                {
                    date: tomorrow,
                    status: 'full'
                },
                {
                    date: afterTomorrow,
                    status: 'partially'
                }
            ];

        $scope.getDayClass = function(date, mode) {
            if (mode === 'day') {
                var dayToCheck = new Date(date).setHours(0,0,0,0);

                for (var i=0;i<$scope.events.length;i++){
                    var currentDay = new Date($scope.events[i].date).setHours(0,0,0,0);

                    if (dayToCheck === currentDay) {
                        return $scope.events[i].status;
                    }
                }
            }

            return '';
        };
        
        
        $scope.$watch('drag',function(newValue,oldValue){
            
            console.log(newValue);
        });
        
        
        
        
    }
    
})();